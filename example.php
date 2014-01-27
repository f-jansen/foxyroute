<?php

require_once 'foxyroute.php';

$foxy = new FoxyRoute();


$foxy->Route("/hello", function($foxy){
	
	print("Hello!");
	
});

$foxy->Route("/hello/{name}", function($foxy){
	
	print("Hello, " . $foxy->Get('name') . '!');
	
});

?>