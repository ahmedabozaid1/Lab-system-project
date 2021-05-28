<?php
      include_once "C:/xampp/htdocs/test/db.php";
      include_once "c:/xampp/htdocs/test/id.php";
class normal extends id
{
      public $start;
      public $end;
      public $measureunit;
      
      public function __construct($id)
      {
            if($id!="")
            {
                  $conn=db::getInstance();
                  $query = "SELECT * from normal where id  = '$id'";
                  $result = $conn->query($query);
                  if($row = mysqli_fetch_array($result))
                  {
                     
                      $this->id = $row["id"];
                      $this->start = $row["start"];
                      $this->end = $row["end"];    
                      $unitid=$row["unit_id"];        
                  } 
                  $query2 = "SELECT * from measurement_unit where id  = '$unitid'";
                  $result2 = $conn->query($query2);
                  if($row2 = mysqli_fetch_array($result2))
                  {
                        $this->measureunit=$row2["name"];
                  }
            }
      }

     
}
      


    
      
    

       


  
     



  