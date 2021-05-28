<?php
class View {

    public static function redirect($url)
    {
        echo "<script type='text/javascript'>document.location.href='{$url}';</script>";
    }
    public static function Alert($content)
    {
      echo '<script> alert("'.$content.'") </script>' ; 
    }

}
?>
