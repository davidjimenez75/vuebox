# VUEBOX v2025.06.01

Sandbox for learning Vue.js -> https://vuejs.org/

## INSTALLATION WITH YARN

Clone repo from GitHub:

```bash
sudo -u www-data git clone https://github.com/davidjimenez75/vuebox.git
```

Install dependencies with Yarn:

```bash
sudo -u www-data yarn add axios bootstrap vue vuex vue-resource
sudo -u www-data yarn install
```



### BOWER INSTALLATION (DEPRECATED)

Install dependencies with bower.

```bash
sudo -u www-data bower install
```



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