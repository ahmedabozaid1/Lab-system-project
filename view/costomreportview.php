<?php


class costomreportview
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
     
        echo "
        <div class=\"invoice-box\">
        <table cellpadding=\"0\" cellspacing=\"0\">
  
            
            <tr class=\"information\">
                <td colspan=\"3\">
                    <table>
                        <tr>
                            <td>
                            Report #: $report->id <br>
                            Report created time : $report->time<br>
                            Report name: $report->name
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
           while($i<count($report->names))
           {
            $name =  $report->names[$i];
            $count = $report->count[$i];
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