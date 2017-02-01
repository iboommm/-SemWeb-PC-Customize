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

$query = '
		PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
		PREFIX ex:  <http://localhost/computer#>
		PREFIX owl: <http://www.w3.org/2002/07/owl#>
		SELECT DISTINCT ?v 
		WHERE { ?x rdf:type ex:1151.
				?x rdf:type ex:Render.
				?x   ex:name ?v.
		 }';
			
$rows = $store->query($query, 'rows'); /* execute the query */
 
  if ($errs = $store->getErrors()) {
     echo "Query errors" ;
     print_r($errs);
  }
	
?>
<h3>PC - Personal Computer</h3>
<div class="table-responsive">  
	<table class="table">
		<thead>
		  <tr>
			<th>PC</th>
			<th>CPU</th>
		  </tr>
		</thead>
		<tbody>
  
<?php
	foreach( $rows as $row ) { /* loop for each returned row */
         print "<tr><td>" . $row['Computer'] . "</td><td>" . 
							$row['v'] . "</td><td>";
	} 
?>
		</tbody>
	</table>
</div>

</div>

</body>
</html>