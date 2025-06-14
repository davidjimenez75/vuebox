<?php
/**
 * VueBox Configuration File
 * 
 * This file contains configuration settings for the VueBox project listing system.
 * You can customize the colors and styling by editing the values below.
 */

// Define he title of the page
$title = 'VueBox';
// Define the main menu first item
$menu_first_item = 'Vuebox';
// Define the main menu first item url
$menu_first_item_url = '#';
// Define the description of the page
$description = 'VueBox is a sandbox for learning Vue.js';
// Define the author of the page
$author = 'VueBox Team';
// Define the base URL for the project
$base_url = '#';
// Define the path to the logo image
$logo_path = './favicon.png';


// Tags configuration
// Each tag corresponds to a project category and is associated with a color scheme
$tags_colors = [
    'axios' => [
        'name' => 'Axios - Promise based HTTP client for the browser and Node.js',
        'color' => 'blue'
    ],
    'api' => [
        'name' => 'API - Application Programming Interface',
        'color' => 'blue'
    ],
    'markdown' => [
        'name' => 'Markdown - A lightweight markup language',
        'color' => 'green'
    ],
    'vue' => [
        'name' => 'Vue.js - A progressive JavaScript framework',
        'color' => 'blue'
    ],
    'vue3' => [
        'name' => 'Vue 3 - The latest version of Vue.js',
        'color' => 'blue'
    ],
    'vuex' => [
        'name' => 'Vuex - State management pattern + library for Vue.js applications',
        'color' => 'blue'
    ],
    'marked' => [
        'name' => 'Marked - A markdown parser and compiler',
        'color' => 'purple'
    ],
    'lodash' => [
        'name' => 'Lodash - A modern JavaScript utility library',
        'color' => 'orange'
    ],
    'random' => [
        'name' => 'Random - Random number generation',
        'color' => 'pink'
    ],
    'sandbox' => [
        'name' => 'A Sandbox - A safe environment for testing and learning',
        'color' => 'blue'
    ],
    'template' => [
        'name' => 'Template - A template engine for JavaScript',
        'color' => 'gray'
    ],
    'high' => [
        'name' => 'High Priority',
        'color' => 'red'
    ],
    'medium' => [
        'name' => 'Medium Priority',
        'color' => 'yellow'
    ],
    'med' => [
        'name' => 'Medium Priority',
        'color' => 'yellow'
    ],
    'medium-high' => [
        'name' => 'Medium-High Priority',
        'color' => 'orange'
    ],
    'low' => [
        'name' => 'Low Priority',
        'color' => 'green'
    ],
    'easy' => [
        'name' => 'Easy Task',
        'color' => 'green'
    ],
    'error' => [
        'name' => 'Error - Issue tracking and fixing',
        'color' => 'red'
    ],
    'errors' => [
        'name' => 'Errors - Issues tracking and fixing',
        'color' => 'red'
    ],
    'bug' => [
        'name' => 'Bug - Issue and bug tracking',
        'color' => 'red'
    ],
    'bugs' => [
        'name' => 'Bugs - Issues and bug tracking',
        'color' => 'red'
    ],
    'testing' => [
        'name' => 'Testing - Quality assurance and testing',
        'color' => 'yellow'
    ],
    'todo' => [
        'name' => 'To-Do - Task to be completed',
        'color' => 'red'
    ],
    'todos' => [
        'name' => 'To-Dos - Tasks to be completed',
        'color' => 'red'
    ],
    'to-do' => [
        'name' => 'To-Do - Task to be completed',
        'color' => 'red'
    ],
    'to-dos' => [
        'name' => 'To-Do - Tasks to be completed',
        'color' => 'red'
    ],
    'wip' => [
        'name' => 'Work in Progress - Tasks to be completed',
        'color' => 'orange'
    ],
    'done' => [
        'name' => 'Done - Completed task ',
        'color' => 'green'
    ],
    'debug' => [
        'name' => 'Debug - Debugging tasks',
        'color' => 'purple'
    ],
    'typos' => [
        'name' => 'Typos - Spelling and grammar corrections',
        'color' => 'gray'
    ],
    'typo' => [
        'name' => 'Typo - Minor spelling errors',
        'color' => 'gray'
    ],
    'frontend' => [
        'name' => 'Frontend - Client-side development',
        'color' => 'blue'
    ],
    'backend' => [
        'name' => 'Backend - Server-side development',
        'color' => 'blue'
    ],
    'mobile' => [
        'name' => 'Mobile - Mobile application development',
        'color' => 'blue'
    ],
    'design' => [
        'name' => 'Design - User interface and experience design',
        'color' => 'blue'
    ],
    'data' => [
        'name' => 'Data - Data management and analysis',
        'color' => 'blue'
    ],
    'marketing' => [
        'name' => 'Marketing - Digital marketing strategies',
        'color' => 'blue'
    ],    'other' => [
        'name' => 'Other - Miscellaneous projects',
        'color' => 'blue'
    ],
    // Color tags for direct color assignment
    'green' => [
        'name' => 'Green - Projects with green theme',
        'color' => 'green'
    ],
    'blue' => [
        'name' => 'Blue - Projects with blue theme',
        'color' => 'blue'
    ],
    'red' => [
        'name' => 'Red - Projects with red theme',
        'color' => 'red'
    ],
    'yellow' => [
        'name' => 'Yellow - Projects with yellow theme',
        'color' => 'yellow'
    ],
    'purple' => [
        'name' => 'Purple - Projects with purple theme',
        'color' => 'purple'
    ],
    'orange' => [
        'name' => 'Orange - Projects with orange theme',
        'color' => 'orange'
    ],
    'pink' => [
        'name' => 'Pink - Projects with pink theme',
        'color' => 'pink'
    ],
    'gray' => [
        'name' => 'Gray - Projects with gray theme',
        'color' => 'gray'
    ]
];


