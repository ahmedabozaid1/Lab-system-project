<?php
 include "C:/xampp/htdocs/test/controller/homecontroller.php";
    require_once "C:/xampp/htdocs/test/view/showqueueview.php";
    require_once "C:/xampp/htdocs/test/model/appointmentmodel.php";
    require_once "c:/xampp/htdocs/test/model/viewmodel.php";
    require_once "C:/xampp/htdocs/test/view/view.php";

    if(isset($_POST['search']))
    {
        $v=new viewmodel();
        $html=$v->gethtml("showqueue.php");
        
    
        $date= $_POST['date'];
        $time=$_POST['time'];
        $hi= new appointment(1);
        $allapps=$hi->show_app_intime($date,$time);
    
        $view = new showqueueview($html);
        $view->display($allapps);
    
    }
   