<?php
      include_once "C:/xampp/htdocs/test/db.php";
      class viewmodel
      {
            public $html;
            public function gethtml($url)
            {
                  ///$db=new db();
                  $conn = db::getInstance();
                  if ($url !="")
		      {	
                        $query="select html from views where url='$url'";
                        $result = $conn->query($query);
                        $row = mysqli_fetch_array($result);
                        if($row!=null)
                        {
                              $this->html=$row["html"];
                        }
                        return $this->html;                      
                 }
            }
      }
           
    
      
    

       


  
     



  