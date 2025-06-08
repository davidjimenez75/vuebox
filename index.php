<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" href="./favicon.ico">
    <link rel="icon" type="image/png" href="./favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="./favicon-16x16.png" sizes="16x16" />

    <title>VueBox</title>

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
        }        /* Override Bootstrap 5 CSS variables for table backgrounds */
        .custom-table {
            --bs-table-bg: transparent;
        }
        
        /* Custom table styling - ensure background colors are applied */
        .custom-table tbody tr.project-row {
            /* Let inline styles take precedence */
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
    </style>

</head>

<body>
    <!-- Loading indicator shown while Vue.js is initializing -->
    <div id="loading" class="vue-loading">
        <div class="spinner-border spinner-border-custom text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p class="mt-3 text-muted">Loading VueBox...</p>
    </div>
    <div id="app" v-cloak><!--#app-->

        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">VueBox</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                    
                <!-- BEGIN - Navigation links and dropdowns imported from index-menu.md -->
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Vue 3</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="https://vuejs.org/guide/" target="_blank">Vue.js 3</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Vuex</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="https://vuex.vuejs.org/" target="_blank">Vuex</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Bootstrap 5</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="https://getbootstrap.com/docs/5.3/getting-started/introduction/" target="_blank">Bootstrap 5</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Examples
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="https://vuejs.org/examples/" target="_blank">Vue.js 3</a></li>
                                <li><a class="dropdown-item" href="https://vuex.vuejs.org/guide/" target="_blank">Vuex</a></li>
                                <li><a class="dropdown-item" href="https://getbootstrap.com/docs/5.3/examples/" target="_blank">Bootstrap 5</a></li>
                            </ul>
                        </li>
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
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" style="width: 100%">Folder Name & Description</th>
                            </tr>
                        </thead>
                        <tbody id="list">
                            <tr v-for="(value, index) in dirs" :key="index" :class="value.visible + ' project-row'" :style="getRowStyle(value)">
                                <td class="text-start p-3">
                                    <div class="project-title">
                                        <span class="text-muted me-2">[{{ value.dir }}]</span>
                                        <a :href="value.dir" class="text-decoration-none" v-html="highlightText(value.title)" :style="getTitleStyle(value)"></a>
                                    </div>
                                    <div v-if="value.description" class="project-description" v-html="formatDescription(value.description)"></div>
                                    <div v-if="value.tags && value.tags.length > 0" class="mt-2">
                                        <span v-for="tag in value.tags" :key="tag" 
                                              class="project-tag" 
                                              :style="getTagStyle(value, tag)"
                                              :title="getTagTooltip(tag)"
                                              @click="searchTag(tag)"
                                              v-html="highlightText(tag)">
                                        </span>
                                    </div>
                                </td>
                            </tr>
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
                    dirs: <?php
                            // Include color configuration
                            require_once 'config.php';
                            
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
                                    $project["title"] = $project["dir"]; // Default title
                                    $project["description"] = "";
                                    $project["tags"] = array();
                                    $project["background_color"] = "#ffffff"; // Default white background
                                    
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
                }
            }
        }).mount('#app');
    </script>

</body>

</html>
