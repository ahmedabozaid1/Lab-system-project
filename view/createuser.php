<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>login</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<style>
	.login-form {
		width: 340px;
    	margin: 50px auto;
	}
    .login-form form {
    	margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }
</style>
</head>
<body>
<div class="login-form">
    <form action="../../test/controller/createusercontroller.php" method="post">
        <h2 class="text-center">Log in</h2>       
        <div class="form-group">
        <input type="text" class="form-control" name="type" placeholder="Type* " value="" required="required"/>
        </div>
        <div class="form-group">
            <input type="password" name="pwd"class="form-control" placeholder="Password" required="required">
        </div>
        <div class="form-group">
        <input type="text" class="form-control" name="name" placeholder="Name* " value="" required="required"/>
        </div>
        <div class="form-group">
        <input type="text" class="form-control" name="address" placeholder="Address *" value="" required="required"/>
        </div>
          
        <div class="form-group">
        <input type="text" class="form-control" name="dob" placeholder="Date of Birth *" value="" required="required"/>
        </div>
        <div class="form-group">
        <input type="text" class="form-control" placeholder="username *" name="username" value=""required="required" />
        </div>
        <div class="form-group">
        <input type="text" minlength="11" maxlength="11" name="Phone" class="form-control" placeholder="Phone number *" value="" required="required" />
        </div>
        <div class="form-group">
                <div class="maxl">
                <label class="radio inline"> 
                <input type="radio" name="gender" value="male" checked>
                <span > Male </span> 
                </label>
                <label class="radio inline"> 
                <input type="radio" name="gender" value="female">
                <span >Female </span> 
                </label>
                </div>
        </div>

        <div class="form-group">
        <button type="submit" name='add' class="btnRegister">  ADD </button>
        </div> 
    </form>

</div>
</body>
</html>             
