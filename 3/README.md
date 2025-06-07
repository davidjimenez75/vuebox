# Project 3: WYSIWYG Editor for TODO.md

This project is an advanced TODO task editor with WYSIWYG (What You See Is What You Get) functionality for Markdown files.

## Features

* Visual WYSIWYG editor for intuitive task editing
* Traditional Markdown code editing mode
* Real-time content preview
* Support for tasks with multi-line comments and subtasks
* Automatic separators between tasks (80 dashes by default)
* Save and load TODO.md files
* Responsive and modern interface with Bootstrap
* Add tasks functionality through modal form

## Technologies Used

* HTML5
* CSS3 with Bootstrap 5
* JavaScript ES6+
* Vue.js 3 (via CDN)
* Marked.js (for Markdown parsing)
* Font Awesome (icons)
* CodeMirror (code editor)

## File Structure

```
3/
├── index.html          # Main application page
├── index.js           # Vue.js application logic
├── style.css          # Custom styles
├── TODO.md           # Default task file
├── README.md         # This file (English documentation)
└── README.es.md      # Spanish documentation
```

## How to Use

1. Open `index.html` in a modern web browser
2. The application will automatically load the `TODO.md` file
3. Use WYSIWYG mode for visual editing or switch to code mode
4. Add new tasks with the "New Task" button
5. Save changes using the "Save" button

## Editor Features

### WYSIWYG Mode
- Direct visual content editing
- Toolbar with formatting options
- Button to add new structured tasks
- Automatic separator insertion

### Code Mode
- Plain text editor for Markdown
- Syntax highlighting
- Direct source code editing

### Preview
- Real-time Markdown rendering
- Custom styles for better readability
- Full support for task checkboxes

## Task Format

Each task follows this structure:

```markdown
--------------------------------------------------------------------------------

## Task Title

### Description
Detailed description of the task.

### Comments
Additional comments that can be
multi-line.

### Subtasks
- [ ] First subtask
- [ ] Second subtask
- [ ] Third subtask
```

## System Requirements

- Modern web browser with ES6+ support
- Internet connection to load CDN libraries
- JavaScript enabled

## Customization

The `style.css` file contains all customizable styles:
- Theme colors
- Font sizes
- Spacing and layout
- Animation effects

## Known Limitations

- Save functionality downloads the file locally
- Requires internet connection for CDN libraries
- HTML to Markdown conversion is basic and may require manual adjustments

## Enhanced Features

- **Full browser window height**: Editors adapt to full window size
- **Proper subtask rendering**: Subtasks display as separate lines with correct formatting
- **Color-coded tasks**: Task titles in BLUE, subtasks in RED for better visual distinction
- **Responsive design**: Works on desktop and mobile devices
- **Real-time synchronization**: Changes sync between WYSIWYG and code modes

## Installation and Usage

No additional installation required. Simply:

1. Download all files to a folder
2. Open `index.html` in your preferred browser
3. Start editing your tasks!

## Contributing

This project is part of a Vue.js examples collection. To contribute:

1. Review existing code
2. Maintain consistent documentation style
3. Test across multiple browsers
4. Update documentation as needed
