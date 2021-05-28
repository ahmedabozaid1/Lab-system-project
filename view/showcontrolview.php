<?php 
class showcontrolview
{
    function __construct()
    {
     
      
        $file="C:/xampp/htdocs/test/view/showcontrol.php";
        if (file_exists($file)) 
        {
            echo file_get_contents($file);
        }
        else
        {
            echo "file not found";
        }

    }
    public static function display($alltests)
    {
                   echo "<table class='table table-bordered table-striped'>";
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th>#</th>";
                            echo "<th>test name</th>";
                            echo "<th>price</th>";
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    
                    $i=1;
                    while($i<count($alltests)){
                        echo "<tr>";
                       
                        if($alltests[$i]->patrent_id!=0)
                        {
                            $strid=$alltests[$i]->id;
                            $srtname=$alltests[$i]->name;
                            $srtprice=$alltests[$i]->price;
                        }else{
                            $i++;
                            continue;
                        }
                         
                          
                    
                           
                            echo "<td> <input disabled type='text' name='idzzz' value='$strid' </td>";
                            echo "<td> <input disabled type='text' id='nam' name='name'value='$srtname' </td>";
                            echo "<td> <input disabled type='text' name='type'value='$srtprice' </td>";
    
                           
                          
                         

                        echo "<form action='/test/controller/Controlpanel.php' method='get'>";    
                            
                            echo "<a href='/test/controller/Controlpanel.php?id=$strid&type=edit' type='submit' name='edit' title='reschedule' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                     
                        echo"</form>";

                        $i++;
                    }
                   
                    echo "</td>";
                echo "</tr>";
                echo" <div class='wrapper'>
           <div class='container-fluid'>
    <div class='row'>
        <div class='col-md-12'>
            <div class='page-header clearfix'>
                <h2 class='pull-left'>Manage Tests</h2>
                <form action='#' method='post'>;    
                <button type='submit' name='add' class='btn btn-success pull-right'> Add New test </button>
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