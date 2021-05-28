<?php
include "C:/xampp/htdocs/test/controller/homecontroller.php";
include_once "../model/report_model.php";
include_once "../view/viewallreportsview.php";
include_once "../view/showreportview.php";
require_once "C:/xampp/htdocs/test/view/view.php";
 ///$report->get_monthly_report(2020,12);



if(isset($_REQUEST["type"]))
{        
    if($_REQUEST['type']=='edit')
    {
        $id= $_GET['id'];

        $report=new report($id);
        $v=new reportview($report);
        // show report form

    }
}

else
{
  
   
        $report=new report(0);
        $allreports=$report->selectall();
        
        $view = new allreportsview();
        $view->display($allreports);
   
   
}

?>