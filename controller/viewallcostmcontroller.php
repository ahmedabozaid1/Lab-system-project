<?php
include "C:/xampp/htdocs/test/controller/homecontroller.php";
include_once "../model/customreportmodel.php";
include_once "../view/viewallcostomview.php";
include_once "../view/costomreportview.php";
require_once "C:/xampp/htdocs/test/view/view.php";




if(isset($_REQUEST["type"]))
{        
    if($_REQUEST['type']=='edit')
    {
        $id= $_GET['id'];

         $report=new customreport($id);
      
         $v=new costomreportview($report);
        // show report form

    }
}

else
{
    // view all

    
    $report=new customreport(0);
    $allreports=$report->selectall();
        
    $view = new allcustomview();
    $view->display($allreports);
   
   
}

?>