<?php

class reschedule
{
    public function __construct()
    {
        $file="C:/xampp/htdocs/test/view/reschedule.php";
        if (file_exists($file)) 
        {
            echo file_get_contents($file);
        }
        else
        {
            echo "file not found";
        }

    }

    public function display($app)
    {
       ///// echo $app->id;
       ///// echo "hahahaha";
        $name=$app->patient->name;
        echo "
        
        <div class=\"form-group\">
        <input type=\"text\" disabled class=\"form-control\" name=\"namee\" placeholder=\"Name* \" value=\" $name\" required=\"required\"/>
        </div>
        
        <div class=\"form-group\">
        <input type=\"text\"  class=\"form-control\" name=\"id\" placeholder=\"id* \" value=\" $app->id\" required=\"required\"/>
        </div>
    
        <div class=\"form-group\">
        
        <input type=\"date\"  class=\"form-control\" name=\"date\" placeholder=\"Date*\" value=\" $app->date\" />
        </div>
        <div class=\"form-group\">
        
        <input type=\"hidden\"  class=\"form-control\" name=\"date1\" placeholder=\"Date*\" value=\" $app->date\" />
        </div>
      
        <div class=\"form-group\">
        <input type=\"time\"  class=\"form-control\" name=\"time\" placeholder=\"time*\" value=\"$app->time\" required=\"required\"/>
        </div>
      
        <div class=\"form-group\">
        <input type=\"text\" disabled class=\"form-control\" name=\"payedamount\" placeholder=\"payed amount*\" value=\"$app->payedamount\" required=\"required\"/>
        </div>
       
        ";

    }

    public function footor()
    {
        echo "
           
                    <div class=\"form-group\">

                    <button type=\"submit\" name='add' class=\"btnRegister\">  ADD </button>
                    </div> 

                    <div class=\"form-group\">
                    
                    <button type=\"res\" name='reseditnextmonth' class=\"btnRegister\"> same next month </button>
                    </div> 

                    <div class=\"form-group\">
                    
                    <button type=\"res\" name='resedittommorow' class=\"btnRegister\"> same time tommorow </button>
                    </div> 
                </form>

            </div>
            </body>
            </html>             
        ";
    }


    public function alert()
    {
        echo "
        this apoitment time is not avalible try again
        ";
    }
}
