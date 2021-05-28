<?php
//require ("C:/xampp/htdocs/OOSE/controller/doctorcontroller.php");


///// change usertype to str

class cruduserview 
{
    function __construct()
    {
        ////// css and java script 
       ///// $file="C:/xampp/htdocs/OOSE/view/cruddoctor.php";
        $file="C:/xampp/htdocs/test/view/cruddoctor.php";
        if (file_exists($file)) 
        {
            echo file_get_contents($file);
        }
        else
        {
            echo "file not found";
        }

    }
   
    public static function display($allusers)
    {
   
      
                echo "<table class='table table-bordered table-striped'>";
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th>#</th>";
                            echo "<th>Name</th>";
                            echo "<th>type</th>";
                            echo "<th>DOB</th>";                            
                            echo "<th>gender</th>";
                            echo "<th>Address</th>";
                            echo "<th>phone</th>";
                            echo "<th>Action</th>";
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    
                    $i=0;
                    while($i<count($allusers)){
                        echo "<tr>";
                       
                        
                           $strid=$allusers[$i]->id;
                           $srtname=$allusers[$i]->name;
                           $srttype=$allusers[$i]->type;
                           $srtdob=$allusers[$i]->dob;
                           $strgender=$allusers[$i]->gender;
                           $straddress=$allusers[$i]->address;
                           $strpn=$allusers[$i]->phone_number;

                            ///echo "<td>" . $allusers[$i]->id . "</td>";
                            echo "<td> <input type='text' name='idzzz' value='$strid' </td>";
                            echo "<td> <input type='text' id='nam' name='name'value='$srtname' </td>";
                            echo "<td> <input type='text' name='type'value='$srttype' </td>";
                            echo "<td> <input type='text' name='dob'value='$srtdob' </td>";
                            echo "<td> <input disabled type='text' name='gender'value='$strgender' </td>";
                            echo "<td> <input type='text' name='address'value='$straddress' </td>";
                            echo "<td> <input type='text' name='pn'value='$strpn' </td>";
                      

                           /// echo "<td>" .  $allusers[$i]->name . "</td>";
                           /// echo "<td>" .  $allusers[$i]->type . "</td>";
                            //echo "<td>" .  $allusers[$i]->dob . "</td>";
                           // /echo "<td>" .  $allusers[$i]->gender . "</td>";
                            //echo "<td>" .  $allusers[$i]->address . "</td>";
                          //  echo "<td>" .  $allusers[$i]->phone_number . "</td>";
                          echo "<td>";
                
                          echo "<form action='/test/controller/doctorcontroller.php' method='get'>";    
                            
                             //   echo "<a href='read.php?id=". $allusers[$i]->id ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                            echo "<a href='/test/controller/updateusercontroller.php?id=$strid' type='submit' name='edit' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                            //echo "<a  type='submit' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                            echo "<a href='/test/controller/doctorcontroller.php?id=$strid&type=delete' type='submit' name='delete' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                          ///  echo "<a href=''javascript:;' onclick = 'this.href=/OOSE/controller/doctorcontroller.php?name=' + document.getElementById('nam').value&id=$strid' type='submit' name='edit' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                        echo"</form>";

                        echo "<form action='/test/controller/doctorcontroller.php' method='post'>"; 
                        echo " <input type='hidden' name='idzzz' value='$strid' ";
                        echo " <input type='hidden' id='nam' name='name'value='$srtname' ";
                        echo " <input type='hidden' name='dob'value='$srtdob' ";
                        echo " <input type='hidden' name='address'value='$straddress'" ;
                        echo "<input type='submit' name='$strid' title='confirm'>";
                        
                        echo"</from>";

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
                <h2 class='pull-left'>Employees Details</h2>
                <button type='submit' name='addnew' class='btn btn-success pull-right'>Add New Employee</button>
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
