<?php
	class DatabaseClass{	
	
        public $connection = null;

        public function __construct( $dbhost = "", $dbname = "", $username = "", $password = ""){

            try{
			
                $this->connection = new mysqli($dbhost, $username, $password, $dbname);
				
				if( mysqli_connect_errno() ){
					throw new Exception("Could not connect to database.");   
				}

				$query_data = "CREATE TABLE `file_data` (
				  `id` int(10) NOT NULL AUTO_INCREMENT,
				  `file_name` varchar(255) NOT NULL,PRIMARY KEY (id)
				)";

				$query_path = "CREATE TABLE `folder_path` (
				  `id` int(10) NOT NULL AUTO_INCREMENT,
				  `folder_path` varchar(255) NOT NULL,PRIMARY KEY (id)
				)";

				$this->connection->query($query_data); 
				$this->connection->query($query_path);

	        	$this->connection->query("Insert into folder_path (id,folder_path) values (1,'C:/')"); 


            }catch(Exception $e){
                throw new Exception($e->getMessage());   
            }			
			
        }
		
        // Insert a row/s in a Database Table
        public function Insert( $query = "" , $params = [] ){
            
			try{
				
				$stmt = $this->executeStatement( $query , $params );
				$stmt->close();
				
				return $this->connection->insert_id;
				
			}catch(Exception $e){
				throw New Exception( $e->getMessage() );
			}
			
			return false;
			
        }

        // For run custom Query
        public function CustomQuery( $query = "" , $params = [] ){
			
			try{
				
				$stmt = $this->executeStatement( $query , $params );
				
				$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);				
				$stmt->close();
				
				return $result;
				
			}catch(Exception $e){
				throw New Exception( $e->getMessage() );
			}
			
			return false;
        }

        // Select a row/s in a Database Table
        public function Select( $table = "" , $field ="" , $where ="" ,$condition ="", $params = []){
			
			try{

				$query = "select $field from $table where $where=$condition";
				$stmt = $this->executeStatement( $query , $params );
				$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);				
				$stmt->close();
				
				return $result;
				
			}catch(Exception $e){
				throw New Exception( $e->getMessage() );
			}
			
			return false;
        }
		
        // Update a row/s in a Database Table
        public function Update( $table = "" , $field ="" ,$val ="", $where ="" ,$condition ="", $params = [] ){
            
            try{

				$query = "Update $table set $field='$val' where $where=$condition";
				$this->executeStatement( $query , $params )->close();
				
			}catch(Exception $e){
				throw New Exception( $e->getMessage() );
			}
			
			return false;
        }		
		
        // Remove a row/s in a Database Table
        public function Remove( $query = "" , $params = [] ){
            
            try{
				
				$this->executeStatement( $query , $params )->close();
				
			}catch(Exception $e){
				throw New Exception( $e->getMessage() );
			}
			
			return false;
        }		
        
        // execute statement
        private function executeStatement( $query = "" , $params = [] ){
			
			try{
				
				$stmt = $this->connection->prepare( $query );
				
				if($stmt === false) {
					throw New Exception("Unable to do prepared statement: " . $query);
				}
				
				if( $params ){					
					call_user_func_array(array($stmt, 'bind_param'), $params );
				}
				
				$stmt->execute();
				
				return $stmt;
				
			}catch(Exception $e){
				throw New Exception( $e->getMessage() );
			}
			
        }
		
    }