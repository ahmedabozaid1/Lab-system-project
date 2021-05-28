<?php
   include "C:/xampp/htdocs/test/controller/homecontroller.php";
include_once "c:/xampp/htdocs/test/model/testmodel.php";
require_once "c:/xampp/htdocs/test/view/showcontrolview.php";
require_once "C:/xampp/htdocs/test/view/updatepriceview.php";
require_once "C:/xampp/htdocs/test/view/view.php";
require_once "c:/xampp/htdocs/test/controller/Validate.php";




if(isset($_REQUEST["type"]))
{        
    if($_REQUEST['type']=='edit')
    {
        $id= $_GET['id'];

        $test=new test($id);
        $update=new updateprice($test);
        
    }
}

else{
    $test=new test(1);
$alltests=$test->showall();
$view = new showcontrolview();
$view->display($alltests);
}
    if(isset($_POST['update']))
    {
        $id=$_POST['tid'];
        $price=$_POST['price'];
        $val= new validate();
        if($val->valint($price))
        {
            $test=new test($id);
            $test->updateprice($id,$price);
            $href="/test/controller/Controlpanel.php";
            View::redirect($href);
        }
     
        
   
    }
 

