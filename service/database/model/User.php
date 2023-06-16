<?php
//include("../config/database.php");

class User
{
    public $mysqli;
    public $error;
    // Properties================
    public $uid;
    public $FirstName;
    public $LastName;
    public $Email;
    public $Status;
    public $LastComic;
    public $Creation;
    //============================

    // Constructor================
    function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }
    //============================

    // Default DB Operations======
    function Select()
    {
        $query = "SELECT * FROM User WHERE 1=1 ";

        // Search Criteria
        if(!empty($this->uid))
        {
            $query .= " AND User.uid = ?";
        }
        if(!empty($this->FirstName))
        {
            $query .= " AND User.FirstName = ?";
        }
        if(!empty($this->LastName))
        {
            $query .= " AND User.LastName = ?";
        }
        if(!empty($this->Email))
        {
            $query .= " AND User.Email = ?";
        }       

            
        // Preparing the statement
        $stmt = $this->mysqli->prepare($query);

        // Binding parameters
        if(!empty($this->uid))
        {
            $stmt->bind_param('s', $this->uid);
        }
        if(!empty($this->FirstName))
        {
            $stmt->bind_param('s', $this->FirstName);
        }
        if(!empty($this->LastName))
        {
            $stmt->bind_param('s', $this->LastName);
        }
        if(!empty($this->Email))
        {
            $stmt->bind_param('s', $this->Email);
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

    function Update()
    {
        if($this->uid!=null)
        {
            $setValues = "";
            $values = array();                        

            // Check if First Name is not null
            if ($this->FirstName != null) {
                $setValues .= "FirstName = ?,";
                $values[] = $this->FirstName;
            }

            // Check if Last Name is not null
            if ($this->LastName != null) {
                $setValues .= "LastName = ?,";
                $values[] = $this->LastName;
            }

            // Check if Last Name is not null
            if ($this->Email != null) {
                $setValues .= "Email = ?,";
                $values[] = $this->Email;
            }     
            
            // Check if Status is not null
            if ($this->Status != null) {
                $setValues .= "Status = ?,";
                $values[] = $this->Status;
            }   
            
            // Trimming Extra Commans
            $setValues = rtrim($setValues, ',');
            
            $query = "UPDATE User SET $setValues WHERE uid = ?";

            
                        
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


    function Insert()
    {        
        $columns = "";
        $values = array();
        $valuePlaceholders = "";
                    
        if($this->uid != null)
        {
            $columns .= "uid,";
            $values[] = $this->uid;
            $valuePlaceholders .= "?,";
        }
        if($this->FirstName != null)
        {
            $columns .= "FirstName,";
            $values[] = $this->FirstName;
            $valuePlaceholders .= "?,";
        }
        if($this->LastName != null)
        {
            $columns .= "LastName,";
            $values[] = $this->LastName;
            $valuePlaceholders .= "?,";
        }
        if($this->Email != null)
        {
            $columns .= "Email,";
            $values[] = $this->Email;
            $valuePlaceholders .= "?,";
        }
                
        
        // Trim extra commas
        $columns = rtrim($columns, ',');
        $valuePlaceholders = rtrim($valuePlaceholders, ',');

        $query = "INSERT INTO User ($columns) VALUES ($valuePlaceholders)";

        
        
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


    function Delete()
    {
        if($this->uid!=null)
        {
           // build the query
            $query = "DELETE FROM User WHERE uid = ?";

            // prepare the statement
            $stmt = $this->mysqli->prepare($query);

            // bind the parameter to the statement
            $stmt->bind_param('i', $this->uid);

            // execute the statement
            if ($stmt->execute() === true) {
                // success
                $stmt->close();
                return true;
            } else {
                // failure
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
    //============================

}
