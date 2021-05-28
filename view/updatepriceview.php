<?php


class updateprice
{
    function __construct($test)
    {
       echo"
                        <html lang=\"en\">
                <head>
                    <meta charset=\"UTF-8\">
                    <title>update Record</title>
                    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css\">
                    <style type=\"text/css\">
                        .wrapper{
                            width: 500px;
                            margin: 0 auto;
                        }
                    </style>
                </head>
                <body>
                    <div class=\"wrapper\">
                        <div class=\"container-fluid\">
                            <div class=\"row\">
                                <div class=\"col-md-12\">
                                    <div class=\"page-header\">
                                        <h2> update price</h2>
                                    </div>
                                    <p>Please fill this form and submit to edit users.</p>
            ";


        echo "


        <form action=\"/test/controller/Controlpanel.php \" method=\"post\">
            <div class=\"form-group \">
                <label>Name</label>
                <input type=\"disabled\" name=\"name\" class=\"form-control\" value=\"$test->name\"> 
                <input type=\"hidden\" name=\"tid\" class=\"form-control\" value=\"$test->id\"> 
                <span class=\"help-block\"></span>
            </div>

            <div class=\"form-group \">
            <label>price</label>
            <input type=\"text\"  name=\"price\" class=\"form-control\" value=\"$test->price\"> 
            <span class=\"help-block\"></span>
            </div>

            <button type=\"submit\" name='update' class=\"btnRegister\"> update</button>
        ";
       //<input type=\"submit\" class=\"btn btn-primary\" value=\"Submit\">
  
  
  echo"     <a href=\"/test/controller/Controlpanel.php\" class=\"btn btn-default\">Cancel</a>
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

