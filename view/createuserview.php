<?php

class createuserview 
{

    
    public static function display()
    {

      
        $file="C:/xampp/htdocs/test/view/createuser.php";
        if (file_exists($file)) 
        {
            echo file_get_contents($file);
        }
        else
        {
            echo "file not found";
        }

        // echo"<div class='form-group'>";
        // echo "<select class='form-control'>";
        // echo " <option class='form-control'  selected disabled>Select type</option>";
        // echo "<option>What is your Pet Name?</option>";
        // echo"</select>";
        // echo "</div>";
       
    }
}
