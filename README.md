#Simple PHP Router with basic variables support.
http://github.com/f-jansen/FoxyRoute       
    

Provides basic routing functionality in one small class, for those that don't want or need to include
a more complex solution. Set up to work similarly to the routing in Silex, so familar users should have
no problem!

###Set up .htaccess variables for base directory and app file name:
```
RewriteRule . - [E=REWRITEBASE:/foxyroute/] ## <- Base directory!
RewriteRule . - [E=APP:example.php] ## <- App file name!
```
###Include and initialise:
```php
require_once 'foxyroute.php';
$foxy = new FoxyRoute();
```
###Route examples:

####Default Route
```php
$foxy->Route("/", function(){
	
	print("No route!");
});
```
####Basic Route
```php
$foxy->Route("/hello", function(){
	
	print("Hello!");
});
```

####Route with Variable
```php
$foxy->Route("/hello/{name}", function() use ($foxy){
	
	print("Hello, " . $foxy->Get('name') . '!');
});
```
