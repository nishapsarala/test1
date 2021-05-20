<?php

	require_once 'DatabaseClass.php';
    require_once 'DBConnection.php';
    require_once 'TextfileClass.php';
    require_once 'SearchClass.php';

    $txtFile = new TextfileClass();
    $searchFile = new SearchClass();

    $rows= $db->Select('folder_path','folder_path','id',1);
    foreach ($rows as $row) {
        $folder_path= $row["folder_path"];
    }
    
    $fp = fopen("data/file_data.txt", 'w');
    $i=0;
    $db->Remove("truncate table file_data");
	
	if(file_exists($folder_path)){ 

	    foreach($txtFile->getDirContents($folder_path) as $datas){
	    	$i++;
	        $data = $i.",".$datas.PHP_EOL;
	        fwrite($fp, $data);
	        $val =  str_replace('\\','/',$datas);  
	        $db->Insert("Insert into file_data (file_name) values ('$val')"); 
	    }
	    fclose($fp);
	}
	else{
		echo "<p>Directory '".$folder_path."' Not Exist.</p>";
	}

    if(isset($_REQUEST['update'])){ 
        $path = $_REQUEST['path'];
	    $val =  str_replace('\\','/',$path);   

        $db->Update("folder_path","folder_path","$val","id",1);
        header("Refresh:0");
    }

    if(isset($_REQUEST['search'])){  
        $filter = $_REQUEST['search'];
        $rows= $db->CustomQuery("select file_name from file_data  where file_name like '%$filter%'");
    }

?>