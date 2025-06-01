# VUEBOX v2025.06.01 - Vue.js Learning Sandbox

## Project Overview

VUEBOX is a comprehensive learning sandbox designed for exploring and practicing Vue.js development. This project provides a structured environment with multiple examples, templates, and utilities to help developers learn Vue.js concepts progressively.

Sandbox for learning Vue.js -> https://vuejs.org/

## Project Structure

```
vuebox/
├── README.md                 # Project documentation
├── package.json             # NPM dependencies
├── bower.json              # Bower dependencies (deprecated)
├── index.php               # Main project dashboard
├── .gitignore              # Git ignore rules
├── css/                    # Stylesheets
│   └── starter-template.css
├── images/                 # Project assets
│   ├── favicon.ico
│   ├── favicon-16x16.png
│   ├── favicon-32x32.png
│   └── vuejs.png
├── 1/                      # Markdown Editor Example
├── 2/                      # AJAX User List Example
└── zzz/                    # Base template for new examples
```

## Technology Stack

### Core Dependencies
- **Vue.js 3.5.16** - Progressive JavaScript framework
- **Bootstrap 5.3.6** - CSS framework for responsive design
- **Axios 1.9.0** - HTTP client for API requests
- **Vue Resource 1.5.3** - HTTP client plugin for Vue.js
- **Vuex 4.1.0** - State management pattern for Vue.js

### Development Tools
- **NPM** - Package manager
- **Yarn** - Package manager (recommended)
- **PNPM** - Fast, disk space efficient package manager
- **Bun** - Extremely fast runtime and package manager
- **Bower** - Package manager (deprecated, legacy support)

## Installation and Setup

### Prerequisites
- Node.js and npm/yarn/pnpm/bun
- Web server (Apache/Nginx) or local development server
- Git for version control

### Installation Steps

1. **Clone the Repository**
```bash
sudo -u www-data git clone https://github.com/davidjimenez75/vuebox.git
```

2. **Choose Your Package Manager**

#### OPTION 1 - INSTALLATION WITH NPM
```bash
sudo -u www-data npm install
```

#### OPTION 2 - INSTALLATION WITH YARN (Recommended)
```bash
sudo -u www-data yarn add axios bootstrap vue vuex vue-resource
sudo -u www-data yarn install
```

#### OPTION 3 - INSTALLATION WITH PNPM
```bash
sudo -u www-data pnpm install
```

#### OPTION 4 - INSTALLATION WITH BUN
```bash
sudo -u www-data bun install
```

3. **Start Development Server**
```bash
# If using a local server
php -S localhost:8000

# Or place in web server directory (e.g., /var/www/html/)
```

## Key Features

### 1. Interactive Dashboard (index.php)
- **Dynamic Directory Listing**: Automatically scans and displays all example directories
- **Color-coded Status System**: Visual indicators for different example types
  - Red (danger) - Critical or advanced examples
  - Orange (warning) - Intermediate examples
  - Blue (info/primary) - Informational examples
  - Green (success) - Basic or completed examples
- **Search Functionality**: Real-time filtering of examples
- **Responsive Design**: Bootstrap-powered responsive interface

### 2. Current Example Projects

#### Project 1: Markdown Editor
**Location**: `/1/`
**Status**: Success (Green)
**Description**: Markdown Editor Example

A real-time markdown editor demonstrating:
- **Two-way Data Binding**: Live preview of markdown content
- **Computed Properties**: Real-time markdown compilation
- **Event Handling**: Debounced input updates
- **External Libraries Integration**: Uses marked.js and lodash

**Key Vue.js Concepts Demonstrated:**
```javascript
// Computed properties for reactive data transformation
computed: {
  compiledMarkdown: function () {
    return marked(this.input, { sanitize: true })
  }
}

// Debounced methods for performance optimization
methods: {
  update: _.debounce(function (e) {
    this.input = e.target.value
  }, 300)
}
```

