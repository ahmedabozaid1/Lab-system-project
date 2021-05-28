<?php

include_once "C:/xampp/htdocs/test/view/rescheduleview.php";
include_once "C:/xampp/htdocs/test/model/appointmentmodel.php";
include_once 'C:/xampp/htdocs/test/controller/observer/reschedule_observer.php';
include_once "c:/xampp/htdocs/test/controller/interfacereschedule.php";
require_once "C:/xampp/htdocs/test/view/view.php";
//include "validate.php";
//include "../model/testmodel.php";


//////////////////////////////////////////////////////////////////////
////get appoitment id
///////////////////////////////////////////////

/// change to 2020-12-10 05:00:00 //// no
/// change to 2020-12-10 04:00:00 //// yes
/// 

if(isset($_REQUEST["type"]))
{        
    if($_REQUEST['type']=='edit')
    {
    
        $id= $_GET['id'];

        $app=new appointment($id);

        $v= new reschedule();
        $v->display($app);
        
        
        $v->footor();
        
    }
    
}

if( isset($_POST['add']) )
{
    if($_POST['date']!=null)
    {
        $date= $_POST['date'];
    }else{
        $date= $_POST['date1'];
    }
    
    $time= $_POST['time'];
    $id=$_POST['id'];
    $app=new appointment($id);


    $observer = new RescheduleObserver($app);
    $app->setreschedule(new defaultreschedule(),$id,$date,$time);

    $href="/test/controller/showappcontroller.php";
    View::redirect($href);

   //// echo "<script type='text/javascript'>document.location.href='{$href}';</script>";

}

if( isset($_POST['reseditnextmonth']) )
{
    $date= $_POST['date1'];
    $time= $_POST['time'];
    $id=$_POST['id'];

    ////logic of strategy
    $app=new appointment($id);
    

    $observer = new RescheduleObserver($app);
    $app->setreschedule(new samenextmonth(),$id,$date,$time);
    //////$app->reschedule_appoitment($id,$date,$time);
    $href="/test/controller/showappcontroller.php";
    View::redirect($href);

}
if( isset($_POST['resedittommorow']) )
{
    $date= $_POST['date1'];
    $time= $_POST['time'];
    $id=$_POST['id'];
    ////logic of strategy
    $app=new appointment($id);
   
    $observer = new RescheduleObserver($app);

    $app->setreschedule(new sametimetommorow(),$id,$date,$time);

    $href="/test/controller/showappcontroller.php";
  
   View::redirect($href);
}






?>



