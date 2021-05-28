<?php
 include "C:/xampp/htdocs/test/controller/homecontroller.php";
include "../view/invoiceview.php";
include "../model/appointmentmodel.php";
require_once "C:/xampp/htdocs/test/view/view.php";
///include "validate.php";



if(isset($_REQUEST["type"]))
{        
    if($_REQUEST["type"]=='invoice')
    {
        ////echo"hello";
        $id= $_REQUEST['id'];
        // ecrypt
        // $encoded= $_GET['id'];
        // $encoded=base64_decode(urldecode($encoded));
        // $id=((($encoded*956783)/5678)/123456789);

        ///echo $id;

        $app=new appointment($id);

        $v=new invoice($app) ;

    }
}

?>