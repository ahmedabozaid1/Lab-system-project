<?php


class reportview
{
   public $a;
    public function __construct($report)
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
        $this->displayinfo($report);
    }
    public function displayinfo($report)
    {
        $inttype=$report->type;
        if($inttype==1)
        {
            $srttype="daily report";
        }
        if($inttype==2)
        {
            $srttype="mothly report";
        }
        echo "
        <div class=\"invoice-box\">
        <table cellpadding=\"0\" cellspacing=\"0\">
  
            
            <tr class=\"information\">
                <td colspan=\"3\">
                    <table>
                        <tr>
                            <td>
                            Report #: $report->id <br>
                            Report date: $report->date<br>
                            Report Type: $srttype
                            </td>
                         
                        </tr>
                    </table>
                </td>
            </tr>
        ";
        

        echo"
        
                
            <tr class=\"heading\">
            <td>
                Item
            </td>
            
            <td>
                count
            </td>
        </tr>
        ";
           $i=0;
           while($i<count($report->test))
           {
            $name =  $report->test[$i]->name;
            $count = $report->test_count[$i];
            echo "
            
            <tr class=\"item\">
                    <td>
                    $name
                    </td>
                        
                    <td>
                        $count
                    </td>
                </tr>
            ";

            $i++;
           }
            $totalcost=$report->total_income;
            
            echo "
            <tr class=\"total\">
                <td>
                </td>
                
                <td>
                total income: $totalcost
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



}


?>