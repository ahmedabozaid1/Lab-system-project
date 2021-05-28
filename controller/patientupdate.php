<?php
include "C:/xampp/htdocs/test/controller/homecontroller.php";
include_once "C:/xampp/htdocs/test/controller/Validate.php";
include_once "../view/patientviewer.php";
include_once "../model/patientmodel.php";
require_once "C:/xampp/htdocs/test/view/view.php";

$patient=new patient(1);
$Set = $patient->show_all();

//var_dump($_POST);
//echo "<br>";
//echo "<br>";
//echo "<br>";
//var_dump($Set);
for($i=0;$i<count($Set);$i++)
{
    if(isset($_POST['submit'.$Set[$i]->id]))
    {
        $id=$Set[$i]->id;
        $name=$_POST['name'];
        $dob=$_POST['dob'];
        $phone=$_POST['phonenumber'];
        $gender=$_POST['gender'];
        $fertility=$_POST['fertility'];


            $view= new patientview();
            $view->formPatientUpadate($id,$name,$dob,$phone);
             break;
        
        //exit();
    }
}
