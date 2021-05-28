<?php 
class addcustomreport
{
    function __construct($test)
    {
     
      
        $file="C:/xampp/htdocs/test/view/addreport.php";
        if (file_exists($file)) 
        {
            echo file_get_contents($file);
        }
        else
        {
            echo "file not found";
        }
        $this->display();
    }
    public static function display($test)
    {

       
        echo "


        <form action=\"/test/controller/addnewcostomcontroller.php\" method=\"post\">

            <div class=\"form-group \">
                <label>report name</label>
                <input required type=\"text\"  name=\"name\" class=\"form-control\" value=\"\"> 
                <span class=\"help-block\"></span>
            </div>



           

           

            <div class=\"form-group \">
            <label>appoitment date type</label>
            <select  name=\"appdatetype\" class=\"form-control\"> 
            <option value=\"none\">none</option>
            <option value=\"max\">max</option>
            <option value=\"min\">min</option>
            </select>
            <span class=\"help-block\"></span>
            </div>

            <div class=\"form-group \">
            <label>appoitment date </label>
            <input type=\"date\"  name=\"appdate\" class=\"form-control\" value=\"\"> 
            <span class=\"help-block\"></span>
            </div>




            <div class=\"form-group \">
            <label>patient date of birth type</label>
            <select  name=\"dobtype\" class=\"form-control\"> 
            <option value=\"none\">none</option>
            <option value=\"max\">max</option>
            <option value=\"min\">min</option>
            </select>
            <span class=\"help-block\"></span>
            </div>

           

            <div class=\"form-group \">
            <label>date of birth</label>
            <input type=\"date\"  name=\"dob\" class=\"form-control\" value=\"\"> 
            <span class=\"help-block\"></span>
            </div>

            <div class=\"form-group \">
            <label>gender</label>
            <select  name=\"gender\" class=\"form-control\"> 
            <option value=\"none\">either</option>
            <option value=\"1\">male</option>
            <option value=\"0\">female</option>
            </select>

            <span class=\"help-block\"></span>
            </div>
        
         
           
        <button type=\"submit\" name='create' class=\"btnRegister\">  create report </button>
     
        ";
     
  
  
        // echo"     <a href=\"/tests/controller/showappcontroller.php\" class=\"btn btn-default\">Cancel</a>
        // </form>
        // ";








                echo "
                            </div>
                        </div>        
                    </div>
                    </div>
                    </body>
                    </html>

                    ";


    }

}
      
        
    

    

