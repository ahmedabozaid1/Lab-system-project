<?php

class creatapp 
{
    public function __construct()
    {
        $file="C:/xampp/htdocs/test/view/createapp.php";
        if (file_exists($file)) 
        {
            echo file_get_contents($file);
        }
        else
        {
            echo "file not found";
        }

    }
    public function viewform($patients)
    {
        
        $num=count($patients);
        $j=0;
     

      

        echo"
        <div class='login-form'>
        <form action='/test/controller/createapoitmentcontroller.php' method='post'>
        <h2 class='text-center'>new appoitment</h2>   
        <div class='form-group'>
        <label for='np'>Patient name</label>
        <select class='form-control'  name='np' id='np'>";
        while($j<$num)
        {
            $strn=$patients[$j]->name;

            echo"
        
                <option value='$j'>$strn</option>

            
                ";
            $j++;
        }
            echo"
            </select>
            </div>
            ";


        echo"

        
        <!-- patient name -->
        <div class='form-group'>

        <input type='date' id ='date' class='form-control' name='dates' required='required' />
        </div>
        <!-- date -->
        <div class='form-group'>
        <input type='time' class='form-control' name='time' id='appt' placeholder='time*'  value='' required='required'/>
        
        </div>
        <!-- time -->
        <div class='form-group'>
        <input type='text' class='form-control' name='payedamount' placeholder='payed amount*' value='' required='required'/>
        </div>

        <!-- payed amount -->
        

        <!--report date and time -->




        <div class='form-group'>
        <input type='text' class='form-control' name='discount' placeholder='discount amount*' value='' />
        </div>
        <div class='form-group'>
        <input type='checkbox' name='urgent' value='1' />urgent (add 10%)<br /> 
        </div>
        <!--
        check box for urgent
        input box for discont
    	-->      


        <div class='form-group'>    
        <ul>
        ";
    }
    public static function displayparent($parent)
    {
       // display the parent 
       echo "<li>$parent->name <br/> ";
    }
    public static function displaychild($child)
    {
        $i=0;
        while($i<count($child))
        {
            $id=$child[$i]->id;
            $name=$child[$i]->name;
          echo "
          <input type=\"checkbox\" name=\"choose[]\" value=\"$id\" />$name<br /> 
          ";
            $i++;
        }
        
        echo "</li>"; // the opend in parent

         }

    public function footor()
    {
        echo "
            </div>
                </ul>
                    <div class=\"form-group\">
                    <button type=\"submit\" name='ad' class=\"btnRegister\">  ADD </button>
                    </div> 
                </form>

            </div>
            </body>
            </html>             
        ";
    }
}
