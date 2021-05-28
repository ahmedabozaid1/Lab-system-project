<?php 
class showappview
{
    function __construct()
    {
     
      
        $file="C:/xampp/htdocs/test/view/showapp.php";
        if (file_exists($file)) 
        {
            echo file_get_contents($file);
        }
        else
        {
            echo "file not found";
        }

    }
    public static function display($allapps)
    {
   
      
                echo "<table class='table table-bordered table-striped'>";
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th>#</th>";
                            echo "<th>patient name</th>";
                            echo "<th>date</th>";
                            echo "<th>time</th>";                            
                            echo "<th>confirmed</th>";
                            echo "<th>total cost</th>";
                            echo "<th>payed amount</th>";
                            echo "<th>test</th>";
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    
                    $i=0;
                    while($i<count($allapps)){
                        echo "<tr>";
                       
                        
                           $strid=$allapps[$i]->id;
                           $srtname=$allapps[$i]->patient->name;
                           $srttime=$allapps[$i]->time;
                           $srtdate=$allapps[$i]->date;
                           if($allapps[$i]->isconfirmed==1)
                           {
                               $conf="yes";
                           }
                           else{
                               $conf="no";
                           }
                           $strconfirmed=$conf;
                           $strtotalcost=$allapps[$i]->totalcost;
                           $strpyam=$allapps[$i]->payedamount;

                           
                            echo "<td> <input disabled type='text' name='idzzz' value='$strid' </td>";
                            echo "<td> <input disabled type='text' id='nam' name='name'value='$srtname' </td>";
                            echo "<td> <input disabled type='text' name='type'value='$srtdate' </td>";
                            echo "<td> <input disabled type='text' name='dob'value='$srttime' </td>";
                            echo "<td> <input disabled type='text' name='gender'value='$strconfirmed' </td>";
                            echo "<td> <input disabled type='text' name='address'value='$strtotalcost' </td>";
                            echo "<td> <input disabled type='text' name='pn'value='$strpyam' </td>";
                            if($allapps[$i]->tests!=null)
                            {
                               $j=0;
                               
                               $number=count($allapps[$i]->tests);
                             if($number)
                             {
                               while($j<$number)
                               {
                                  $strtest[$j]=$allapps[$i]->tests[$j]->name;
                                   $j++;
                               }
                               $st=implode(",", $strtest);
                               echo "<td> <input disabled type='text' name='nametest'value='$st , ' </td> ";
                               echo" <br>";
                             }
                            }
                           
                          
                          echo "<form action='/test/controller/showappcontroller.php' method='get'>";    
                            
                             //   echo "<a href='read.php?id=". $allusers[$i]->id ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                            /// echo "<a href='/test/controller/reschedulecontroller.php?id=$strid' type='submit' name='edit' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                            //echo "<a  type='submit' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                            echo "<a href='/test/controller/showappcontroller.php?id=$strid&type=delete' type='submit' name='delete' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                            
                          ///  echo "<a href=''javascript:;' onclick = 'this.href=/OOSE/controller/doctorcontroller.php?name=' + document.getElementById('nam').value&id=$strid' type='submit' name='edit' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                        echo"</form>";


                        echo "<form action='/test/controller/reschedulecontroller.php' method='get'>";    
                            
                        //   echo "<a href='read.php?id=". $allusers[$i]->id ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                        echo "<a href='/test/controller/reschedulecontroller.php?id=$strid&type=edit' type='submit' name='edit' title='reschedule' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                     
                        echo"</form>";




                        echo "<form action='/test/controller/addpaymentcontroller.php' method='get'>";  
                        echo "<a href='/test/controller/addpaymentcontroller.php?id=$strid&type=addpayment' type='submit' name='addpayment' title='addpayment' data-toggle='tooltip'>Add Payment</a>";
                        echo"</form>";
                        echo "<form action='/test/controller/invoicecontroller.php' method='get'>";  
                        echo "<a href='/test/controller/invoicecontroller.php?id=$strid&type=invoice' type='submit' name='invoice' title='invoice' data-toggle='tooltip'>invoice</a>";
                        echo"</form>";
       

                      ////////  echo "<form action='/OOSE/controller/doctorcontroller.php' method='post'>"; 
                      ////  echo " <input type='hidden' name='idzzz' value='$strid' ";
                       ///// echo " <input type='hidden' id='nam' name='name'value='$srtname' ";
                       ///// echo " <input type='hidden' name='dob'value='$srtdob' ";
                      /////  echo " <input type='hidden' name='address'value='$straddress'" ;
                       /////// echo "<input type='submit' name='$strid' title='confirm'>update";
                        
                      //////  echo"</from>";

                        $i++;
                    }
                   ////// echo "<Button type='submit' name='confirm' title='confirm'>confrim</button>";
                    echo "</td>";
                echo "</tr>";
                echo" <div class='wrapper'>
           <div class='container-fluid'>
    <div class='row'>
        <div class='col-md-12'>
            <div class='page-header clearfix'>
                <h2 class='pull-left'>Appointments</h2>
                <form action='/test/controller/createapoitmentcontroller.php' method='post'>;    
                <button type='submit' name='add' class='btn btn-success pull-right'> Add New Appointment </button>
                </form>
            </div>
          ";
          echo " </form>";
            echo"
          
    <form action='/test/controller/waitingqueuecontroller.php' method='post'>
            
       
            <input type='date' class='form-control' name='date' required='required'>
            <input type='time' name='time'class='form-control'  required='required'>


            <button type='submit' name='search' class='btn btn-primary btn-bloc'>Search</button>
    </form>

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