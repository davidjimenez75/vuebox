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
    },    computed: {
        compiledMarkdown() {
            // Configure marked for better list rendering
            marked.setOptions({
                breaks: true,
                gfm: true
            });
            return marked.parse(this.markdownContent || '');
        }
    },
    methods: {
        async loadFile() {
            try {
                const response = await fetch('TODO.md');
                if (response.ok) {
                    this.markdownContent = await response.text();
                    this.convertMarkdownToWysiwyg();                } else {
                    console.warn('Could not load TODO.md, using default content');
                    this.markdownContent = this.getDefaultContent();
                    this.convertMarkdownToWysiwyg();
                }
            } catch (error) {
                console.warn('Error loading file:', error);
                this.markdownContent = this.getDefaultContent();
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
                this.viewMode = 'markdown';
                this.convertWysiwygToMarkdown();
            } else {
                this.viewMode = 'wysiwyg';
                this.convertMarkdownToWysiwyg();
            }
        },
        
        convertMarkdownToWysiwyg() {
            // Convertir markdown a HTML para el editor WYSIWYG
            this.wysiwygContent = marked.parse(this.markdownContent || '');
        },
        
        convertWysiwygToMarkdown() {
            // Convertir HTML del editor WYSIWYG a Markdown
            const wysiwygDiv = document.querySelector('.wysiwyg-editor');
            if (wysiwygDiv) {
                this.markdownContent = this.htmlToMarkdown(wysiwygDiv.innerHTML);
            }
        },
        
        htmlToMarkdown(html) {
            // Conversión básica de HTML a Markdown
            let markdown = html;
            
            // Reemplazar elementos HTML comunes
            markdown = markdown.replace(/<h1[^>]*>(.*?)<\/h1>/gi, '# $1\n');
            markdown = markdown.replace(/<h2[^>]*>(.*?)<\/h2>/gi, '## $1\n');
            markdown = markdown.replace(/<h3[^>]*>(.*?)<\/h3>/gi, '### $1\n');
            markdown = markdown.replace(/<strong[^>]*>(.*?)<\/strong>/gi, '**$1**');
            markdown = markdown.replace(/<em[^>]*>(.*?)<\/em>/gi, '*$1*');
            markdown = markdown.replace(/<p[^>]*>(.*?)<\/p>/gi, '$1\n\n');
            markdown = markdown.replace(/<br\s*\/?>/gi, '\n');
            markdown = markdown.replace(/<hr\s*\/?>/gi, '\n' + '-'.repeat(80) + '\n');
            
            // Limpiar HTML restante
            markdown = markdown.replace(/<[^>]*>/g, '');
            markdown = markdown.replace(/&nbsp;/g, ' ');
            markdown = markdown.replace(/&amp;/g, '&');
            markdown = markdown.replace(/&lt;/g, '<');
            markdown = markdown.replace(/&gt;/g, '>');
            
            return markdown.trim();
        },
        
        updateFromWysiwyg() {
            this.convertWysiwygToMarkdown();
        },
        
        updateFromMarkdown() {
            this.convertMarkdownToWysiwyg();
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
          getDefaultContent() {
            return `# Task List

${'-'.repeat(80)}

## Task 1: Set up the project

### Description
This is the first task of the project. It includes initial setup and basic structure.

### Comments
- I need to review all configuration files
- Make sure dependencies are correct
- Test that everything works

### Subtasks
- [ ] Create folder structure
- [ ] Configure base files
- [ ] Test basic functionality

${'-'.repeat(80)}

## Task 2: Implement main functionality

### Description
Develop the main features of the application.

### Comments
This task is more complex and will require more time.
I should break it down into smaller parts for better management.

### Subtasks
- [ ] Design user interface
- [ ] Implement business logic
- [ ] Add validations
- [ ] Perform testing

${'-'.repeat(80)}

## Task 3: Documentation and deployment

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
