<?php
//include("../config/database.php");

class Admin
{
    public $mysqli;
    public $error;
    // Properties================
    public $uid;
    public $UserName;
    public $Email;
    public $Password;    
    public $Status;
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
        $query = "SELECT * FROM admin WHERE 1=1 ";

        // Search Criteria
        if(!empty($this->uid))
        {
            $query .= " AND admin.uid = ?";
        }
        if(!empty($this->UserName))
        {
            $query .= " AND admin.UserName = ?";
        }

        // Preparing the statement
        $stmt = $this->mysqli->prepare($query);

        // Binding parameters
        if(!empty($this->uid))
        {
            $stmt->bind_param('i', $this->uid);
        }
        if(!empty($this->UserName))
        {
            $stmt->bind_param('s', $this->UserName);
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
    function Login()
    {
        $query = "SELECT * FROM admin WHERE 1=1 ";

        // Search Criteria
        $query .= " AND offers.Email = ?";
        $query .= " AND offers.Password = ?";
        

        // Preparing the statement
        $stmt = $this->mysqli->prepare($query);

        // Binding parameters
        $stmt->bind_param('i', $this->Email);
        $stmt->bind_param('s', $this->Password);
        

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

            // Check if UserName is not null
            if ($this->UserName != null) {
                $setValues .= "UserName = ?,";
                $values[] = $this->request_id;
            }

            // Check if Password is not null
            if ($this->Password != null) {
                $setValues .= "Password = ?,";
                $values[] = $this->Password;
            }

            // Check if Email is not null
            if ($this->Email != null) {
                $setValues .= "Email = ?,";
                $values[] = $this->AirCraft;
            }

            // Check if Status is not null
            if ($this->Status != null) {
                $setValues .= "Status = ?,";
                $values[] = $this->Status;
            }

           
            // Trimming Extra Commans
            $setValues = rtrim($setValues, ',');

            $query = "UPDATE admin SET $setValues WHERE uid = ?";

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

    function SelectDashboardData()
    {
        $query = "SELECT 
        (SELECT SUM(InvoiceAmount) FROM invoice) INVOICE_AMOUNT,
        (SELECT COUNT(*) FROM offer) TOTAL_OFFERS,
        (SELECT COUNT(*) FROM request) TOTAL_REQUESTS,
        (SELECT COUNT(*) FROM request WHERE Status=0) PENDING_REQUESTS
        ";

      
        // Preparing the statement
        $stmt = $this->mysqli->prepare($query);
 

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
        
    //============================

}
