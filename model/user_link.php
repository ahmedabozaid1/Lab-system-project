<?php
class user_link{


    public $link_id;
    function __construct($id)
    {
        if($id!="")   
        {    
            require_once ("../db.php");
            $conn = db::getInstance();
            $query = "SELECT * from user_link where id = '$id'";
            $result = $conn->query($query);
            if($row = mysqli_fetch_array($result))
            {
                $this->link_id = $row["link_id"];
            } 
        }
    }
        
        
}
