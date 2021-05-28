<?php


class loginview
{
    public static function display($html)
    {
        
        echo $html;           
    }
    public static function verifylogin($verify)
    {
        if(!$verify)
        {
            echo '<script> alert("Wrong Username or Password") </script>' ;
        }
    }
}
