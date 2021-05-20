<?php
set_time_limit(1800);
class TextfileClass{	
	
        function getDirContents($dir, $filter = '', &$results = array()) {
		    if(file_exists($dir)){
			    $files = scandir($dir);
			    foreach($files as $key => $value){
			        $path = realpath($dir.DIRECTORY_SEPARATOR.$value); 

			        if(!is_dir($path)) {
			            if(empty($filter) || preg_match($filter, $path)) $results[] = $path;
			        } elseif($value != "." && $value != "..") {
			            $this->getDirContents($path, $filter, $results);
			        }
			    }
			}
			else{
				$results=array();
			}
		    return $results;
		}  


    }