<!DOCTYPE html>
<html>
<head>
  <title>PC - Notebook Spec.</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="http://localhost/arc2/computer.php">PC-Notebook Spec.</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="http://localhost/arc2/computer.php">Home</a></li>
      <li><a href="#">Search</a></li>
      <li><a href="http://localhost/arc2/get_owl.php">Upload RDF/OWL</a></li>
    </ul>
  </div>
</nav>
<div class="container">
<?php

include_once('semsol/ARC2.php'); /* ARC2 static class inclusion */ 

$config = array(
  /* db */
  'db_host' => 'localhost', /* optional, default is localhost */
  'db_name' => 'pc',
  'db_user' => 'root',
  'db_pwd' => '',

  /* store name (= table prefix) */
  'store_name' => 'my_store',
);

/* instantiation */
$store = ARC2::getStore($config);

if (!$store->isSetUp()) {
  $store->setUp();
}
if ($store->query('LOAD <http://localhost/myPC/pc.rdf>')){
	print "<div class='alert alert-success'><strong>Success!</strong>Upload RDF/OWL file successful.</div>";
} else {
	print "<div class='alert alert-danger'><strong>unsuccessful!</strong>Could not load RDF/OWL file.</div>";
}
?>
</div>
</body>
</html>