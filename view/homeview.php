<?php
    session_start();
    //require_once 'home.php';

    class homeview 
    {

        function display()
        {   
           //// require ""
            $file="../view/home.php";
            if (file_exists($file)) 
            {
                echo file_get_contents($file);

                echo "
                <body>
                <nav class='navbar navbar-default navbar-expand-lg navbar-light'>
                    <div id='navbarCollapse' class='collapse navbar-collapse'>
                        <ul class='nav navbar-nav'>";
                    
                            ///session_start();
                            $name=$_SESSION['username'];
                            echo"<li> <a>$name</a> </li>";
                            for($i=0;$i<count($_SESSION['url']);$i++)
                            {
                                $slink=$_SESSION['links'][$i];
                                $surl=$_SESSION['url'][$i];
                                echo "<li> <a href='$surl'>$slink</a> </li>";
                            }
                            
                    
                       echo" </ul>
                        <form action = '../../test/controller/homecontroller.php'class='navbar-form form-inline navbar-right ml-auto' method='post'> 
                                     
                            <div class='input-group search-box'>
                                <span class='input-group-btn'>
                                   
                                    <button type='submit' name='Logout' class='btn btn-primary'><span>Logout</span></button>
                                </span>
                            </div>
                        </form>		
                    </div>
                </nav>
                </body>";
            }
            else
            {
                echo 'file not found';
            }
        }
    }
 
?>
