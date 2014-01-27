<?php

class FoxyRoute {
	
	private $path;
	private $vars;
	
	public function __construct(){
		
		$path = explode('/', $_SERVER['PATH_INFO']);
		$this->path = array_filter($path);
	}
	
	public function Debug(){
		print_r($this->vars);
	}
	
	public function Get($var){
		return $this->vars[$var];
	}
	
	public function Route($pattern, $function){
		
		$pattern = array_filter(explode('/', $pattern));
		
		if (count($pattern) == count($this->path)){
			
			$i = 1;
			$matches = 0;
			foreach ($pattern as $p){
			
				$p2 = $this->path[$i];
			
				if ($this->startsWith($p, '{') && $this->endsWith($p, '}')){
					
					$p = str_replace('{', '', str_replace('}', '', $p));
					
					$this->vars[$p] = $this->path[$i];
					
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
				$function($this);
			}
		}
	}
	
	function startsWith($haystack, $needle)	{
		return $needle === "" || strpos($haystack, $needle) === 0;
		}
	function endsWith($haystack, $needle)	{
		return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
	}
}



?>