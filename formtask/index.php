<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);

include_once 'lib.php';
$mysqli = getDbObj();
if (!empty(getInputData('submit'))) {
    $user_id  = getInputData('user_id');
    $password = getInputData('password');
    if(empty($user_id) || empty($password)) {
        $errorMessage = "User Id or Password is Empty";
    } else {
        $query = '
                SELECT user_id, password FROM user_details
                WHERE user_id = "'.$user_id.'" AND
                    password = "'.$password.'"
                ';
        $result = $mysqli->query($query);
        if ($result->num_rows == 1) {
            header('Location: overview.php');
        }
        else {
            $errorMessage = "Wrong User Id or Password";
        }
    }
}
?>
<html>
    <head>
        <title>Log In</title>
        <link type="text/css" rel="stylesheet" href="login.css">
        <style>
            .color {
            color: red;
            border: 1px solid black;
            background-color: white;
            margin-left: 50px;
            }
        </style>
    </head>
    <body>
        <div class="container-width">
            <form action="<?php $_PHP_SELF?>" method="post">
                <h1>Log In</h1>
                
                <label class="text">User ID </label>
                <input type="text" class="input1" name="user_id" value="<?php if(isset($user_id)){echo $user_id ; } ?>"><br><br>
                <label class="text">Password </label>
                <input type="password" class="input2" name="password"><br>
                <input type="checkbox" class="remember" name="remember" value="remember">Remember me<br> 
                <?php if(!empty($errorMessage)){ ?>
                <span class="color"> Warning! <?php echo $errorMessage ?></span>
                <?php } ?><br>
                <input type="submit" class="button" name="submit" value="Log In"><br>
                <label>Not Registered?</label>
                <a href="/php/formtask/signup.php"> Create an account</a>
            </form>
        </div>
    </body>
</html>
