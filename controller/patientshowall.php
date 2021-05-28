<?php
include "C:/xampp/htdocs/test/controller/homecontroller.php";
include_once "../view/patientviewer.php";
include_once "../model/patientmodel.php";
require_once "C:/xampp/htdocs/test/view/view.php";
patientview::headerpage();
$viwe = new patientview();
$viwe->show_all();
patientview::footerpage();

$patient=new patient(1);
$Set = $patient->show_all();
//var_dump($_POST);
for($i=0;$i<count($Set);$i++)
{
    if(isset($_POST['delete'.$Set[$i]->id]))
    { 
        $id=$_POST['id'];
        $patient->delete_patient($id);
        $href="/test/controller/patientshowall.php";//////////////////////lma y3dlha sl7ha dnjofnsdgfgfosdbnaguosadbn
        View::redirect($href);
    }
}
