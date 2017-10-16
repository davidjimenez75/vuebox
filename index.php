<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" href="/images/favicon.ico">
    <link rel="icon" type="image/png" href="/images/favicon-32x32.png" sizes="32x32"/>
    <link rel="icon" type="image/png" href="/images/favicon-16x16.png" sizes="16x16"/>


    <title>VueBox</title>

    <!--bower_Bootstrap4a6_css-->
    <link rel="stylesheet" href="/vendor/bootstrap/dist/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="/css/starter-template.css" rel="stylesheet">


</head>
<body>

<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse fixed-top">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">VueBox</a>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://vuejs.org/v2/guide/" target="_blank">Vue.js 2</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://vuex.vuejs.org/en/" target="_blank">Vuex</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://v4-alpha.getbootstrap.com/getting-started/introduction/"
                   target="_blank">Bootstrap 4</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true"
                   aria-expanded="false">Examples</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="https://vuejs.org/v2/examples/" target="_blank">Vue.js 2</a>
                    <a class="dropdown-item" href="https://vuex.vuejs.org/en/getting-started.html"
                       target="_blank">Vuex</a>
                    <a class="dropdown-item" href="https://v4-alpha.getbootstrap.com/examples/" target="_blank">Bootstrap
                        4</a>
                </div>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>

<div class="container">

    <div class="starter-template">
        <br><br>
        <!--
                <h1>VueBox = SandBox * ( Vue.js 2 + Vuex + Bootstrap 4 )</h1>
                <p class="lead">Create new folders with the 3 firsts numeric characters.</p>
        -->


        <table class="table table-hover mytable">
            <thead class="thead-inverse">
            <tr>
                <th class="d-inline-block col-6">Folder</th>
                <th class="d-inline-block col-6">Description</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $dir = '.';
            $descriptionFile = "index.txt";

            $a_dirs = scandir($dir);
            $a_bg = array('primary', 'success', 'warning', 'danger', 'info', 'muted');
            $ignoredFolders = array('.', '..', '.git', '.idea', '.svn', 'css', 'images', 'js', 'vendor');
            foreach ($a_dirs as $k => $v) {
                if ((is_dir($v)) && !in_array($v, $ignoredFolders)) {
                    $css_tmp = 'table-primary';
                    foreach ($a_bg as $item) {
                        if (file_exists($v . "/" . $item . '.txt')) {
                            $css_tmp = 'table-' . $item;
                        }
                    }

                    // FOLDER COLOR
                    if (file_exists($v . "/" . $descriptionFile)) {
                        $t = file_get_contents($v . "/" . $descriptionFile);
                    } else {
                        $t = "No description.";
                    }

                    echo '<tr class="row m-0 ' . $css_tmp . '" id="dir' . $v . '" onclick="window.document.location=\'' . $v . '\';">' . "\r\n";
                    echo '<th class="d-inline-block col-6">' . $v . '</th>' . "\r\n";

                    if (file_exists($v . "/" . $descriptionFile)) {
                        $t = file_get_contents($v . "/" . $descriptionFile);
                    } else {
                        $t = "No description.";
                    }
                    echo '<td class="d-inline-block col-6 text-left"><small>' . nl2br($t) . '</small></td>' . "\r\n";
                    echo '</tr>' . "\r\n";
                }
            }

            ?>
            </tbody>
        </table>


    </div>

</div><!-- /.container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<!--BOOTSTRAP-->
<script src="/vendor/jquery/dist/jquery.slim.min.js"></script>
<script src="/vendor/tether/dist/js/tether.min.js"></script>
<script src="/vendor/bootstrap/dist/js/bootstrap.min.js"></script>

<!--VUE-->
<script src="/vendor/vue/dist/vue.js"></script>

<!--VUE-RESOURCE-->
<!--
<script src="/vendor/vue-resource/dist/vue-resource.js"></script>
-->

<!--VUEX-->
<!--
<script src="/vendor/vuex/dist/vuex.js"></script>
-->

<!--AXIOS-->
<!--
<script src="/vendor/axios/dist/axios.js"></script>
-->

<!--main-->
<script src="/js/script.js"></script>


</body>
</html>
