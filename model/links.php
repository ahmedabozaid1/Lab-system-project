<?php

class links{


    public $url;
    public $linkname;
    function __construct($id)
    {
        if($id!="")   
        {    
            require_once ("../db.php");
            $conn = db::getInstance();
            $query = "SELECT * from links where id = '$id'";
            $result = $conn->query($query);
            if($row = mysqli_fetch_array($result))
            {
                $this->url = $row["url"];
                $this->linkname=$row["link"];
            } 
        }
    }
        
        
}
