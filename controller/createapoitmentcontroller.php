<?php

include_once "../view/createappview.php";
require_once "../model/patientmodel.php";
include_once "../model/appointmentmodel.php";
include_once "../model/testmodel.php";
require_once "C:/xampp/htdocs/test/view/view.php";
///include "validate.php";
//include "../model/testmodel.php";

$test=new test("");
$allparents=$test->create_parents();

$patient=new patient("");
$patients=$patient->show_all();

$v= new creatapp();
$v->viewform($patients);

for($i=0;$i<count($allparents);$i++)
{
    $v->displayparent($allparents[$i]);
    $allchild=$test->create_child($allparents[$i]->id);
  //  echo $allchild[1]->name;
    $v->displaychild($allchild);
}

$v->footor();
include_once "C:/xampp/htdocs/test/controller/observer/create_observer.php";
$ap=new appointment("");
$obs= new CreateObserver($ap);
//var_dump($ap);

if( isset($_POST['ad']) )
{
    $tests=$_POST['choose'];
    $time_tests = 0;
    for($i=0;$i<count($tests);$i++){

      $temp_test = new test($tests[$i]);
      $time_tests += $temp_test->time ;
    }
    $time_tests = '+'.strval($time_tests).' hour';
    $nameindex = $_POST['np'];
    $date= $_POST['dates'];
    $time= $_POST['time'];
    $payedamount= $_POST['payedamount'];
    $reportdate = date( "Y-m-d", strtotime($date." ".$time." ".$time_tests));
    $reporttime = date( "H:i:s", strtotime($date." ".$time." ".$time_tests));
    $discount=$_POST['discount'];
    $urgent=$_POST['urgent'];
    if($urgent==1 )
    {
     // $urgent=$_POST['urgent'];
      $reportdate = date( "Y-m-d", strtotime($reportdate." ".$reporttime." -10 hour"));
    }
   

    $name=$patients[$nameindex]->name;
    $lastid=$ap->create_appointment($name,$date,$time,$payedamount,$tests,$reportdate,$reporttime);
  

    echo $lastid;
if($lastid>=0 && $lastid!=null)
{
  $app2=new appointment($lastid);
  $app2=new tax($app2);
 
 
   $app2=factory::operation($discount,$urgent,$app2);
 
 
  $finalcost=$app2->cost();
  $comment=$app2->description();
 
 
 
 
 
    $ap->setcost($finalcost,$comment,$lastid);

 
   $href="/test/controller/invoicecontroller.php?id=$lastid&type=invoice";
   View::redirect($href);
}



 

    

    	//       $val =new validate();
        //    /////// $bolid=$val->valid($patient);
        //     $bolname=$val->valname($name);
        //     $bolusername=$val->valname($username);
        //     $bolphone=$val->valphone($phone);
        //     $boldob=$val->valdate($dob);
        //     $boltype=$val->valid($type);
        //     $boladdress=$val->valaddress($address);

        //     if($boldob && $bolname && $bolusername && $bolphone && $boltype && $boladdress)
        //     {
        //          $user->insertnewhuman($address,$phone,$gender,$dob,$name,$type,$username,$password);
        //           $href="/OOSE/controller/doctorcontroller.php";
        //         echo "<script type='text/javascript'>document.location.href='{$href}';</script>";
        //     }
}




class factory
{
    public static function operation($discount, $urgent,$app)
    {


      if($urgent==1)
      {
           $app=new urgent($app);
      }
      if($discount)
      {
            if($discount>0)
            {
                $app=new discount($app);
                $app->set_amount($discount);
            }
            
    
      }
      //add new if 
      return $app;
    }
}

?>