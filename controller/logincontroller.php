<?php
   
    require_once "C:/xampp/htdocs/test/view/loginview.php";
    require_once "C:/xampp/htdocs/test/model/usermodel.php";
   ///////// require_once "./controller/homecontroller.php"
   require_once "c:/xampp/htdocs/test/model/viewmodel.php";
   require_once "C:/xampp/htdocs/test/view/view.php";

    $v=new viewmodel();
    $html=$v->gethtml("login.php");
    loginview::display($html);
    if(isset($_POST['Login-submit']))
    {
        $username = $_POST['uname'];
        $password = $_POST['pwd'];
        $login=new user(1);
        $verify=$login->login($username,$password);
        if($verify)
        {
           /////////// header("location:". $_SESSION['url']); 
            header("location:  /test/controller/homecontroller.php");
        }
        else
        {
            $verifylogin=new loginview();
            $verifylogin->verifylogin($verify);     
        }
    }
?>
