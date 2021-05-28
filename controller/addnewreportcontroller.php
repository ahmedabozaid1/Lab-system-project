<?php
include "C:/xampp/htdocs/test/controller/homecontroller.php";
include_once "../view/addreportview.php";
include_once "../model/report_model.php";
require_once "C:/xampp/htdocs/test/view/view.php";
if(isset($_POST['add']))
{
       // echo"hi";
        $v=new addreport();

}

else
{
    if(isset($_POST['dayReport']))
    {
    // $m=$_POST['month'];
    //$y=$_POST['year'];
    $date=$_POST['date'];
        $report=new report(0);
        $report->get_day_report($date);
        $href="/test/controller/viewallreportscontroller.php";
        View::redirect($href);
    // echo $m;
    // echo $y;
    //  echo $date;
    }
    else
    {
        if(isset($_POST['monthReport']))
        {
        $m=$_POST['month'];
        $y=$_POST['year'];
        //$date=$_POST['date'];
            $report=new report(0);
            $report->get_monthly_report($y,$m);
            $href="/test/controller/viewallreportscontroller.php";
            View::redirect($href);
        // $report->get_day_report($date);
        // echo $m;
        // echo $y;
        //  echo $date;
        }
        else
        {

          
            $href="/test/controller/viewallreportscontroller.php";
            View::redirect($href);
        

        }
    }

}

?>