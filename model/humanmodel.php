<?php
    include_once "C:/xampp/htdocs/test/db.php";
 
    require_once "C:/xampp/htdocs/test/info.php";
    class humanmodel extends info
    {

        // extends id and name
        // id is in user   done
        // name is in user_type with the same id done


        public $address ;  // address is this recurtion  ///
        public $gender ; // user 
        public $dob; // dof in user
        public $phone_number; // user 
        public $email;

        function __construct($id)
        {
            if($id!="")
            {
                $conn = db::getInstance();
                $query = "SELECT * from user where id = '$id'";
                $result = $conn->query($query);
                if($row = mysqli_fetch_array($result))
                {
                    $this->id = $row["id"];
                    $this->gender = $row["gender"];
                    $this->dob = $row["dob"];
                    $this->phone_number = $row["phone_number"];
                    $this->address = $this->getaddress($row["address_id"]);
                    $this->name=$row["name"];
                } 
              
            }
        }

        function getaddress($aid)
        {
            if($aid==0)
            {
                return "";
            }
            else
            {
                $conn = db::getInstance();
                $query = "SELECT * from address where address_id = '$aid'";
                $result = $conn->query($query);
                if($row = mysqli_fetch_array($result))
                {
                    $st = $this->getaddress($row["parent_id"]);
                    return $row["address"]. " ". $st;
                }  

            }
        }

        
    }


?>