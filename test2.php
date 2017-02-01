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

<?php

include_once('semsol/ARC2.php'); /* ARC2 static class inclusion */ 

$config = array(
  /* db */
  'db_host' => 'localhost', /* optional, default is localhost */
  'db_name' => 'test',
  'db_user' => 'root',
  'db_pwd' => 'wuthiwat7',

  /* store name (= table prefix) */
  'store_name' => 'my_store',
);

/* instantiation */
$store = ARC2::getStore($config);

if (!$store->isSetUp()) {
  $store->setUp();
}

$query = '
		PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
		PREFIX ex:  <http://localhost/computer#>
		PREFIX owl: <http://www.w3.org/2002/07/owl#>
		SELECT DISTINCT ?laptop ?graphicSystem
		WHERE { 
			?x ex:hasGraphicSystem ex:'.$_GET["g"].'.
			?x ex:name ?laptop.
			ex:'.$_GET["g"].' ex:name ?graphicSystem
		}';
			
$rows = $store->query($query, 'rows'); /* execute the query */
 
  if ($errs = $store->getErrors()) {
     echo "Query errors" ;
     print_r($errs);
  }
?>
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
	<h2>PC - Notebook Spec.</h2>
	<h3>Notebook</h3>
	<div class="table-responsive">  
	<table class="table">
		<thead>
		  <tr>
			<th>Notebook</th>
			<th>Graphic System</th>
		  </tr>
		</thead>
		<tbody>
  
<?php
	foreach( $rows as $row ) { /* loop for each returned row */
		$g1 = explode("#",$row['g']);
         print "<tr><td>" . $row['laptop'] . "</td><td>" . 
							$row['graphicSystem'] . "</a></td></tr>";
	} 
?>
		</tbody>
	</table>
</div>
</div>

</body>
</html>