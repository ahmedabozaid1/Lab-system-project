<?php 
class detailsview 
{
    public $myapid;
    function __construct()
    {
     
      
        $file="C:/xampp/htdocs/test/view/apptestdetail.php";
        if (file_exists($file)) 
        {
            echo file_get_contents($file);
        }
        else
        {
            echo "file not found";
        }

    }
 
    public static function display($myap)
    {
        $myapid=$myap->id;
        // id  name // edit messure // show result
      
                echo "<table class='table table-bordered table-striped'>";
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th>test number</th>";
                            echo "<th> name</th>";
                           
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    
                    $i=0;
                    while($i<count($myap->tests)){
                        echo "<tr>";
                       
                        
                           $strid=$myap->tests[$i]->id;
                           $srtname=$myap->tests[$i]->name;
                       

                           
                            echo "<td> <input disabled type='text' name='idzzz' value='$strid' </td>";
                            echo "<td> <input disabled type='text' id='nam' name='name'value='$srtname' </td>";
                           
                     
                           
                          
                     
                        
                        echo "<td>";
                        echo "<form action='/test/controller/addmeasurecontroller.php' method='get'>";    ///add messure controller *2links please
                        echo "<a href='/test/controller/addmeasurecontroller.php?idapp=$myapid&id=$strid&type=submit' type='submit' name='edit' title='addmessure' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                        echo"</form>";


                        
                    
                            echo "<form action='/test/controller/showresultcontroller.php' method='get'>";  ///show result controller
                            echo "<a href='/test/controller/showresultcontroller.php?idapp=$myapid&id=$strid&type=result' type='submit' name='showresult' title='Result' data-toggle='tooltip'>Result</a>";
                            echo"</form>";
                        
                        echo "</td>";
       

                        $i++;
                    }
                   

                    echo "</td>";
                echo "</tr>";
                echo" <div class='wrapper'>
           <div class='container-fluid'>
    <div class='row'>
        <div class='col-md-12'>
            <div class='page-header clearfix'>
                <h2 class='pull-left'>Appointments details for Appointment number $myapid </h2>
               
             
                
            </div>
          ";
        

         
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