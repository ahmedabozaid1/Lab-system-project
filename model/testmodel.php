<?php
///include "../db.php";
include_once "patientmodel.php";
include_once "testoptionmodel.php";
include_once "c:/xampp/htdocs/test/info.php";
class test extends info{
    public $patrent_id;
    public $time;
    public $price;
    public $options;
  
    public function __construct($id)
    {
        if($id!="")
        {
            $conn = db::getInstance();
            $query = "SELECT * from test where 	test_id  = '$id'";
            $result = $conn->query($query);
            if($row = mysqli_fetch_array($result))
            {
               
                $this->id = $row["test_id"];
                $this->patrent_id = $row["parent_id"];
                $this->time = $row["time-taken"];
                $this->price = $row["price"];
                $this->name = $row["test_name"];            
            } 
            $query2 = "SELECT * from test_option where 	test_id  = '$id'";
            $result2 = $conn->query($query2);
            $i=0;
            while($row2 = mysqli_fetch_array($result2))
            {
                $this->options[$i]=new option($row2["option_id"]);
                
                $i++;
            }
          
        }

    }

public function updateprice($id,$newprice)
{
    $conn = db::getInstance();
    $query = "SELECT * from test where 	test_id  = '$id'";
    $result = $conn->query($query);
    if($row = mysqli_fetch_array($result))
    {
          $query= "UPDATE test SET price = '$newprice' WHERE test_id='$id'";
          $result = $conn->query($query);
          return true ;

    }else
    {
          return false ;
    }
}


function showall()
{
    $i=0;
    $conn = db::getInstance();
    $query = "SELECT * from test "; // order by id
    $result = $conn->query($query);
    $return=null;
    while($row = mysqli_fetch_array($result))
    {
        $return[$i]=new test($row["test_id"]);
        $i++;
    }

   return $return;
}


function create_parents ()
{
    $i=0;
    $conn = db::getInstance();
    $query = "SELECT * from test where parent_id =0 "; // order by id
    $result = $conn->query($query);
    while($row = mysqli_fetch_array($result))
    {
        $return[$i]=new test($row["test_id"]);
        

        $i++;
    }

   return $return;


}
function create_child($patrent_id)
{
    $i=0;
    $conn = db::getInstance();
    $query = "SELECT * from test where parent_id =$patrent_id "; // order by id
    $result = $conn->query($query);
    while($row = mysqli_fetch_array($result))
    {
        $return[$i]=new test($row["test_id"]);
        

        $i++;
    }

   return $return;


}





/// call create_parents... 
// have opjects of all parents
////// loop print parent and call(create children ) and print children

}
?>