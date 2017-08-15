<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" href="/images/favicon.ico">
    <link rel="icon" type="image/png" href="/images/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="/images/favicon-16x16.png" sizes="16x16" />


    <title>Vuex</title>

    <!--bower_Bootstrap4a6_css-->
    <link rel="stylesheet" href="/vendor/bootstrap/dist/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="/css/starter-template.css" rel="stylesheet">


  </head>
  <body>

    <nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse fixed-top">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">Vuex</a>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link2</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
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
        <h1>Vuex + Bootstrap starter template</h1>
        <p class="lead">Create new folders with the 3 firsts numeric characters.</p>


          <table class="table table-hover mytable">
              <thead class="thead-inverse">
              <tr>
                  <th class="d-inline-block col-1">#</th>
                  <th class="d-inline-block col-11">Description</th>
              </tr>
              </thead>
              <tbody>
<?php
$dir = '.';
$a_dirs  = scandir($dir);
$a_bg=array('primary','success','warning','danger','info','muted');
foreach ($a_dirs as $k=>$v)
{
    if (is_numeric(substr($v,0,3))) {
        $a_name=explode('--',$v);

        $css_tmp = 'table-success';
        if (sizeof($a_name)>2) {
            if (in_array($a_name[2], $a_bg)) {
                $css_tmp = ' table-' . $a_name[2];
            }
        }

        echo '<tr class="row m-0 '.$css_tmp.'" id="dir'.$a_name[0].'" onclick="window.document.location=\''.$v.'\';">'."\r\n";
        echo '<th class="d-inline-block col-1">'.$a_name[0].'</th>'."\r\n";
        echo '<td class="d-inline-block col-11 text-left">'.$a_name[1].'</td>'."\r\n";
        echo '</tr>'."\r\n";



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

    <!--bower_Bootstrap4a6_js-->
    <script src="/vendor/jquery/dist/jquery.slim.min.js"></script>
    <script src="/vendor/tether/dist/js/tether.min.js"></script>
    <script src="/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
 
    <!--bower_vue-->
    <script src="/vendor/vue/dist/vue.js"></script>
 
    <!--bower_vuex-->
    <script src="/vendor/vuex/dist/vuex.js"></script>
 
    <!--main-->
    <script src="/js/script.js"></script>   


</body>
</html>