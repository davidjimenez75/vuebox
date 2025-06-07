const { createApp } = Vue;

createApp({
    data() {
        return {
            markdownContent: '',
            wysiwygContent: '',
            viewMode: 'wysiwyg', // 'wysiwyg' o 'markdown'
            newTask: {
                title: '',
                description: '',
                comments: '',
                subtasks: ''
            }
        }
    },
    
    computed: {
        compiledMarkdown() {
            // Configure marked for better list rendering
            marked.setOptions({
                breaks: true,
                gfm: true
            });
            return marked.parse(this.markdownContent || '');
        }
    },
    
    watch: {
        compiledMarkdown() {
            // Apply checkbox styling when compiled markdown changes
            this.$nextTick(() => {
                const previewDiv = document.querySelector('.preview-content');
                if (previewDiv) {
                    this.applyCheckboxStyling(previewDiv);
                }
            });
        }
    },
    
    methods: {
        async loadFile() {
            try {
                const response = await fetch('TODO.md');
                if (response.ok) {
                    this.markdownContent = await response.text();
                    this.convertMarkdownToWysiwyg();
                } else {
                    console.warn('Could not load TODO.md, using default content');
                    this.markdownContent = await this.getDefaultContent();
                    this.convertMarkdownToWysiwyg();
                }
            } catch (error) {
                console.warn('Error loading file:', error);
                this.markdownContent = await this.getDefaultContent();
                this.convertMarkdownToWysiwyg();
            }
        },
        
        saveFile() {
            const blob = new Blob([this.markdownContent], { type: 'text/markdown' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'TODO.md';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
            
            // Show success message
            this.showAlert('File saved successfully', 'success');
        },
        
        toggleView() {
            if (this.viewMode === 'wysiwyg') {
                // Switching to code mode
                this.convertWysiwygToMarkdown();
                this.viewMode = 'markdown';
            } else {
                // Switching to WYSIWYG mode
                this.viewMode = 'wysiwyg';
                this.convertMarkdownToWysiwyg();
            }
            
            // Force Vue to re-render the components
            this.$forceUpdate();
        },
        
        convertMarkdownToWysiwyg() {
            // Convert markdown to HTML for WYSIWYG editor
            if (this.markdownContent) {
                // Configure marked options for better parsing
                marked.setOptions({
                    breaks: true,
                    gfm: true,
                    headerIds: false,
                    mangle: false
                });
                
                // Parse markdown directly without emoji replacement
                this.wysiwygContent = marked.parse(this.markdownContent);
            } else {
                this.wysiwygContent = '';
            }
            
            // Use nextTick to ensure DOM is updated before applying styles
            this.$nextTick(() => {
                const wysiwygDiv = document.querySelector('.wysiwyg-editor');
                if (wysiwygDiv) {
                    // Ensure proper CSS classes are applied
                    wysiwygDiv.innerHTML = this.wysiwygContent;
                    // Apply checkbox status styling
                    this.applyCheckboxStyling(wysiwygDiv);
                }
            });
        },
        
        convertWysiwygToMarkdown() {
            // Convert HTML from WYSIWYG editor to Markdown
            const wysiwygDiv = document.querySelector('.wysiwyg-editor');
            if (wysiwygDiv) {
                // Get the innerHTML and normalize it
                let htmlContent = wysiwygDiv.innerHTML;
                
                // Store a reference to detect checkboxes from original content
                const originalMarkdown = this.markdownContent || '';
                
                // Convert to markdown
                this.markdownContent = this.htmlToMarkdown(htmlContent, originalMarkdown);
                
                // Debug output to console
                console.log('Original HTML:', htmlContent);
                console.log('Converted Markdown:', this.markdownContent);
            }
        },
        
        htmlToMarkdown(html, originalMarkdown = '') {
            // Enhanced HTML to Markdown conversion that preserves line breaks and checkboxes
            let markdown = html;
            
            // Extract checkbox items from original markdown for reference
            const checkboxItems = [];
            if (originalMarkdown) {
                // Match all checkbox types: [ ], [x], [>]
                const checkboxMatches = originalMarkdown.match(/- \[[x>\s]\] .+/g);
                if (checkboxMatches) {
                    checkboxMatches.forEach(item => {
                        const match = item.match(/^- \[([x>\s])\] (.+)$/);
                        if (match) {
                            const status = match[1];
                            const text = match[2].trim();
                            checkboxItems.push({
                                text: text,
                                status: status === ' ' ? '[ ]' : `[${status}]`
                            });
                        }
                    });
                }
            }
            
            // First, normalize different line break patterns browsers create
            // Handle div elements that browsers create for line breaks
            markdown = markdown.replace(/<div[^>]*><br[^>]*><\/div>/gi, '\n\n');
            markdown = markdown.replace(/<div[^>]*>\s*<\/div>/gi, '\n\n');
            markdown = markdown.replace(/<div[^>]*>(.*?)<\/div>/gi, '$1\n\n');
            
            // Handle lists first (before removing other tags)
            // Convert unordered lists with checkbox detection
            markdown = markdown.replace(/<ul[^>]*>(.*?)<\/ul>/gis, (match, content) => {
                const listItems = content.match(/<li[^>]*>(.*?)<\/li>/gis);
                if (listItems) {
                    const items = listItems.map(li => {
                        let text = li.replace(/<li[^>]*>(.*?)<\/li>/gis, '$1')
                                    .replace(/<[^>]*>/g, '')
                                    .replace(/\s+/g, ' ')
                                    .trim();
                        
                        // FIXED: Decode HTML entities FIRST before checking for checkboxes
                        text = text.replace(/&gt;/g, '>').replace(/&lt;/g, '<').replace(/&amp;/g, '&')
                                  .replace(/&nbsp;/g, ' ').replace(/&quot;/g, '"').replace(/&#39;/g, "'").replace(/&apos;/g, "'");
                        
                        // Check if text already contains checkbox notation first
                        const checkboxMatch = text.match(/^\[([x>\s])\]\s*(.*)$/);
                        
                        if (checkboxMatch) {
                            // Text already has checkbox, return as-is without duplication
                            return `- ${text}`;
                        }
                        
                        // Check context-based detection for common task patterns
                        const looksLikeTask = /^(Create|Configure|Test|Design|Implement|Add|Perform|Write|Prepare|Review|Make sure|Don't forget)/i.test(text) ||
                                            content.toLowerCase().includes('subtask') ||
                                            match.toLowerCase().includes('subtask');
                        
                        // If no checkbox present, check if it was originally a checkbox item
                        const wasCheckbox = checkboxItems.find(checkboxItem => {
                            const textLower = text.toLowerCase();
                            const checkboxLower = checkboxItem.text.toLowerCase();
                            return textLower.includes(checkboxLower) ||
                                   checkboxLower.includes(textLower) ||
                                   textLower === checkboxLower;
                        });
                        
                        if (wasCheckbox) {
                            return `- ${wasCheckbox.status} ${text}`;
                        } else if (looksLikeTask) {
                            return `- [ ] ${text}`;
                        } else {
                            return `- ${text}`;
                        }
                    }).join('\n');
                    return `\n${items}\n\n`;
                }
                return '';
            });
            
            // Convert ordered lists
            markdown = markdown.replace(/<ol[^>]*>(.*?)<\/ol>/gis, (match, content) => {
                const listItems = content.match(/<li[^>]*>(.*?)<\/li>/gis);
                if (listItems) {
                    const items = listItems.map((li, index) => {
                        const text = li.replace(/<li[^>]*>(.*?)<\/li>/gis, '$1')
                                    .replace(/<[^>]*>/g, '')
                                    .replace(/\s+/g, ' ')
                                    .trim();
                        return `${index + 1}. ${text}`;
                    }).join('\n');
                    return `\n${items}\n\n`;
                }
                return '';
            });
            
            // Handle headings with proper spacing
            markdown = markdown.replace(/<h1[^>]*>(.*?)<\/h1>/gi, '\n# $1\n\n');
            markdown = markdown.replace(/<h2[^>]*>(.*?)<\/h2>/gi, '\n## $1\n\n');
            markdown = markdown.replace(/<h3[^>]*>(.*?)<\/h3>/gi, '\n### $1\n\n');
            markdown = markdown.replace(/<h4[^>]*>(.*?)<\/h4>/gi, '\n#### $1\n\n');
            markdown = markdown.replace(/<h5[^>]*>(.*?)<\/h5>/gi, '\n##### $1\n\n');
            markdown = markdown.replace(/<h6[^>]*>(.*?)<\/h6>/gi, '\n###### $1\n\n');
            
            // Handle text formatting
            markdown = markdown.replace(/<strong[^>]*>(.*?)<\/strong>/gi, '**$1**');
            markdown = markdown.replace(/<b[^>]*>(.*?)<\/b>/gi, '**$1**');
            markdown = markdown.replace(/<em[^>]*>(.*?)<\/em>/gi, '*$1*');
            markdown = markdown.replace(/<i[^>]*>(.*?)<\/i>/gi, '*$1*');
            
            // Handle paragraphs with proper spacing
            markdown = markdown.replace(/<p[^>]*>(.*?)<\/p>/gis, '$1\n\n');
            
            // Handle line breaks
            markdown = markdown.replace(/<br\s*\/?>/gi, '\n');
            
            // Handle horizontal rules (separators)
            markdown = markdown.replace(/<hr[^>]*>/gi, '\n' + '-'.repeat(80) + '\n\n');
            
            // Clean up remaining HTML tags
            markdown = markdown.replace(/<[^>]*>/g, '');
            
            // Decode HTML entities
            markdown = markdown.replace(/&nbsp;/g, ' ');
            markdown = markdown.replace(/&amp;/g, '&');
            markdown = markdown.replace(/&lt;/g, '<');
            markdown = markdown.replace(/&gt;/g, '>');
            markdown = markdown.replace(/&quot;/g, '"');
            markdown = markdown.replace(/&#39;/g, "'");
            markdown = markdown.replace(/&apos;/g, "'");
            
            // Normalize whitespace and line breaks
            markdown = markdown.replace(/[ \t]+/g, ' '); // Multiple spaces/tabs to single space
            markdown = markdown.replace(/\n[ \t]+/g, '\n'); // Remove leading spaces on lines
            markdown = markdown.replace(/[ \t]+\n/g, '\n'); // Remove trailing spaces on lines
            markdown = markdown.replace(/\n{3,}/g, '\n\n'); // Max 2 consecutive newlines
            
            // Trim and ensure proper ending
            markdown = markdown.trim();
            
            return markdown;
        },
        
        similarity(str1, str2) {
            // Simple string similarity calculation using Levenshtein distance
            const longer = str1.length > str2.length ? str1 : str2;
            const shorter = str1.length > str2.length ? str2 : str1;
            
            if (longer.length === 0) return 1.0;
            
            const distance = this.levenshteinDistance(longer, shorter);
            return (longer.length - distance) / longer.length;
        },
        
        levenshteinDistance(str1, str2) {
            const matrix = [];
            
            for (let i = 0; i <= str2.length; i++) {
                matrix[i] = [i];
            }
            
            for (let j = 0; j <= str1.length; j++) {
                matrix[0][j] = j;
            }
            
            for (let i = 1; i <= str2.length; i++) {
                for (let j = 1; j <= str1.length; j++) {
                    if (str2.charAt(i - 1) === str1.charAt(j - 1)) {
                        matrix[i][j] = matrix[i - 1][j - 1];
                    } else {
                        matrix[i][j] = Math.min(
                            matrix[i - 1][j - 1] + 1,
                            matrix[i][j - 1] + 1,
                            matrix[i - 1][j] + 1
                        );
                    }
                }
            }
            
            return matrix[str2.length][str1.length];
        },
        
        updateFromWysiwyg() {
            // Convert WYSIWYG content to markdown and update preview
            this.convertWysiwygToMarkdown();
            // Update preview with latest content
            this.updateFromMarkdown();
        },
        
        updateFromMarkdown() {
            // Update preview with latest markdown content
            this.previewContent = marked.parse(this.markdownContent || '');
            
            // Apply checkbox styling to preview
            this.$nextTick(() => {
                const previewDiv = document.querySelector('.preview-content');
                if (previewDiv) {
                    this.applyCheckboxStyling(previewDiv);
                }
            });
        },
        
        applyCheckboxStyling(container) {
            // FIXED: Apply styling based on checkbox states in text content
            // Color scheme: [ ] = Red (TO-DO), [x] = Green (Completed), [>] = Orange (Work in Progress)
            
            // Handle task titles (h2 elements)
            const h2Elements = container.querySelectorAll('h2');
            h2Elements.forEach(h2 => {
                const text = h2.textContent;
                h2.className = ''; // Reset classes
                
                if (text.includes('[x]')) {
                    h2.classList.add('status-completed');
                    h2.style.color = '#28a745 !important';
                    h2.style.borderBottomColor = '#28a745';
                } else if (text.includes('[>]')) {
                    h2.classList.add('status-progress');
                    h2.style.color = '#fd7e14 !important';
                    h2.style.borderBottomColor = '#fd7e14';
                } else {
                    h2.classList.add('status-todo');
                    h2.style.color = '#dc3545 !important';
                    h2.style.borderBottomColor = '#dc3545';
                }
            });
            
            // Handle subtask list items (li elements)
            const liElements = container.querySelectorAll('ul li');
            liElements.forEach(li => {
                const text = li.textContent.trim();
                
                // Remove all existing classes and styles
                li.className = '';
                li.removeAttribute('style');
                
                // FIXED: More specific checkbox detection using regex
                if (/\[x\]/.test(text)) {
                    li.classList.add('status-completed');
                    li.setAttribute('style', 'color: #28a745 !important; font-weight: bold !important;');
                } else if (/\[>\]/.test(text)) {
                    li.classList.add('status-progress');
                    li.setAttribute('style', 'color: #fd7e14 !important; font-weight: bold !important;');
                } else if (/\[\s\]/.test(text)) {
                    li.classList.add('status-todo');
                    li.setAttribute('style', 'color: #dc3545 !important; font-weight: bold !important;');
                } else {
                    // Regular list item (Comments section)
                    li.setAttribute('style', 'color: #343a40 !important;');
                }
            });
        },
        
        addTask() {
            // Resetear formulario
            this.newTask = {
                title: '',
                description: '',
                comments: '',
                subtasks: ''
            };
            
            // Mostrar modal
            const modal = new bootstrap.Modal(document.getElementById('taskModal'));
            modal.show();
        },
        
        insertTask() {
            let taskMarkdown = '\n' + '-'.repeat(80) + '\n\n';
            taskMarkdown += `## ${this.newTask.title}\n\n`;
            
            if (this.newTask.description) {
                taskMarkdown += `### Description\n${this.newTask.description}\n\n`;
            }
            
            if (this.newTask.comments) {
                taskMarkdown += `### Comments\n${this.newTask.comments}\n\n`;
            }
            
            if (this.newTask.subtasks) {
                taskMarkdown += `### Subtasks\n`;
                const subtasks = this.newTask.subtasks.split('\n').filter(task => task.trim());
                subtasks.forEach(task => {
                    taskMarkdown += `- [ ] ${task.trim()}\n`;
                });
                taskMarkdown += '\n';
            }
            
            // Agregar la nueva tarea al contenido
            this.markdownContent += taskMarkdown;
            this.convertMarkdownToWysiwyg();
            
            // Cerrar modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('taskModal'));
            modal.hide();
            
            this.showAlert('Task added successfully', 'success');
        },
        
        addSeparator() {
            const separator = '\n' + '-'.repeat(80) + '\n\n';
            this.markdownContent += separator;
            this.convertMarkdownToWysiwyg();
        },
        
        formatBold() {
            document.execCommand('bold');
        },
        
        formatItalic() {
            document.execCommand('italic');
        },
        
        showAlert(message, type = 'info') {
            // Crear alerta temporal
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
            alertDiv.style.top = '20px';
            alertDiv.style.right = '20px';
            alertDiv.style.zIndex = '9999';
            alertDiv.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            document.body.appendChild(alertDiv);
            
            // Remover después de 3 segundos
            setTimeout(() => {
                if (alertDiv.parentNode) {
                    alertDiv.parentNode.removeChild(alertDiv);
                }
            }, 3000);
        },
        
        async getDefaultContent() {
            try {
                // Try to read from TODO.md file first
                const response = await fetch('TODO.md');
                if (response.ok) {
                    return await response.text();
                }
            } catch (error) {
                console.warn('Could not read TODO.md for default content:', error);
            }
            
            // Fallback to hardcoded content if file cannot be read
            return `# Task List

${'-'.repeat(80)}

## [x] Task 1: Set up the project

### Description
This is the first task of the project. It includes initial setup and basic structure.

### Comments
- I need to review all configuration files
- Make sure dependencies are correct
- Test that everything works

### Subtasks
- [x] Create folder structure
- [x] Configure base files
- [>] Test basic functionality

${'-'.repeat(80)}

## [>] Task 2: Implement main functionality

### Description
Develop the main features of the application.

### Comments
This task is more complex and will require more time.
I should break it down into smaller parts for better management.

### Subtasks
- [x] Design user interface
- [x] Implement business logic
- [x] Add validations
- [>] Perform testing

${'-'.repeat(80)}

## [ ] Task 3: Documentation and deployment

### Description
Finalize documentation and prepare for deployment.

### Comments
Don't forget to include examples and usage guides.

### Subtasks
- [ ] Write documentation
- [ ] Create examples
- [ ] Prepare for production`;
        }
    },
    
    mounted() {
        this.loadFile();
    }
}).mount('#app');