#### Project 2: AJAX User List
**Location**: `/2/`
**Status**: Success (Green)
**Description**: List users by ajax using a remote API - RANDOM USER GENERATOR [randomuser.me](http://randomuser.me/)

Demonstrates:
- **HTTP Requests**: Fetching data from external APIs
- **List Rendering**: Displaying dynamic data
- **Async Operations**: Handling API responses
- **External API Integration**: Working with randomuser.me API

#### Template Structure (zzz)
**Location**: `/zzz/`
**Status**: Primary (Blue)
**Description**: Reusable template folder, just made a copy and rename.

Provides a standardized starting point for new examples:
- Bootstrap integration
- Vue.js setup
- Commented sections for different libraries (Vue Resource, Vuex, Axios)
- Consistent styling and navigation

### 3. Organization System

#### Status Indicators
Examples can be categorized using special files:
- `index.danger.txt` - Red background (advanced/critical)
- `index.warning.txt` - Orange background (intermediate)
- `index.info.txt` - Light blue background (informational)
- `index.primary.txt` - Blue background (primary examples)
- `index.success.txt` - Green background (basic/completed)

#### Documentation
- `index.txt` - Contains description and notes for each example
- Supports HTML content for rich formatting
- Automatically displayed in the main dashboard

## Development Workflow

### Creating New Examples

1. **Copy Template**
```bash
cp -r zzz/ your-new-example/
```

2. **Customize Content**
- Edit `index.html` for structure
- Modify `index.js` for Vue.js logic
- Update `style.css` for custom styling

3. **Add Documentation**
- Create `index.txt` with example description
- Add status indicator file if needed

4. **Test Integration**
- Verify example appears in main dashboard
- Test functionality and responsiveness

### Best Practices

1. **Consistent Structure**: Follow the template pattern for all examples
2. **Progressive Complexity**: Start with basic concepts, advance gradually
3. **Documentation**: Always include clear descriptions and comments
4. **Responsive Design**: Ensure examples work on all device sizes
5. **Performance**: Use debouncing and optimization techniques where appropriate

## Educational Value

### Learning Path
1. **Basic Vue.js Concepts** (Template syntax, data binding)
2. **Component Communication** (Props, events)
3. **State Management** (Vuex integration)
4. **HTTP Requests** (Axios, Vue Resource)
5. **Advanced Patterns** (Mixins, custom directives)

### Key Vue.js Concepts Covered
- **Reactive Data Binding**
- **Computed Properties**
- **Methods and Event Handling**
- **Component Lifecycle**
- **Template Syntax**
- **Conditional Rendering**
- **List Rendering**
- **Form Input Bindings**
- **HTTP Client Integration**
- **External API Communication**

## FAQ

### How install Yarn in Debian/Ubuntu?

**YARN - STABLE VERSION:**

https://yarnpkg.com/en/docs/install#debian-stable

```bash
apt install curl
curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | sudo apt-key add -
echo "deb https://dl.yarnpkg.com/debian/ stable main" | sudo tee /etc/apt/sources.list.d/yarn.list
sudo apt update && sudo apt install yarn
yarn -v
```

**YARN - RELEASE CANDIDATE:**

https://yarnpkg.com/en/docs/install#debian-rc

```bash
apt install curl
curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | sudo apt-key add -
echo "deb https://dl.yarnpkg.com/debian/ rc main" | sudo tee /etc/apt/sources.list.d/yarn.list
sudo apt update && sudo apt install yarn
yarn -v
```

### Add color to folders?

Copy one of the root folder index.*.txt files inside the subfolder.

- index.danger.txt (red)
- index.warning.txt (orange)
- index.info.txt (light blue)
- index.primary.txt (blue)
- index.success.txt (green)

### Add small description to folders?

Create an index.txt file with your comments.

### Can I add links to external URL's on the comments?

Yes, just use a href html in the index.txt

## Browser Compatibility

- Modern browsers supporting ES6+
- Bootstrap 5 responsive breakpoints
- Vue.js 3.x compatibility requirements

## Contributing

### Adding New Examples
1. Follow the template structure
2. Include comprehensive documentation
3. Test across different browsers
4. Ensure responsive design
5. Add appropriate status indicators

### Code Standards
- Use consistent indentation (2 spaces)
- Include meaningful comments
- Follow Vue.js style guide
- Maintain Bootstrap grid system

## License

MIT License - See project repository for full license details.

## Additional Resources

- [Vue.js Official Documentation](https://vuejs.org/guide/)
- [Vuex Documentation](https://vuex.vuejs.org/en/)
- [Bootstrap 5 Documentation](https://getbootstrap.com/docs/5.3/getting-started/introduction/)
- [Vue.js Examples](https://vuejs.org/examples/)
- [Random User Generator API](http://randomuser.me/)

---

*This documentation was updated on 2025.06.01 to reflect the current project structure, installation options, and available examples.*
