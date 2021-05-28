<?php
include_once "C:/xampp/htdocs/test/controller/Validate.php";
include_once "C:/xampp/htdocs/test/view/updateview.php";
include_once "C:/xampp/htdocs/test/model/usermodel.php";
require_once "C:/xampp/htdocs/test/view/view.php";

///$hi= new user(1);
//$allusers= $hi->selectall();
////////// get id from the post 
//$view = new updateform($myuser);

if(isset($_REQUEST["id"]))
{
       $id= $_GET['id'];
       $hi= new user($id);
       $myuser= $hi->selectwithid($id);
       $view = new updateform($myuser);
       
}

///$view->display($myuser) ; ///

if(isset($_POST['update']))
{
    $name = $_POST['name'];
    $phone= $_POST['phone'];
    $address= $_POST['address'];
    $uid=$_POST['uid'];





    $val =new validate();
     $bolid=$val->valid($uid);
     $bolname=$val->valname($name);
     $bolphone=$val->valphone($phone);
     $boladdress=$val->valaddress($address);

     


     if($bolid && $bolname && $bolphone && $boladdress)
     {

       $hi= new user($uid);
       $hi->updatename($uid,$name);
       $hi->updatephone($uid,$phone);
       $hi->change_address($uid,$address);
      
    }
    $href="/test/controller/doctorcontroller.php";
    View::redirect($href);


    



    //echo "fvevcefvc";
   //// echo $name.$phone.$address;
  
}
