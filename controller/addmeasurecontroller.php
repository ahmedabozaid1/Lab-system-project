<?php
    include "C:/xampp/htdocs/test/controller/homecontroller.php";
    require "C:/xampp/htdocs/test/view/addmeasureview.php";
    require_once "C:/xampp/htdocs/test/model/testmodel.php";
    require_once "C:/xampp/htdocs/test/view/view.php";




    if(isset($_REQUEST["type"]))
    {
        
        if($_REQUEST["type"]=='submit')
        {
            $add=new addmeasure();
            $id= $_GET['id'];
           $appid=$_GET['idapp'];

            $test=new test($id);
            $add->display($test,$id,$appid);
            //   $testoption=new option(2);
           /// echo"hahah";
            ///echo $testoption->getnormal(11,64,2);
            


           //////// $href="/test/controller/showappcontroller.php";
            ///echo "<script type='text/javascript'>document.location.href='{$href}';</script>";
        }
      
    }

    if(isset($_GET["data1"]))
    {
        $i=0;
        $a=$_GET["data3"];
        $b=explode(",", $a);
        $testid=$b[0];
        $appid=$b[1];

        $test=new test($testid);
        $number=count($test->options);

        while($i<$number)
        {
            $v=$_GET["data2"];
            $val=explode(",", $v);
            $value=$val[$i];

            $in=$_GET["data1"];
            $index=explode(",", $in);
            $Rindex=$index[$i];
            $testoption=new option($i);
           /// echo "<br> <br>";
            ///var_dump($testoption);
           $testoption->addvalue($testid,$appid,$i,$value,$Rindex);
        
        
            $i++;
        }

        View::redirect("/test/controller/showresultcontroller.php?idapp=$appid&id=$testid&type=result");
      
    }
