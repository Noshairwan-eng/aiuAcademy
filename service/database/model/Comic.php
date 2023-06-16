<?php

class Comic
{
    public $mysqli;
    public $error;
    // Properties =================
    public $uid;    
    public $Title;
    public $Description;
    public $Image;    
    public $Creation;


    // Constructor================
    function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }
    //============================


     // Default DB Operations======
     function Select()
     {
        // Prepare the query string
        $query = "SELECT * FROM Comic WHERE 1=1 ";

        // Search criteria
        if (!empty($this->uid)) {
            $query .= " AND Comic.uid = ?";
        }
        if (!empty($this->Title)) {
            $query .= " AND Comic.Title = ?";
        }                

        // Prepare the statement
        $stmt = $this->mysqli->prepare($query);

        // Bind parameters
        $bind_params = array();
        $bind_types = '';
        if (!empty($this->uid)) {
            $stmt->bind_param('i', $this->uid);
        } 
        if (!empty($this->Title)) {
            $stmt->bind_param('s', $this->Title);
        }            
        
        // Executing the statement and fetching the result
        $stmt->execute();
        $res = $stmt->get_result();

        $data_array = array();
        while($data = mysqli_fetch_assoc($res))
        {
            if($data)
            {
                $data_array[] = $data;
            }
        }

        // Returning the result
        if($data_array)
        {
            return $data_array;
        }
        else
        {
            $this->error = $this->mysqli->error;
            return null;
        }
 
     }

     function Insert()
     {
         $columns = "";
         $values = array();
         $valuePlaceHolders = "";

        if ($this->Title != null) {
            $columns .= "Title,";
            $values[] = $this->Title;
            $valuePlaceHolders .= "?,";
        }
        
        if ($this->Description != null) {
            $columns .= "Description,";
            $values[] = $this->Description;
            $valuePlaceHolders .= "?,";
        }
        
        if ($this->Image != null) {
            $columns .= "Image,";
            $values[] = $this->Image;
            $valuePlaceHolders .= "?,";
        }      
                    
        // Remove the trailing comma from $columns and $valuePlaceHolders
        $columns = rtrim($columns, ",");
        $valuePlaceHolders = rtrim($valuePlaceHolders, ",");       
     
         // Trimming Extra Commans
         $columns = rtrim($columns, ',');
         //$values = rtrim($values,',');
         $valuePlaceHolders = rtrim($valuePlaceHolders,',');
     
         $query = "INSERT INTO Comic ($columns) VALUES ($valuePlaceHolders)";
     
         // prepare the statement with the dynamic query string
         $stmt = $this->mysqli->prepare($query);
     
         // bind the parameters to the statement
         if (count($values) > 0) {
             $types = str_repeat('s', count($values));
             $stmt->bind_param($types, ...$values);
         }
     
         // execute the statement
         if($stmt->execute()==true)
         {  
         
             $stmt->close();
             return true;
         }
         else
         {
         
             $stmt->close();
             $this->error = $this->mysqli->error;
             return null;
         }
     }

    function Update()
    {
        if($this->uid!=null)
        {
            $setValues = "";
            $values = array();                        

            // Check if Title is not null
            if ($this->Title != null) {
                $setValues .= "Title = ?,";
                $values[] = $this->Title;
            }

            // Check if Description is not null
            if ($this->Description != null) {
                $setValues .= "Description = ?,";
                $values[] = $this->Description;
            }

            // Check if Last Name is not null
            if ($this->Image != null) {
                $setValues .= "Image = ?,";
                $values[] = $this->Image;
            }     
                                     
            // Trimming Extra Commans
            $setValues = rtrim($setValues, ',');
            
            $query = "UPDATE Commic SET $setValues WHERE uid = ?";

            
                        
            // append the ID parameter value to the values array
            $values[] = $this->uid;

            // prepare the statement with the dynamic query string
            $stmt = $this->mysqli->prepare($query);

            // bind the parameters to the statement
            if (count($values) > 0) {
                $types = str_repeat('s', count($values));
                $stmt->bind_param($types, ...$values);
            }

            // execute the statement
            if($stmt->execute() == true)
            {  
                $stmt->close();
                return true;
            }
            else
            {
                $stmt->close();
                $this->error = $this->mysqli->error;
                return false;
            }
        }
        else
        {
            $this->error = "ID is not provided.";
            return false;
        }
    }
}
