<?php
    include "C:/xampp/htdocs/test/controller/homecontroller.php";
    include_once "C:/xampp/htdocs/test/controller/Validate.php";
    require_once "C:/xampp/htdocs/test/view/createuserview.php";
    require_once "C:/xampp/htdocs/test/model/usermodel.php";
    require_once "C:/xampp/htdocs/test/view/view.php";
    $createview = new createuserview();
    $createview->display();
    $user= new user(1);

    if(isset($_POST['add']))
    {
        $name = $_POST['name'];
        $username= $_POST['username'];
        $phone= $_POST['Phone'];
        $dob= $_POST['dob'];
        $type= $_POST['type'];
        $password= $_POST['pwd'];
        $address= $_POST['address'];
        if(!empty($_POST['gender'])) 
        {

           if($_POST['gender']=="female")
          {
                $gender=0;
          }
          else
            {
            $gender=1;
            }
        } 


        $val =new validate();
       /////// $bolid=$val->valid($patient);
        $bolname=$val->valname($name);
        $bolusername=$val->valname($username);
        $bolphone=$val->valphone($phone);
        $boldob=$val->valdate($dob);
        $boltype=$val->valid($type);
        $boladdress=$val->valaddress($address);
  
        if($boldob && $bolname && $bolusername && $bolphone && $boltype && $boladdress)
        {
             $user->insertnewhuman($address,$phone,$gender,$dob,$name,$type,$username,$password);
              $href="/test/controller/doctorcontroller.php";
              View::redirect($href);
        }
    }
