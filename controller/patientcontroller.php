<?php
include_once "C:/xampp/htdocs/test/controller/Validate.php";
include "C:/xampp/htdocs/test/controller/homecontroller.php";
include_once "../model/patientmodel.php";
include_once "../view/patientviewer.php";
require_once "C:/xampp/htdocs/test/view/view.php";


if(isset($_POST['update'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $dob=$_POST['dob'];
    $phone=$_POST['phone'];
    $gender=$_POST['gender'];
    $fertility=$_POST['fertility'];

    if($fertility == "f"){
        $fertility = "0";
    }else if ($fertility == "t") {
        $fertility = "1";
    }
    if($gender == "m"){
        $gender = "0";
    }else if ($gender == "f") {
        $gender = "1";
    }
    //echo $name." ".$id;
    //exit();
    //echo $id."<br>",$name."<br>",$dob."<br>",$phone."<br>",$gender."<br>",$fertility."<br>"; 
    

    $val =new validate();
    $bolid=$val->valid($id);
    $bolname=$val->valname($name);
    $bolphone=$val->valphone($phone);
    $boldob=$val->valdate($dob);
    //var_dump($bolphone);
    //echo $bolid."<br>",$bolname."<br>",$bolphone."<br>",$boldob."<br>";
    if($boldob && $bolphone && $bolname && $bolid)
    {
        //echo $id."<br>",$name."<br>",$dob."<br>",$phone."<br>",$gender."<br>",$fertility."<br>";
        $patient = new patient(1);
        $patient->update_patient($name,$dob,$gender,$phone,$fertility,$id);
    }
    $href="/test/controller/patientshowall.php";//////////////////////lma y3dlha sl7ha dnjofnsdgfgfosdbnaguosadbn
    View::redirect($href);

}

patientview::showpage();

if(isset($_POST['submit']))
{
    // "askidnoaslidjnaso";
    $name=$_POST['name'];
    $dob=$_POST['dob'];
    $phone=$_POST['phone'];
    $gender=$_POST['gender'];
    $fertility=$_POST['fertility'];
    $email=$_POST['email'];
   /// $a=$name." ".$dob." ".$phone." ".$fertility." ".$patient;
    if($fertility=='f'){
        $fertility="0";
    }
    if($fertility=='t'){
        $fertility="1";
    }
    if($gender=='m')
    {
        $gender="0";
    }
    if($gender=='f')
    {
        $gender="1";
    }
     $val =new validate();
     $bolname=$val->valname($name);
     $bolphone=$val->valphone($phone);
     $boldob=$val->valdate($dob);
      if($bolname && $bolphone && $boldob)
    {  
        $patient = new patient(1);

        //$a=$name." ".$dob." ".$phone." ".$fertility." ".$patient;
        $patient->create_patient($name,$dob,$gender,$phone,$fertility,$email);
    }
    
    $href="/test/controller/patientshowall.php";//////////////////////lma y3dlha sl7ha dnjofnsdgfgfosdbnaguosadbn
    View::redirect($href);

}
