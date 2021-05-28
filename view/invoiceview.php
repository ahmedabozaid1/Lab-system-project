<?php


class invoice
{
   public $a;
    public function __construct($app)
    {
        $file="C:/xampp/htdocs/test/view/invoice.php";
        if (file_exists($file)) 
        {
            echo file_get_contents($file);
           
        }
        else
        {
            echo "file not found";
        }
        $this->displayinfo($app);
    }
    public function displayinfo($app)
    {
     //   var_dump($app);
        if($app->patient!=null)
        {
        $name=$app->patient->name;
        $phone=$app->patient->phone_number;
        echo "
        <div class=\"invoice-box\">
        <table cellpadding=\"0\" cellspacing=\"0\">
  
            
            <tr class=\"information\">
                <td colspan=\"3\">
                    <table>
                        <tr>
                            <td>
                            Invoice #: $app->id <br>
                            appoitment date: $app->date<br>
                            report date : $app->report_ready_date<br>
                            </td>
                            
                            <td>
                                $name<br>
                                $phone
                            </td>
                         
                        </tr>
                    </table>
                </td>
            </tr>
        ";
        
        }
        

        echo"
        
                
            <tr class=\"heading\">
            <td>
                Item
            </td>
            
            <td>
                Price
            </td>
        </tr>
        ";
           $i=0;
           while($i<count($app->tests))
           {
            $name =  $app->tests[$i]->name;
            $price = $app->tests[$i]->price;
            echo "
            
            <tr class=\"item\">
                    <td>
                    $name
                    </td>
                        
                    <td>
                        $price
                    </td>
                </tr>
            ";

            $i++;
           }
            $totalcost=$app->totalcost;
            
            echo "
            <tr class=\"total\">
                <td>
                </td>
                
                <td>
                sub Total: $totalcost
                </td>
            </tr>
       ";


           $str=$app->comment;
           if($str!=""||$str!=null)
           {
            $pieces = explode(",", $str);
           }

           for($i=0;$i<count($pieces);$i++)
           {
            $hi=$pieces[$i];
            echo "
            <tr class=\"total\">
                <td>
                </td>
                
                <td>
                $hi
                </td>
            </tr>
         ";
           }



           echo "
           <tr class=\"total\">
               <td>
               </td>
               
               <td>
               Total : $app->final_cost
               </td>
           </tr>
      ";




       echo"
            
        </table>
            <button type=\"button\" action=>print</button>
        </div>

        </body>
        </html>
        ";





    
    }



    public function footer()
    {

    }

}


?>