// Background colors for project rows
// Each color corresponds to a specific tag and is used for the background of project rows
$background_colors = array(
    'green' => '#d4edda',      // Light green background
    'blue' => '#d1ecf1',       // Light blue background 
    'red' => '#f5b5b5',        // Darker and more visible red background
    'yellow' => '#fff3cd',     // Light yellow background
    'purple' => '#e2d9f3',     // Light purple background
    'orange' => '#ffe8d1',     // Light orange background
    'pink' => '#f8d7e9',       // Light pink background
    'gray' => '#c0c2c4',       // More visible and darker light gray background   
    'black' => '#5a6268'       // Slightly lighter dark background for black tag
);


// Color configuration for #tags
// Each color maps to CSS classes and background colors for project rows
$colors = [
    'green' => [
        'bg_color' => '#d4edda',      // Light green background
        'text_color' => '#155724',    // Dark green text
        'tag_bg' => '#28a745',        // Tag background
        'tag_text' => '#ffffff'       // Tag text color
    ],
    'blue' => [
        'bg_color' => '#d1ecf1',      // Light blue background
        'text_color' => '#0c5460',    // Dark blue text
        'tag_bg' => '#17a2b8',        // Tag background
        'tag_text' => '#ffffff'       // Tag text color
    ],
    'red' => [
        'bg_color' => '#f8d7da',      // Light red background
        'text_color' => '#721c24',    // Dark red text
        'tag_bg' => '#dc3545',        // Tag background
        'tag_text' => '#ffffff'       // Tag text color
    ],
    'yellow' => [
        'bg_color' => '#fff3cd',      // Light yellow background
        'text_color' => '#856404',    // Dark yellow text
        'tag_bg' => '#ffc107',        // Tag background
        'tag_text' => '#212529'       // Tag text color
    ],
    'purple' => [
        'bg_color' => '#e2d9f3',      // Light purple background
        'text_color' => '#4a148c',    // Dark purple text
        'tag_bg' => '#6f42c1',        // Tag background
        'tag_text' => '#ffffff'       // Tag text color
    ],
    'orange' => [
        'bg_color' => '#ffe8d1',      // Light orange background
        'text_color' => '#8a4100',    // Dark orange text
        'tag_bg' => '#fd7e14',        // Tag background
        'tag_text' => '#ffffff'       // Tag text color
    ],
    'pink' => [
        'bg_color' => '#f8d7e9',      // Light pink background
        'text_color' => '#6d1a36',    // Dark pink text
        'tag_bg' => '#e83e8c',        // Tag background
        'tag_text' => '#ffffff'       // Tag text color
    ],
    'gray' => [
        'bg_color' => '#f8f9fa',      // Light gray background
        'text_color' => '#495057',    // Dark gray text
        'tag_bg' => '#6c757d',        // Tag background
        'tag_text' => '#ffffff'       // Tag text color
    ],
    'grey' => [
        'bg_color' => '#f8f9fa',      // Light gray background
        'text_color' => '#495057',    // Dark gray text
        'tag_bg' => '#6c757d',        // Tag background
        'tag_text' => '#ffffff'       // Tag text color
    ],
    'black' => [
        'bg_color' => '#343a40',      // Dark background
        'text_color' => '#ffffff',    // White text
        'tag_bg' => '#000000',        // Black tag background
        'tag_text' => '#ffffff'       // White tag text
    ]
];

// Default color scheme for projects without color tags
$default_color = [
    'bg_color' => '#ffffff',      // White background
    'text_color' => '#212529',    // Dark text
    'tag_bg' => '#6c757d',        // Gray tag background
    'tag_text' => '#ffffff'       // White tag text
];






// Files that should be displayed when expanding project rows
// Add any file extensions or specific filenames you want to show
$viewed_files = [
    'README.md',
    'README.es.md',
    'LEEME.md',    
    'TODO.md',
    'CHANGELOG.md',
    'package.json',
    'bower.json',
    'composer.json'
];

?>