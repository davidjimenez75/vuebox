<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" href="./images/favicon.ico">
    <link rel="icon" type="image/png" href="/images/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="/images/favicon-16x16.png" sizes="16x16" />

    <title>VueBox</title>

    <!--BOOTSTRAP 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="./css/starter-template.css" rel="stylesheet">

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
                    <form class="d-flex" role="search" @submit.prevent="search(searchstr)">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" v-model="searchstr">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="starter-template">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" style="width: 20%">Status</th>
                                <th scope="col" style="width: 80%">Script & Description</th>
                            </tr>
                        </thead>
                        <tbody id="list">
                            <tr v-for="(value, index) in dirs" :key="index" :class="value.visible">
                                <td class="text-center">
                                    <span :class="'badge ' + getBadgeClass(value.status)">{{ getStatusText(value.status) }}</span>
                                </td>
                                <td class="text-start">
                                    <a :href="value.dir" class="text-decoration-none fw-semibold">{{ value.dir }}</a>
                                    <span v-if="value.description" class="text-muted ms-2" v-html="value.description"></span>
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
                            // GET DIRECTORY TO VUE 3 DATA ARRAY
                            $dir = '.';
                            $descriptionFile = "index.txt";

                            $a_bg = array('primary', 'success', 'warning', 'danger', 'info', 'muted');
                            $ignoredFolders = array('.', '..', '.git', '.idea', '.svn', 'css', 'images', 'js', 'vendor', 'images', 'node_modules');

                            $a_dirs = array();

                            $directories = glob('*', GLOB_ONLYDIR);
                            natsort($directories);
                            foreach ($directories as $dir) {
                                if (!in_array($dir, $ignoredFolders)) {
                                    $a_dirs[]["dir"] = (string) basename($dir);
                                }
                            }

                            foreach ($a_dirs as $key => $value) {
                                if (file_exists("./" . $value["dir"] . "/index.danger.txt")) {
                                    $a_dirs[$key]["status"] = "danger";
                                } elseif (file_exists("./" . $value["dir"] . "/index.warning.txt")) {
                                    $a_dirs[$key]["status"] = "warning";
                                } elseif (file_exists("./" . $value["dir"] . "/index.info.txt")) {
                                    $a_dirs[$key]["status"] = "info";
                                } elseif (file_exists("./" . $value["dir"] . "/index.primary.txt")) {
                                    $a_dirs[$key]["status"] = "primary";
                                } elseif (file_exists("./" . $value["dir"] . "/index.success.txt")) {
                                    $a_dirs[$key]["status"] = "success";
                                } else {
                                    $a_dirs[$key]["status"] = "muted";
                                }

                                // VISIBLE CLASS FOR SEARCH
                                $a_dirs[$key]["visible"] = "visible";

                                // DESCRIPTIONS FOR EVERY FOLDER
                                $description_file = "index.txt";
                                if (file_exists("./" . $value["dir"] . "/$description_file")) {
                                    $a_dirs[$key]["description"] = file_get_contents("./" . $value["dir"] . "/$description_file");
                                    $a_dirs[$key]["description"] = nl2br($a_dirs[$key]["description"]);
                                }
                            }

                            echo json_encode($a_dirs, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
                            ?>
                }
            },
            mounted() {
                // Hide loading indicator once Vue is mounted
                const loadingElement = document.getElementById('loading');
                if (loadingElement) {
                    loadingElement.style.display = 'none';
                }
            },
            methods: {
                getBadgeClass(status) {
                    switch(status) {
                        case "danger": return "bg-danger";
                        case "warning": return "bg-warning text-dark";
                        case "info": return "bg-info text-dark";
                        case "primary": return "bg-primary";
                        case "success": return "bg-success";
                        default: return "bg-secondary";
                    }
                },
                getStatusText(status) {
                    switch(status) {
                        case "danger": return "Error";
                        case "warning": return "Warning";
                        case "info": return "Info";
                        case "primary": return "Primary";
                        case "success": return "Success";
                        default: return "Normal";
                    }
                },
                thClassValue(status) {
                    if (status == "danger") {
                        return ('bg-danger text-white')
                    } else if (status == "warning") {
                        return ('bg-warning text-dark')
                    } else if (status == "info") {
                        return ('bg-info text-dark')
                    } else if (status == "primary") {
                        return ('bg-primary text-white')
                    } else if (status == "success") {
                        return ('bg-success text-white')
                    } else {
                        return ('bg-light text-dark')
                    }
                },
                search(searchstr) {
                    this.dirs.forEach(element => {
                        if (element.dir.toLowerCase().includes(searchstr.toLowerCase())) {
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
