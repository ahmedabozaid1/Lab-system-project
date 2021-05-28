<?php
    require_once "C:/xampp/htdocs/test/model/usermodel.php";
    require_once "C:/xampp/htdocs/test/view/homeview.php";
    require_once "C:/xampp/htdocs/test/view/view.php";
   //////////////// homeview::display();
   
    $home=new homeview();
    $home->display();

    if(isset($_POST['Logout']))
    {
        $usr=new user(1);
        $usr->logout();
      
       //// header("location:  /OOSE/index.php");     
        $href="/test/index.php";
        View::redirect($href);
    }
  ////////////////<?php
