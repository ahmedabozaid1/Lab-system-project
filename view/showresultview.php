<?php

class showresult
{
    public function __construct()
    {
        $file="C:/xampp/htdocs/test/view/showresult.php";
        if (file_exists($file)) 
        {
            echo file_get_contents($file);
        }
        else
        {
            echo "file not found";
        }
    }

    public function displayinfo($app,$test)
    {
        $name=$app->patient->name;
        $phone=$app->patient->phone_number;
        echo "
        <div class=\"invoice-box\">
        
        <table cellpadding=\"0\" cellspacing=\"0\">
        <div style=' text-align:center '> <img src='../logo.png'/ style='width:250px;height:250px;'></div>
    
            <tr class=\"information\">
               <td colspan=\"2\">
                    <table>
                        <tr>
                            <td>
                            appoitment #: $app->id <br>
                            appoitment date: $app->date<br>
                            </td>
                            
                            <td style=\"
                            
                            text-align: right;
                        \">
                                 $name<br>
                                $phone
                            </td>
                                
  
                        </tr>
                    </table>
                    <hr style='width:170%;height:2px;border-width:0;color:gray;background-color:gray'>
                </td>
            </tr>
           

            <tr class=\"information\">
                <td colspan=\"2\">
                    <table>
                        <tr>
                            <td>
                           <h2> $test->name </h2>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

        ";
        

        echo"
    
            <tr class=\"heading\">
            <td>
                test
            </td>
            
            <td>
                value
            </td>
            
            <td>
                normal
            </td>
        </tr>
        ";


     
           
            
        
        
        
 
        
        
    }
    public function displaytable($option)
    {
           
        if($option->type=="bool")
        {
            $st=$option->normal[$option->index]->start;
        }else{
            $st=$option->normal[$option->index]->start." / ".$option->normal[$option->index]->end."    ".$option->normal[$option->index]->measureunit;
        }
                                   
                                 
        echo "
        
            <tr class=\"item\">
                    <td>
                        $option->name
                    </td>
                        
                    <td>
                    ";
                    if($option->type=="bool")
                    {
                        if($option->value==0)
                        {
                            $sd="Positive";
                        }
                        if($option->value==1)
                        {
                            $sd="Negative";
                        }
                    }else{
                        $sd=$option->value;
                    }
                    echo"
                        $sd
                    </td>

                    <td>
                        $st
                    </td>
                </tr>
            ";
                         
                                    
                                    
    }

    public function footor($idapp,$id)
    {
        
        echo "
        </table>
        <h2> Signature </h2>
        <h3> ................. </h3>
        <form action=\"/test/controller/showresultcontroller.php\" method='post'>
        <input type='hidden' name='idapp' value='$idapp'>
        <input type='hidden' name='id' value='$id'>
        <button type='submit' name='print' style='float: right;'>print </button>
        </form>
        </div>

        </body>
        </html>
        ";
    }

}
