# VUEBOX v2025.06.01

Sandbox for learning Vue.js -> https://vuejs.org/


## INSTALLATION

Getting started with VUEBOX is simple. First, download the repository from GitHub, then choose your preferred package manager for installing dependencies.

Clone repo from GitHub:

```bash
sudo -u www-data git clone https://github.com/davidjimenez75/vuebox.git
```

## OPTION 1 - INSTALLATION WITH NPM

Install dependencies with npm:

```bash
sudo -u www-data npm install
```

## OPTION 2 - INSTALLATION WITH YARN

Install dependencies with Yarn:

```bash
sudo -u www-data yarn add axios bootstrap vue vuex vue-resource
sudo -u www-data yarn install
```

## OPTION 3 - INSTALLATION WITH PNPM

Install dependencies with pnpm (fast, disk space efficient package manager):

```bash
sudo -u www-data pnpm install
```

## OPTION 4 - INSTALLATION WITH BUN

Install dependencies with Bun (extremely fast runtime and package manager):

```bash
sudo -u www-data bun install
```

## Contributing & Feature Ideas

We welcome contributions and ideas to improve VUEBOX!
If you have suggestions for new features or improvements to existing examples, please check out our [list of feature ideas](./FEATURE_IDEAS.md). You can contribute by opening an issue or submitting a pull request.

## FAQ

### How install Yarn in Debian/Ubuntu?

YARN - STABLE VERSION:

https://yarnpkg.com/en/docs/install#debian-stable

```
apt install curl
curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | sudo apt-key add -
echo "deb https://dl.yarnpkg.com/debian/ stable main" | sudo tee /etc/apt/sources.list.d/yarn.list
sudo apt update && sudo apt install yarn
yarn -v
```

YARN - RELEASE CANDIDATE:

https://yarnpkg.com/en/docs/install#debian-rc

```
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
 - index.success.txt  (green)

### Add small description to folders?

Create an index.txt file with your comments.

### Can I add links to external URL's on the comments?

Yes, just use a href html in the index.txt
```
