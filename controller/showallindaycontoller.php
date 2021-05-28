<?php
    //include_once  "C:\\xampp\\htdocs\\test\\controller\\homecontroller.php";
    include "C:/xampp/htdocs/test/controller/homecontroller.php";
    require_once "C:/xampp/htdocs/test/view/showqueueview.php";
    require_once "C:/xampp/htdocs/test/model/appointmentmodel.php";
    require_once "c:/xampp/htdocs/test/model/viewmodel.php";
    require_once "C:/xampp/htdocs/test/view/view.php";
    
    $v=new viewmodel();
    $html=$v->gethtml("showqueue.php");
    
    if (isset($_GET['date'])) {
        $date = $_GET['date'];
        $app = new appointment(1);
        $ct=$app->countAppointmentsInDay($date);
        $isPastday = $app->pastDays($date);
        if ($ct > 0)
        {
            $allapps=$app->show_app_intime_confirmedAllowed($date);
            $view = new showqueueview($html);
            $view->display($allapps);
        }
        else{
            //redirct js
            $href="/test/controller/showappcontroller.php";
            View::redirect($href);
        }
    }
    if(isset($_POST['add']))
    {
       
        $href="/test/controller/createapoitmentcontroller.php";////////////emma
        View::redirect($href);
    }