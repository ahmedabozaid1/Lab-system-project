<?php
include "C:/xampp/htdocs/test/controller/homecontroller.php";
include_once "../view/addnewcostomview.php";
include_once "../model/customreportmodel.php";
require_once "C:/xampp/htdocs/test/view/view.php";
require_once "C:/xampp/htdocs/test/model/testmodel.php";
if(isset($_POST['add']))
{
       // echo"hi";
       
        $v=new addcustomreport();

}

else
{
    if(isset($_POST['create']))
    {

            $name=$_POST['name'];
            $appdatetype=$_POST['appdatetype'];
            $appdate=$_POST['appdate'];
            $dobtype=$_POST['dobtype'];
            $dob=$_POST['dob'];
            $gender=$_POST['gender'];

            $report=new customreport(0);

            if($gender=="none")
            {
                $gender=null;
            }
            if($appdatetype!="none"&&$appdate==null)
            {
                view::Alert("please enter the appoitment date or choose none in the appoitment date type");
            }
            else
            {
                if($dobtype!="none"&&$dob==null)
                {
                     view::Alert("please enter the date of birth or choose none in thepatient date of birth type");
                }
                else
                {
                    $report->create_new($name,$appdatetype,$appdate,$dobtype,$dob,$gender);
                }
            }
        
            //
               

    }
    else
    {
       
     

          
            $href="/test/controller/viewallreportscontroller.php";
            View::redirect($href);
        

        
    }

}

?>