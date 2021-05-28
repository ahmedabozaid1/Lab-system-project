<?php 
class allreportsview
{
    function __construct()
    {
     
      
        $file="C:/xampp/htdocs/test/view/viewallreports.php";
        if (file_exists($file)) 
        {
            echo file_get_contents($file);
        }
        else
        {
            echo "file not found";
        }

    }
    public static function display($allreports)
    {
                   echo "<table class='table table-bordered table-striped'>";
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th>#</th>";
                            echo "<th>Report Type</th>";
                            echo "<th>Total Income</th>";
                            echo "<th>date</th>";
                            echo "<th>Action</th>";
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    if($allreports)
                    {
                        $i=0;
                        while($i<count($allreports)){
                            $strid=$allreports[$i]->id;
                            $inttype=$allreports[$i]->type;
                            if($inttype==1)
                            {
                                $srttype="daily report";
                            }
                            if($inttype==2)
                            {
                                $srttype="mothly report";
                            }
                            
                            $srtprice=$allreports[$i]->total_income;
                            $srtdate=$allreports[$i]->date;
                            echo "<tr>";
                           
     
                        
                               
                                echo "<td> <input disabled type='text' name='idzzz' value='$strid' </td>";
                                echo "<td> <input disabled type='text' id='nam' name='name'value='$srttype' </td>";
                                echo "<td> <input disabled type='text' name='type'value='$srtprice' </td>";
                                echo "<td> <input disabled type='text' name='type'value='$srtdate' </td>";
                                echo"<td>";
                                echo "<form action='/test/controller/Controlpanel.php' method='get'>";    
                                
                                echo "<a href='/test/controller/viewallreportscontroller.php?id=$strid&type=edit' type='submit' name='edit' title='view' data-toggle='tooltip'>view report</a>";
                         
                            echo"</form>";
                             
    
    
                            $i++;
                        }
                       
                        echo "</td>";
                    echo "</tr>";
                    }
             
                echo" <div class='wrapper'>
           <div class='container-fluid'>
    <div class='row'>
        <div class='col-md-12'>
            <div class='page-header clearfix'>
                <h2 class='pull-left'>Past reports</h2>
                <form action='/test/controller/addnewreportcontroller.php' method='post'>    
                <button type='submit' name='add' class='btn btn-success pull-right'> Add New report </button>
                </form>
            </div>
          ";
          echo " </form>";
                      
                    echo "</tbody>";                            
                echo "</table>";
        echo"
                    </div>
                    </div>        
                </div>
            </div>
            </body>
            </html>
                    ";
        
    }


      
    
}
