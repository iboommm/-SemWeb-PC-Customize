<?php

if(isset($_GET['part'])) {
    $part =  $_GET['part'];
    if($part == "CPU" || $part == "Mainboard") {
        $ex = " ?socket";
        $ex2 = " ?x   ex:socket ?socket .";
    }else {
        $ex = "";
        $ex2 = "";
    }
    if($part == "Mainboard" || $part == "RAM") {
        $ex .= " ?ddr";
        $ex2 .= " ?x   ex:ddr ?ddr .";
    }
    
}else {
    exit("Access Denied");
}

$tag = "";
if(isset($_GET['tag']) && strlen($_GET['tag']) != 0) {
    $tag = $_GET['tag'];
    $tag_ar = explode(",",$tag);
    $tag="";
    foreach( $tag_ar as $t )  {
        $tag.= " ?x rdf:type ex:$t . ";
    }
}

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
		SELECT DISTINCT ?v ?v2 $v3'.$ex.'
		WHERE { ?x rdf:type ex:'.$part.' .
            '.$tag.'
            ?x   ex:name ?v.
            ?x   ex:price ?v2.
            ?x   ex:fname ?v3.
            '.$ex2.'
		 }';
			
$rows = $store->query($query, 'rows'); /* execute the query */
 
  if ($errs = $store->getErrors()) {
     echo "Query errors" ;
     print_r($errs);
  }
$i= 0;
foreach( $rows as $row ) { 
         $export[$i]['name'] = $rows[$i]['v'];
         $export[$i]['price'] = $rows[$i]['v2'];
         $export[$i]['img'] = $rows[$i]['v3'];
         if($part == "CPU" || $part == "Mainboard") {
             $export[$i]['socket'] = $rows[$i]['socket'];
         }
        if($part == "Mainboard" || $part == "RAM") {
            $export[$i]['ddr'] = $rows[$i]['ddr'];
        }
         $i++;
} 

if($rows == null) {
    $export['data'] = null;
}
print json_encode($export);