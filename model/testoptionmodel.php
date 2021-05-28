<?php
      include "C:/xampp/htdocs/test/model/testnormalmodel.php";
      include_once "c:/xampp/htdocs/test/info.php";
class option extends info
{
     
      public $type;
      public $value=null;
      public $normal;
      public $index=0;
      
      public function __construct($id)
      {
            if($id!="")
            {
                  $conn=db::getInstance();
                  $query = "SELECT * from options where option_id = '$id'";
                  $result = $conn->query($query);
                  if($row = mysqli_fetch_array($result))
                  {
                     $this->id=$row["option_id"];
                     $this->name=$row["name"];
                     $this->type=$row["type"]; 
                  } 
                  $query2 = "SELECT * from option_normal where option_id  = '$id'";
                  $result2 = $conn->query($query2);
                  $i=0;
                  while($row2 = mysqli_fetch_array($result2))
                  {
                        $this->normal[$i]=new normal($row2["refrence_id"]);
                        $i++;
                  }
            }
            else
            {
            }
      }
      public function setvalueandindex($testid,$appid,$optionid)
      {
            $conn=db::getInstance();
            //$t=new test($testid);
            // $optionid=$t->options[$optionid]->id;
            $optionid=$this->id;
            $query="SELECT * FROM test_option Where test_id='$testid' and option_id='$optionid'";
            $result = $conn->query($query);
            if($row = mysqli_fetch_array($result))
            {
                     $test_option_id=$row["test_option_id"];
            } 
            $query2="SELECT * FROM test_appointment Where test_id='$testid' and appointment_id='$appid'";
            $result2 = $conn->query($query2);
            if($row2 = mysqli_fetch_array($result2))
            {
                     $appointment_test_id=$row2["id"];
            } 

            $query3 = "select * from option_values where test_option_id ='$test_option_id'and apoitment_test_id='$appointment_test_id'";
            $result3=$conn->query($query3);
           if( $row3 = mysqli_fetch_array($result3))
           {
            $this->value=$row3["value"];
            
            $index_id=$row3["normal_id"];
            $k=0;
            while($k<count($this->normal))
            {
                  if($index_id==$this->normal[$k]->id)
                  {
                        $this->index=$k;
                  }
                  $k++;
            }
           }
        
           

      }
      public function addvalue($testid,$appid,$optionid,$value,$Rindex) 
      {
            $conn=db::getInstance();
            $t=new test($testid);
      
            $Rindex=$t->options[$optionid]->normal[$Rindex]->id;
            var_dump($Rindex);
            $optionid=$t->options[$optionid]->id;
           
            $query="SELECT * FROM test_option Where test_id='$testid' and option_id='$optionid'";
            $result = $conn->query($query);
            if($row = mysqli_fetch_array($result))
            {
                     $test_option_id=$row["test_option_id"];
            } 
            $query2="SELECT * FROM test_appointment Where test_id='$testid' and appointment_id='$appid'";
            $result2 = $conn->query($query2);
            if($row2 = mysqli_fetch_array($result2))
            {
                     $appointment_test_id=$row2["id"];
            } 
            $query3 = "insert into option_values(test_option_id,apoitment_test_id,value,normal_id) value('$test_option_id','$appointment_test_id','$value','$Rindex')";
            $result3=$conn->query($query3);
            

            
      }
      /*
      public function getmeasure($testid,$appid,$optionid)
      {
            $conn=db::getInstance();
            $query="SELECT * FROM test_option Where test_id='$testid' and option_id='$optionid'";
            $result = $conn->query($query);
            if($row = mysqli_fetch_array($result))
            {
                     $test_option_id=$row["test_option_id"];
            } 
            $query2="SELECT * FROM test_appointment Where test_id='$testid' and appointment_id='$appid'";
            $result2 = $conn->query($query2);
            if($row2 = mysqli_fetch_array($result2))
            {
                     $appointment_test_id=$row2["id"];
            } 
            $query3 = "Select * from option_values where test_option_id='$test_option_id' and apoitment_test_id='$appointment_test_id'";
            $result3=$conn->query($query3);
            if($row3 = mysqli_fetch_array($result3))
            {
                  $arr[0]=$row3["normal_id"];
                  $arr[1]=$row2["value"];
                  return $arr;
            } 
            
      }
      */
      
}
      
    
      
    

       


  
     



  
