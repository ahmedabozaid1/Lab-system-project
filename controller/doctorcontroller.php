<?php
    include "C:/xampp/htdocs/test/controller/homecontroller.php";
    include_once "C:/xampp/htdocs/test/controller/Validate.php";
   
   //// require_once "C:/xampp/htdocs/OOSE/view/Cruddoctorview";
    require_once "C:/xampp/htdocs/test/view/Cruddoctorview.php";
   
   //// require_once "C:/xampp/htdocs/OOSE/model/usermodel.php";
    require_once "C:/xampp/htdocs/test/model/usermodel.php";
    require_once "C:/xampp/htdocs/test/view/view.php";

     //require_once "C:/xampp/htdocs/OOSE/view/create.php";
    $hi= new user(1);
    $allusers= $hi->selectall();
    $view = new cruduserview();
    $view->display($allusers);
  

    

        if(isset($_REQUEST["type"]))
        {
            
            if($_REQUEST["type"]=='delete')
            {
            // echo"hello";
            /// $id= $_REQUEST['id'];
                $id= $_GET['id'];

                $hi->deleteuser($id);
                $href="/test/controller/doctorcontroller.php";
                View::redirect($href);
            }

        }
   
   
 
    
    
    if(isset($_POST['addnew']))
    {
       /// require_once "/opt/lampp/htdocs/OOSE/controller/createusercontroller.php"
        ///header("location: /opt/lampp/htdocs/OOSE/controller/createusercontroller.php");
        $href="/test/controller/createusercontroller.php";
        View::redirect($href);
    }
?>
