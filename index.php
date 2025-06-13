<?php
/**
 * VueBox - A simple Vue.js application to display directories and their contents
 * 
 * This file serves as the main entry point for the VueBox application.
 * It dynamically generates a navigation menu from a Markdown file and displays
 * directories with their titles, descriptions, and tags.
 */

 require_once 'config.php'; // Include configuration file


// Create the main menu from the index-menu.md file
function parseMenuFromMarkdown($filePath) {
    if (!file_exists($filePath)) {
        return '';
    }
    
    $content = file_get_contents($filePath);
    $lines = explode("\n", $content);
    $menuHtml = '';
    $currentDropdown = null;
    
    foreach ($lines as $line) {
        $line = trim($line);
        
        // Skip empty lines and comments
        if (empty($line) || strpos($line, '<!--') === 0) {
            continue;
        }
        
        // Handle dropdown headers (# Header)
        if (preg_match('/^# (.+)$/', $line, $matches)) {
            // Close previous dropdown if exists
            if ($currentDropdown !== null) {
                $menuHtml .= "                            </ul>\n";
                $menuHtml .= "                        </li>\n";
            }
            
            $dropdownTitle = trim($matches[1]);
            $menuHtml .= "                        <li class=\"nav-item dropdown\">\n";
            $menuHtml .= "                            <a class=\"nav-link dropdown-toggle\" href=\"#\" role=\"button\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">{$dropdownTitle}</a>\n";
            $menuHtml .= "                            <ul class=\"dropdown-menu\">\n";
            $currentDropdown = $dropdownTitle;
        }
        
        // Handle menu items (- [Title](URL))
        if (preg_match('/^- \[(.+?)\]\((.+?)\)$/', $line, $matches)) {
            $linkTitle = trim($matches[1]);
            $linkUrl = trim($matches[2]);
            $target = (strpos($linkUrl, 'http') === 0) ? ' target="_blank"' : '';
            $menuHtml .= "                                <li><a class=\"dropdown-item\" href=\"{$linkUrl}\"{$target}>{$linkTitle}</a></li>\n";
        }
    }
    
    // Close last dropdown if exists
    if ($currentDropdown !== null) {
        $menuHtml .= "                            </ul>\n";
        $menuHtml .= "                        </li>\n";
    }
    
    return $menuHtml;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $title; ?></title>
    <description><?php echo $description; ?></description>
    <meta name="author" content="<?php echo $author; ?>">   

    <link rel="icon" href="./favicon.ico">
    <link rel="icon" type="image/png" href="./favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="./favicon-16x16.png" sizes="16x16" />

 

    <!--BOOTSTRAP 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="./index.css" rel="stylesheet">

    <!-- Vue.js cloak styles to prevent flash of unstyled content -->
    <style>
        [v-cloak] {
            display: none !important;
        }
        
        .vue-loading {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 50vh;
            flex-direction: column;
        }
        
        .spinner-border-custom {
            width: 3rem;
            height: 3rem;
        }
        
        /* Search highlight styles */
        .search-highlight {
            background-color: yellow;
            color: black !important;
            font-weight: bold;
        }
        
        /* Mobile search box styles */
        .mobile-search {
            padding: 15px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            margin-top: 56px; /* Account for fixed navbar */
        }
        
        @media (min-width: 768px) {
            .mobile-search {
                display: none;
            }
        }
        
        @media (max-width: 767px) {
            .navbar .d-flex {
                display: none !important;
            }
        }        /* Project row styling */
        .project-row {
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .project-row.expanded {
            border-bottom: 2px solid #007bff;
        }

        /* Expanded content styles */
        .expanded-content {
            background-color: #f8f9fa;
        }

        .tabs-container {
            margin: 15px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            background: white;
        }

        .tabs-nav {
            display: flex;
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            padding: 0;
            margin: 0;
            flex-wrap: wrap;
        }

        .tab-button {
            padding: 10px 15px;
            border: none;
            background: transparent;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .tab-button:hover {
            background-color: #e9ecef;
        }

        .tab-button.active {
            background-color: white;
            border-bottom-color: #007bff;
            color: #007bff;
            font-weight: bold;
        }

        .tabs-content {
            min-height: 200px;
            max-height: 500px;
            overflow-y: auto;
        }

        .tab-pane {
            padding: 15px;
        }

        .file-content {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 4px;
            padding: 15px;
            margin: 0;
            font-family: 'Courier New', monospace;
            font-size: 13px;
            line-height: 1.4;
            white-space: pre-wrap;
            word-wrap: break-word;
            max-height: 400px;
            overflow-y: auto;
            text-align: left;
        }

        .loading {
            text-align: center;
            padding: 20px;
            color: #6c757d;
        }

        .error {
            color: #dc3545;
            text-align: center;
            padding: 20px;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
            margin: 10px;
        }

        .no-files {
            text-align: center;
            padding: 20px;
            color: #6c757d;
        }

        /* Responsive design for tabs */
        @media (max-width: 768px) {
            .tabs-nav {
                flex-direction: column;
            }
            
            .tab-button {
                border-bottom: 1px solid #dee2e6;
                border-right: none;
            }
            
            .tab-button.active {
                border-bottom-color: #dee2e6;
                border-left: 3px solid #007bff;
            }
        }        /* Override Bootstrap 5 CSS variables for table backgrounds */
        .custom-table {
            --bs-table-bg: transparent;
        }
          /* Custom table styling - ensure background colors are applied */
        .custom-table tbody tr.project-row {
            /* Let inline styles take precedence */
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }
        
        .custom-table tbody tr.project-row:hover {
            filter: brightness(0.95);
        }
        
        /* For rows without custom background colors, add subtle striping */
        .custom-table tbody tr.project-row:nth-of-type(even):not([style*="background-color"]) {
            background-color: rgba(0,0,0,0.05);
        }
        
        /* First line styling */
        .project-title {
            font-weight: bold;
            font-size: 1.1em;
            margin-bottom: 0.5rem;
        }
        
        /* Description styling */
        .project-description {
            font-size: 0.9em;
            line-height: 1.4;
        }
        
        /* Tag styling */
        .project-tag {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            margin: 0.1rem 0.2rem;
            border-radius: 0.375rem;
            font-size: 0.75rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }
          .project-tag:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            text-decoration: none;
        }
          /* Project image styling */
        .project-image {
            transition: transform 0.2s ease;
            cursor: pointer;
        }
        
        .project-image:hover {
            transform: scale(1.05);
        }
    </style>

</head>

<body>
    <!-- Loading indicator shown while Vue.js is initializing -->
    <div id="loading" class="vue-loading">
        <div class="spinner-border spinner-border-custom text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p class="mt-3 text-muted">Loading <?php echo $title; ?>...</p>
    </div>
    <div id="app" v-cloak><!--#app-->

        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?php echo $menu_first_item_url; ?>"><?php echo $menu_first_item; ?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                    
                    <!-- BEGIN - Navigation links and dropdowns imported from index-menu.md -->
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <?php echo parseMenuFromMarkdown('./index-menu.md'); ?>
                    </ul>
                    <!-- END - Navigation links and dropdowns imported from index-menu.md -->

                    
                    <form class="d-flex" role="search" @submit.prevent="search(searchstr)">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" v-model="searchstr" @input="search(searchstr)">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Mobile search box -->
        <div class="mobile-search d-md-none">
            <form class="d-flex" role="search" @submit.prevent="search(searchstr)">
                <input class="form-control me-2" type="search" placeholder="Search scripts and descriptions..." aria-label="Search" v-model="searchstr" @input="search(searchstr)">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>

        <div class="container">
            <div class="starter-template">
                <div class="table-responsive">                    <table class="table align-middle custom-table">
                        <tbody id="list">
                            <template v-for="(value, index) in dirs" :key="index">
                                <tr :class="value.visible + ' project-row'" 
                                    :style="getRowStyle(value)"
                                    :data-project-path="value.dir"
                                    @click="toggleRow(value.dir, $event)">
                                    <td class="text-start p-3">                                        <div class="project-title">
                                            <span class="text-muted me-2">[{{ value.dir }}]</span>
                                            <a :href="value.dir" target="_blank" class="text-decoration-none" v-html="highlightText(value.title)" :style="getTitleStyle(value)" @click.stop></a>
                                        </div>
                                        <div v-if="value.description" class="project-description" v-html="formatDescription(value.description)"></div>
                                        <div v-if="value.tags && value.tags.length > 0" class="mt-2">
                                            <span v-for="tag in value.tags" :key="tag" 
                                                  class="project-tag" 
                                                  :style="getTagStyle(value, tag)"
                                                  :title="getTagTooltip(tag)"
                                                  @click.stop="searchTag(tag)"
                                                  v-html="highlightText(tag)">
                                            </span>
                                        </div>
                                    </td>                                    <td class="text-end p-3" style="width: 150px;" v-if="value.has_image">
                                        <a :href="value.dir" target="_blank" @click.stop>
                                            <img :src="value.dir + '/index.png'" 
                                                 :alt="'Screenshot of ' + value.title"
                                                 class="img-fluid rounded project-image"
                                                 style="max-width: 120px; max-height: 80px; object-fit: cover;">
                                        </a>
                                    </td>
                                    <td class="text-end p-3" style="width: 150px;" v-else>
                                        <!-- Empty cell for alignment when no image -->
                                    </td>
                                </tr>                                <!-- Expanded content row for each project -->
                                <tr v-if="expandedRows[value.dir]" :key="'expanded-' + index" class="expanded-content">
                                    <td class="p-0" colspan="2" style="border: none;">
                                        <div class="tabs-container">
                                            <div class="tabs-nav" v-if="expandedRows[value.dir].files && expandedRows[value.dir].files.length > 0">
                                                <button v-for="(file, fileIndex) in expandedRows[value.dir].files" 
                                                        :key="file.name"
                                                        class="tab-button"
                                                        :class="{ active: expandedRows[value.dir].activeTab === file.name }"
                                                        @click="switchTab(value.dir, file.name)">
                                                    {{ file.name }}
                                                </button>
                                            </div>
                                            <div class="tabs-content">
                                                <div v-if="!expandedRows[value.dir].files || expandedRows[value.dir].files.length === 0"
                                                     class="no-files">
                                                    <p>No viewable files found in this project.</p>
                                                </div>
                                                <div v-else-if="expandedRows[value.dir].loading" class="loading">
                                                    Loading file content...
                                                </div>
                                                <div v-else-if="expandedRows[value.dir].error" class="error">
                                                    {{ expandedRows[value.dir].error }}
                                                </div>
                                                <div v-else class="tab-pane active">
                                                    <pre class="file-content">{{ expandedRows[value.dir].content }}</pre>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.container -->

    </div><!--/#app-->

    <!-- Bootstrap 5 JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Vue 3 -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

    <!-- Main Vue 3 Application -->
    <script type="text/javascript">
        const {
            createApp
        } = Vue;

        createApp({
            data() {
                return {
                    searchstr: "",
                    expandedRows: {}, // Track expanded rows and their content
                    viewedFiles: <?php 
                            // Include color configuration
                            require_once 'config.php';
                            echo json_encode($viewed_files); 
                    ?>,
                    dirs: <?php
                            
                            // GET DIRECTORY TO VUE 3 DATA ARRAY
                            $ignoredFolders = array('.', '..', '.git', '.idea', '.svn', 'css', 'images', 'js', 'vendor', 'node_modules');
                            $a_dirs = array();

                            $directories = glob('*', GLOB_ONLYDIR);
                            natsort($directories);
                            
                            foreach ($directories as $dir) {
                                if (!in_array($dir, $ignoredFolders)) {
                                    $project = array();
                                    $project["dir"] = (string) basename($dir);
                                    $project["visible"] = "visible";
                                    $project["title"] = $project["dir"]; // Default title                                    $project["description"] = "";
                                    $project["tags"] = array();
                                    $project["background_color"] = "#ffffff"; // Default white background
                                    $project["has_image"] = file_exists("./" . $dir . "/index.png"); // Check if index.png exists
                                    
                                    // Read index.txt file
                                    $index_file = "./" . $dir . "/index.txt";
                                    if (file_exists($index_file)) {
                                        $content = file_get_contents($index_file);
                                        $lines = explode("\n", $content);
                                        
                                        // First line is the title
                                        if (!empty($lines[0])) {
                                            $project["title"] = trim($lines[0]);
                                        }
                                        
                                        // Process remaining lines for description and tags
                                        $description_lines = array();
                                        $functional_tags = array();
                                        
                                        for ($i = 1; $i < count($lines); $i++) {
                                            $line = trim($lines[$i]);
                                            if (!empty($line)) {                                                // Extract tags from the line
                                                preg_match_all('/#(\w+)/i', $line, $matches);
                                                if (!empty($matches[1])) {
                                                    foreach ($matches[1] as $tag) {
                                                        $tag_lower = strtolower($tag);
                                                        
                                                        // Check if this tag directly matches a color in background_colors
                                                        if (array_key_exists($tag_lower, $background_colors)) {
                                                            $project["background_color"] = $background_colors[$tag_lower];
                                                        }
                                                        // Also check if tag exists in tags_colors and get its color
                                                        elseif (array_key_exists($tag_lower, $tags_colors)) {
                                                            $tag_color = $tags_colors[$tag_lower]['color'];
                                                            // Use the tag's color to get the background color
                                                            if (array_key_exists($tag_color, $background_colors)) {
                                                                $project["background_color"] = $background_colors[$tag_color];
                                                            }
                                                        }
                                                        
                                                        // Add all tags to the functional tags list for display
                                                        $functional_tags[] = '#' . $tag_lower;
                                                    }
                                                }
                                                
                                                // Add line to description (will be processed to remove tags for display)
                                                $description_lines[] = $line;
                                            }
                                        }
                                        
                                        $project["tags"] = array_unique($functional_tags);
                                        $project["description"] = implode("<br>", $description_lines);
                                    }
                                    
                                    $a_dirs[] = $project;
                                }
                            }

                            echo json_encode($a_dirs, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
                            ?>,
                    backgroundColors: <?php echo json_encode($background_colors, JSON_UNESCAPED_UNICODE); ?>,
                    tagsColors: <?php echo json_encode($tags_colors, JSON_UNESCAPED_UNICODE); ?>
                }
            },
            mounted() {
                // Hide loading indicator once Vue is mounted
                const loadingElement = document.getElementById('loading');
                if (loadingElement) {
                    loadingElement.style.display = 'none';
                }
            },
            methods: {                getRowStyle(project) {
                    return {
                        backgroundColor: project.background_color || '#ffffff',
                        color: '#212529' // Default dark text
                    };
                },
                getTitleStyle(project) {
                    return {
                        color: '#212529' // Default dark text
                    };
                },
                getTagStyle(project, tag) {
                    // Remove the # from tag to get the tag name
                    const tagName = tag.replace('#', '').toLowerCase();
                    
                    // Check if this tag has a specific color defined
                    if (this.tagsColors[tagName]) {
                        const tagColor = this.tagsColors[tagName].color;
                        return this.getTagColorStyle(tagColor);
                    }
                    
                    // Default tag style
                    return {
                        backgroundColor: '#6c757d',
                        color: '#ffffff'
                    };
                },
                getTagColorStyle(color) {
                    const colorMap = {
                        'red': { backgroundColor: '#dc3545', color: '#ffffff' },
                        'orange': { backgroundColor: '#fd7e14', color: '#ffffff' },
                        'yellow': { backgroundColor: '#ffc107', color: '#212529' },
                        'green': { backgroundColor: '#28a745', color: '#ffffff' },
                        'blue': { backgroundColor: '#007bff', color: '#ffffff' },
                        'purple': { backgroundColor: '#6f42c1', color: '#ffffff' },
                        'pink': { backgroundColor: '#e83e8c', color: '#ffffff' },
                        'gray': { backgroundColor: '#6c757d', color: '#ffffff' }
                    };
                    
                    return colorMap[color] || { backgroundColor: '#6c757d', color: '#ffffff' };
                },
                getTagTooltip(tag) {
                    // Remove the # from tag to get the tag name
                    const tagName = tag.replace('#', '').toLowerCase();
                    
                    // Check if this tag has a description defined
                    if (this.tagsColors[tagName] && this.tagsColors[tagName].name) {
                        return this.tagsColors[tagName].name;
                    }
                    
                    // Default tooltip if no description is found
                    return `Tag: ${tag}`;
                },
                formatDescription(description) {
                    if (!description) return '';
                    
                    // Remove tags from description for display, but keep the HTML structure
                    let formatted = description.replace(/#\w+/g, '').trim();
                    
                    // Apply search highlighting if needed
                    return this.highlightText(formatted);
                },
                searchTag(tag) {
                    // Set the search string to the clicked tag and trigger search
                    this.searchstr = tag;
                    this.search(tag);
                },
                stripHtml(html) {
                    if (!html) return '';
                    const tmp = document.createElement('div');
                    tmp.innerHTML = html;
                    return tmp.textContent || tmp.innerText || '';
                },
                highlightText(text) {
                    if (!this.searchstr || !text) {
                        return text;
                    }
                    
                    // First strip HTML to get plain text for highlighting
                    const plainText = this.stripHtml(text);
                    const searchRegex = new RegExp(`(${this.escapeRegex(this.searchstr)})`, 'gi');
                    
                    // Apply highlighting to the plain text first
                    const highlightedPlainText = plainText.replace(searchRegex, '<span class="search-highlight">$1</span>');
                    
                    // If the original text had HTML, we need to preserve links but add highlighting
                    if (text !== plainText) {
                        // For HTML content, we'll highlight within the existing HTML structure
                        return text.replace(searchRegex, '<span class="search-highlight">$1</span>');
                    }
                    
                    return highlightedPlainText;
                },
                escapeRegex(string) {
                    return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
                },
                search(searchstr) {
                    if (!searchstr || !searchstr.trim()) {
                        // If search is empty, show all rows
                        this.dirs.forEach(element => {
                            element.visible = "visible";
                        });
                        return;
                    }
                    
                    this.dirs.forEach(element => {
                        const searchInDir = element.dir.toLowerCase().includes(searchstr.toLowerCase());
                        const searchInTitle = element.title && 
                            element.title.toLowerCase().includes(searchstr.toLowerCase());
                        const searchInDescription = element.description && 
                            this.stripHtml(element.description).toLowerCase().includes(searchstr.toLowerCase());
                        const searchInTags = element.tags && 
                            element.tags.some(tag => tag.toLowerCase().includes(searchstr.toLowerCase()));
                        
                        if (searchInDir || searchInTitle || searchInDescription || searchInTags) {
                            element.visible = "visible";
                        } else {
                            element.visible = "d-none";
                        }
                    });
                },
                async toggleRow(projectPath, event) {
                    // Prevent toggle if clicking on links or buttons
                    if (event.target.tagName === 'A' || event.target.tagName === 'BUTTON' || event.target.closest('.project-tag')) {
                        return;
                    }

                    if (this.expandedRows[projectPath]) {
                        // Collapse the row
                        delete this.expandedRows[projectPath];
                    } else {
                        // Expand the row and load files
                        this.expandedRows[projectPath] = {
                            files: [],
                            activeTab: null,
                            content: '',
                            loading: true,
                            error: null
                        };

                        try {
                            const availableFiles = await this.loadProjectFiles(projectPath);
                            this.expandedRows[projectPath].files = availableFiles;
                            
                            if (availableFiles.length > 0) {
                                // Load the first file by default
                                const firstFile = availableFiles[0].name;
                                this.expandedRows[projectPath].activeTab = firstFile;
                                await this.loadFileContent(projectPath, firstFile);
                            } else {
                                this.expandedRows[projectPath].loading = false;
                            }
                        } catch (error) {
                            this.expandedRows[projectPath].error = 'Error loading project files: ' + error.message;
                            this.expandedRows[projectPath].loading = false;
                        }
                    }
                },
                async loadProjectFiles(projectPath) {
                    try {
                        // Get all available files for this project in one request
                        const response = await fetch(`check_file.php?project=${encodeURIComponent(projectPath)}`);
                        const result = await response.json();
                        
                        if (result.files && Array.isArray(result.files)) {
                            return result.files.map(fileName => ({ name: fileName }));
                        } else {
                            console.error('Unexpected response from check_file.php:', result);
                            return [];
                        }
                    } catch (error) {
                        console.error(`Error loading files for project ${projectPath}:`, error);
                        return [];
                    }
                },
                async switchTab(projectPath, fileName) {
                    this.expandedRows[projectPath].activeTab = fileName;
                    await this.loadFileContent(projectPath, fileName);
                },
                async loadFileContent(projectPath, fileName) {
                    this.expandedRows[projectPath].loading = true;
                    this.expandedRows[projectPath].error = null;

                    try {
                        const response = await fetch(`get_file.php?project=${encodeURIComponent(projectPath)}&file=${encodeURIComponent(fileName)}`);
                        const result = await response.json();

                        if (result.content !== undefined) {
                            this.expandedRows[projectPath].content = result.content;
                        } else {
                            this.expandedRows[projectPath].error = 'Error loading file: ' + (result.error || 'Unknown error');
                        }
                    } catch (error) {
                        this.expandedRows[projectPath].error = 'Error loading file: ' + error.message;
                    } finally {
                        this.expandedRows[projectPath].loading = false;
                    }
                }
            }
        }).mount('#app');
    </script>

</body>

</html>
