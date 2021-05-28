<?php
include "C:/xampp/htdocs/test/controller/homecontroller.php";
include_once "C:/xampp/htdocs/test/model/appointmentmodel.php";
include_once "C:/xampp/htdocs/test/view/apptestdetailview.php";
require_once "C:/xampp/htdocs/test/view/view.php";
$v= new detailsview();
//// get id from table
// decode the get id
if(isset($_REQUEST["type"]))
{
    
    if($_REQUEST["type"]=='submit')
    {
        // decode the get id
        /// ecrypt
        $encoded= $_GET['id'];
        $encoded=base64_decode(urldecode($encoded));
        $id=((($encoded*956783)/5678)/123456789);


        $a=new appointment($id);
        $v->display($a);
    }
}




