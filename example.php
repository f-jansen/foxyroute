<?php

/* Simple PHP Router with basic variables support.
   =============================================== 
        http://github.com/f-jansen/FoxyRoute       */

//Include
require_once 'foxyroute.php';

//Initialise
$foxy = new FoxyRoute();

//Default Route (example.com)
$foxy->Route("/", function(){
	
	print("No route!");
});

//Basic Route (example.com/hello)
$foxy->Route("/hello", function(){
	
	print("Hello!");
});

//Route with Variable (example.com/hello/tom)
$foxy->Route("/hello/{name}", function() use ($foxy){
	
	print("Hello, " . $foxy->Get('name') . '!');
});

/* NOTE:
The first matched route is executed, therefore '/{variable}' will match before {/test}
This means explicitly named routes should come before similar routes that accept a variable. */

?>