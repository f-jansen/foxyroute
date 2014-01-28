<?php

/* Simple PHP Router with basic variables support.
   =============================================== 
        http://github.com/f-jansen/FoxyRoute       */

class FoxyRoute {
	
	private $path;
	private $vars;
	private $executed;
	
	public function __construct(){
		
		$this->executed = false;
		if (isset($_SERVER['PATH_INFO'])){
			$path = explode('/', $_SERVER['PATH_INFO']);
			$this->path = array_filter($path);
		}
	}
	
	public function Debug(){
		print_r('Path: ' . $this->path . '<br>');
		print_r('Vars: ' . $this->vars . '<br>');
	}
	
	public function Get($var){
		return $this->vars[$var];
	}
	
	public function Route($pattern, $function){
		
		if (!$this->executed){
		
			$pattern = array_filter(explode('/', $pattern));
			
			if (count($pattern) == 0 && count($pattern) == count($this->path)){
				$function($this);
			} else if (count($pattern) == count($this->path)){
				
				$i = 1;
				$matches = 0;
				foreach ($pattern as $p){
				
					$p2 = $this->path[$i];
				
					if ($this->startsWith($p, '{') && $this->endsWith($p, '}')){
					
						$this->vars[str_replace('{', '', str_replace('}', '', $p))] = $this->path[$i];
						$matches++;
						
					} else {
				
						if ($p == $this->path[$i]){
							$matches++;
						} else {
							break;
						}
					}
					$i++;
				}
				
				if($matches == count($this->path)){
					$this->executed = true;
					$function();
				}
			}
		}
	}
	
	function startsWith($haystack, $needle){
		return $needle === "" || strpos($haystack, $needle) === 0;
	}
	
	function endsWith($haystack, $needle){
		return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
	}
}

?>