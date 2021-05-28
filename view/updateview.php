<?php


class updateform
{
    function __construct($myuser)
    {
       echo"
                        <html lang=\"en\">
                <head>
                    <meta charset=\"UTF-8\">
                    <title>Create Record</title>
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
                                        <h2> update record</h2>
                                    </div>
                                    <p>Please fill this form and submit to edit users.</p>
            ";


        echo "


        <form action=\" /test/controller/updateusercontroller.php \" method=\"post\">
            <div class=\"form-group \">
                <label>Name</label>
                <input type=\"text\" name=\"name\" class=\"form-control\" value=\"$myuser->name\"> 
                <input type=\"hidden\" name=\"uid\" class=\"form-control\" value=\"$myuser->id\"> 
                <span class=\"help-block\"></span>
            </div>
            <div class=\"form-group \">
            <label>gender</label>
            <input type=\"text\" disabled name=\"gender\" class=\"form-control\" value=\"$myuser->gender\"> 
            <span class=\"help-block\"></span>
            </div>
            <div class=\"form-group \">
            <label>dob</label>
            <input type=\"text\" disabled name=\"dob\" class=\"form-control\" value=\"$myuser->dob\"> 
            <span class=\"help-block\"></span>
            </div>
            <div class=\"form-group\">
                <label>address</label>
                <input type=\"text\" name=\"address\" class=\"form-control\" value=\"$myuser->address\">
                <span class=\"help-block\"></span>
            </div>
            <div class=\"form-group\">
            <label>phone</label>
            <input type=\"text\" name=\"phone\" class=\"form-control\" value=\"$myuser->phone_number\">
            <span class=\"help-block\"></span>
        </div>
        <button type=\"submit\" name='update' class=\"btnRegister\">  ADD </button>
        ";
       //<input type=\"submit\" class=\"btn btn-primary\" value=\"Submit\">
  
  
  echo"     <a href=\"/test/controller/doctorcontroller.php\" class=\"btn btn-default\">Cancel</a>
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

