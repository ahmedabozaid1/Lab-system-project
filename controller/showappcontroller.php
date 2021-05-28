<?php
include_once "C:/xampp/htdocs/test/controller/homecontroller.php";
include_once 'C:/xampp/htdocs/test/view/calendar/lib/calendar.php';
//include_once "C:\\xampp\\htdocs\\test\\controller\\homecontroller.php";
require_once "C:/xampp/htdocs/test/view/showappview.php";
////require_once "/opt/lampp/htdocs/test/model/appointmentmodel.php";
require_once "C:/xampp/htdocs/test/view/view.php";
require_once "C:/xampp/htdocs/test/view/showappviewcal.php";

include_once "C:/xampp/htdocs/test/model/appointmentmodel.php";

$app = new appointment(1);
$json = $app->countAppointmentsInAll();
$calview = new ShowappviewCal();
$calview->viewApp($json);
if(isset($_POST['add']))
{
   
    $href="/test/controller/createapoitmentcontroller.php";////////////emma
    View::redirect($href);
}
if(isset($_GET['type'])){
    include_once "C:/xampp/htdocs/test/controller/observer/delete_observer.php";
    $id = $_GET['id'];
    $app = new appointment($id);
    $obs2 = new DeleteObserver($app);
    $app->deleteappointment($id);
    //$app = new appointment(51);
    //echo "#ash";
    $href="/test/controller/showappcontroller.php";////////////emma
    View::redirect($href);
}