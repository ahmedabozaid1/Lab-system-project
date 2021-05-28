<?php 
class addreport
{
    function __construct()
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
    public static function display()
    {

       
        echo "


        <form action=\"/test/controller/addnewreportcontroller.php \" method=\"post\">

            <div class=\"form-group \">
                <label>month</label>
                <input type=\"text\"  name=\"month\" class=\"form-control\" value=\"\"> 
             
                <span class=\"help-block\"></span>
            </div>

            <div class=\"form-group \">
            <label>year</label>
            <input type=\"text\"  name=\"year\" class=\"form-control\" value=\"\"> 
          
            <span class=\"help-block\"></span>
             </div>


        
            <div class=\"form-group \">
            <label>date</label>
            <input type=\"date\"  name=\"date\" class=\"form-control\" value=\"\"> 
            <span class=\"help-block\"></span>
            </div>
           
        <button type=\"submit\" name='dayReport' class=\"btnRegister\">  create daily report </button>
        <button type=\"submit\" name='monthReport' class=\"btnRegister\">  create monthly report </button>
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
      
        
    

    

