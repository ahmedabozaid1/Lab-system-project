<?php
require_once "C:/xampp/htdocs/test/model/appointmentmodel.php";
require_once "C:/xampp/htdocs/test/view/addpaymentview.php";
require_once "C:/xampp/htdocs/test/view/view.php";

if(isset($_REQUEST["type"]))
{        
    if($_REQUEST["type"]=='addpayment')
    {
        ////echo"hello";
        /// $id= $_REQUEST['id'];
        $id= $_GET['id'];
        ///echo $id;
        
    

        $hi= new appointment(1);
        $app=$hi->show_appointment($id);

        $view = new addpaymentview();
        $view->display($app);
    
    }
    /// $href="/test/controller/addpaymentcontroller.php";
    //// echo "<script type='text/javascript'>document.location.href='{$href}';</script>";
}
if(isset($_POST['update']))
{
    $hi= new appointment(1);
    $payed = $_POST['payedamount'];
   //// echo $payed;
    $ID = $_POST['id'];
  ///  echo $ID;
    $hi->add_payment($ID,$payed);

   
    $href="/test/controller/showappcontroller.php";
    View::redirect($href);
   /////// echo "<script type='text/javascript'>document.location.href='{$href}';</script>";

}