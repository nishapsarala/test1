<?php

class SearchClass{	
       
        function getSrchFile(&$results = array()) { 
	        if(!empty($_REQUEST['search'])){ 
	        	if(!empty($results)){
		        	foreach ($results as $row) {

			        	echo "<br/>".$row["file_name"];
			        }
			    }
			    else{
			    	echo "No such a file / folder !!";
			    }
		    } 
		}  
    }