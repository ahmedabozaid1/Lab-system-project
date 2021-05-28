<?php 
class addpaymentview 
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
 
    public static function display($app)
    {

        $strname=$app->patient->name;
        echo "


        <form action=\" /test/controller/addpaymentcontroller.php \" method=\"post\">
            <div class=\"form-group \">
                <label>Name</label>
                
                <input type=\"text\" disabled name=\"name\" class=\"form-control\" value=\"$strname \"> 
                <input type=\"text\" name=\"id\" class=\"form-control\" value=\"$app->id\"> 
                <span class=\"help-block\"></span>
            </div>
            <div class=\"form-group \">
            <label>time</label>
            <input type=\"text\" disabled name=\"time\" class=\"form-control\" value=\"$app->time\"> 
            <span class=\"help-block\"></span>
            </div>
            <div class=\"form-group \">
            <label>date</label>
            <input type=\"text\" disabled name=\"date\" class=\"form-control\" value=\"$app->date\"> 
            <span class=\"help-block\"></span>
            </div>
            <div class=\"form-group\">
                <label>total cost</label>
                <input type=\"text\" disabled name=\"total cost\" class=\"form-control\" value=\"$app->final_cost\">
                <span class=\"help-block\"></span>
            </div>
            <div class=\"form-group\">
            <label>payed amount</label>
            <input type=\"text\" name=\"payedamount\" class=\"form-control\" value=\"$app->payedamount\">
            <span class=\"help-block\"></span>
        </div>
        <button type=\"submit\" name='update' class=\"btnRegister\">  ADD </button>
        ";
       //<input type=\"submit\" class=\"btn btn-primary\" value=\"Submit\">
  
  
        echo"     <a href=\"/tests/controller/showappcontroller.php\" class=\"btn btn-default\">Cancel</a>
        </form>
        ";








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
      
        
    

    

