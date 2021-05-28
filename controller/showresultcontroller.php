 <?php
   // include "homecontroller.php";
    require "C:/xampp/htdocs/test/view/showresultview.php";
    require_once "C:/xampp/htdocs/test/model/appointmentmodel.php";
    require_once "C:/xampp/htdocs/test/view/view.php";
   // require_once "../model/testmodel.php";


// test 12
// appid 64
// 

    if(isset($_POST['print'])){
      
      $appid = $_POST['idapp'];
      $id = $_POST['id'];

      echo $appid."<br>",$id."<br>";
      $app = new appointment($appid);

      $app->getmailbody(2);
      $mail=new mail($app->date
            ,$apptime
            ,$app->email
            ,$app->patient->name
            ,$app->mailbody);

      $href="/test/controller/showappcontroller.php";
      View::redirect($href);
    }
    if(isset($_REQUEST["type"]))
    {
        
        if($_REQUEST["type"]=='result')
        {

            $v=new showresult();
            $id= $_GET['id'];
           $appid=$_GET['idapp'];
           //$v=new showresult();
          // $id=12;
        //    $appid=64;
       
          $app=new appointment($appid);
          $test=new test($id);
           $v->displayinfo($app,$test);
       
          
           $k=$app->selecttestindex($id);
           if($app->tests[$k]->options)
            {

              $num=count($app->tests[$k]->options); 
              
            

              for($i=0;$i<$num;$i++)
              {
                  $opid=$app->tests[$k]->options[$i]->id;
                  $op=new option($opid);
                  $op->setvalueandindex($id,$appid,$opid);
                  $v->displaytable($op);
          
              }
           }
          
           $v->footor($appid,$id);
         
        }
      
    }




