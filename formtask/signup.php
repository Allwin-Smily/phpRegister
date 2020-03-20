<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);
include_once 'lib.php';
$mysqli = getDbObj();
//Here the submitted value will be stored in a variable 
if(isset($_FILES['submit'])) {
    $errors= array();
    $image = $_FILES['file']['name'];
    $imageSize =$_FILES['file']['size'];
    $imageTmp =$_FILES['file']['tmp_name'];
    $imageType=$_FILES['file']['type'];
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $extensions= array("jpeg","jpg","png");
    $targetDir = dirname(__FILE__);
    if(in_array($imageFileType,$extensions)=== false) {
       $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    } 
    if($imagSize > 2097152) {
       $errors[]='File size must be excately 2 MB';
    }
    if(empty($errors)==true) {
        $targetDir = dirname(__FILE__);
        move_uploaded_file($file_tmp,$targetDir . '/images/' . $image);
        $query = "insert into profile (image) values('".$target_dir.$image."')";
        if(!empty($mysqli->query($query))) {
         return true;    
        }
    } else {
       print_r($errors);
    }
}
if (!empty(getInputData('submit'))) {
    $user_id = getInputData('user_id');
    $first_name = getInputData('first_name');
    $middle_initial = getInputData('middle_initial');
    $last_name = getInputData('last_name');
    $email = getInputData('email');
    $password = getInputData('password');
    $confirm_password = getInputData('confirm_password');
    $address = getInputData('address');
    $city = getInputData('city');
    $state = getInputData('state');
    $pincode = getInputData('pincode');
    $country = getInputData('country');
    $phone = getInputData('phone');
    $language = getInputData('language');
    $error = fieldValidation();
    //Here it check validation function is empty or not
    if (empty($error)) {
        // this is a query to insert the value into table
        $insert = '
            INSERT INTO user_details 
                SET user_id = "'.$user_id.'",
                    first_name = "'.$first_name.'",
                    middle_initial = "'.$middle_initial.'",
                    last_name = "'.$last_name.'",
                    email = "'.$email.'",
                    password = "'.$password.'",
                    confirm_password = "'.$confirm_password.'",
                    address = "'.$address.'",
                    city = "'.$city.'",
                    state = "'.$state.'",
                    pincode = "'.$pincode.'",
                    country = "'.$country.'",
                    phone = "'.$phone.'",
                    language = "'.$language.'"
                ';
        //Here we check whether both the password matches or not.
        //if both password doesn't match it show error or it goes to the else part and inserts the query in database.      
        if ($password != $confirm_password) {
            $error_pass = "Password not Match!";
        } else {
            $mysqli->query($insert);
            //Here we check that query has registered or not 
            // if not it show the error
            if (!empty($mysqli)) {
                header('Location: index.php');
            } else {
                echo 'Error: ' . $insert . '<br>' . $mysqli->error;
            }
        }
    }
}
?>
<html>
    <head>
        <title>Create New User</title>
        <link type="text/css" rel="stylesheet" href="signup.css">
    </head>
    <body>
        <div class="container-width">
            <form action="<?php $_PHP_SELF?>" method="post">
                <h1>Sign Up</h1>
                <label class="text"> User ID : </label>
                <input type="text" class="input user_id"name="user_id" value="<?php if(isset($user_id)){echo $user_id ; }?>">
                <span>*</span> 
                <?php if(!empty($error) && in_array('user_id', $error)) { ?>
                <span>Fill it</span>
                <?php } ?><br><br>
                <label class="text">First Name : </label>
                <input type="text" class="input first_name" name="first_name" value="<?php if(isset($first_name)){echo $first_name ; } ?>">
                <span>*</span> 
                <?php if(!empty($error) && in_array('first_name', $error) ) { ?>
                <span>Fill it</span>
                <?php } ?><br><br>
                <label class="text">Middle Initial : </label>
                <input type="text" class="input middle_initial" name="middle_initial" value="<?php if(isset($middle_initial)){echo $middle_initial ;} ?>"><br><br>
                <label class="text">Last Name : </label>
                <input type="text" class="input last_name" name="last_name" value="<?php if(isset($last_name)){echo $last_name ; } ?>">
                <span>*</span> 
                <?php if(!empty($error) && in_array('last_name', $error)) {?>
                <span>Fill it</span>
                <?php }?><br><br>
                <label class="text">Email:</label>
                <input type="text" class="input email" name="email" value="<?php if(isset($email)){echo $email ;} ?>">
                <br><br>
                <label class="text">Password : </label>
                <input type="password" class="input password" name="password" >
                <span>*</span> 
                <?php if(!empty($error) && in_array('password', $error)) { ?>
                <span>Fill it</span>
                <?php } ?>
                <br><br>
                <label class="text">Confirm Password : </label>
                <input type="password" class="input confirm_password" name="confirm_password" >
                <span>*</span> 
                <?php if(!empty($error) && in_array('confirm_password', $error)) {?>
                <span>Fill it</span>
                <?php } ?>
                <?php
                if(isset($error_pass)){?>
                <span value="<?php echo $error_pass ; ?>">Password not Match!</span>
                <?php } ?>
                <br><br>
                <label class="text">Address : </label>
                <input type="text" class="input address" name="address" value="<?php if(isset($address)){echo $address ; } ?>"><br><br>
                <label class="text">City : </label>
                <input type="text" class="input city" name="city" value="<?php if(isset($city)){echo $city ; } ?>"><br><br>
                <label class="text">State/Province : </label>
                <select class="state" name="state"><br>
                    <option value="tamilnadu" <?php echo getInputData('state')=='tamilnadu' ? 'selected' : ''?>>TamilNadu</option>
                    <option value="goa" <?php echo getInputData('state')=='goa' ? 'selected' : ''?>>Goa</option>
                    <option value="andhrapradesh" <?php echo getInputData('state')=='andhrapradesh' ? 'selected' : ''?>>Andhra Pradesh</option>
                    <option value="karantaka" <?php echo getInputData('state')=='karantaka' ? 'selected' : ''?>>Karantaka</option>
                    <option value="kerala" <?php echo getInputData('state')=='kerala' ? 'selected' : ''?>>Kerala</option>
                    <option value="delhi" <?php echo getInputData('state')=='delhi' ? 'selected' : ''?>>Delhi</option>
                </select><br><br>
                <label class="text">Zip/Pincode : </label>
                <input type="text" class="input pincode" name="pincode" value="<?php if(isset($pincode)){echo $pincode ; } ?>"><br><br>
                <label class="text">Country : </label>
                <select class="country" name="country">
                    <option value="india" <?php echo getInputData('country')=='india' ? 'selected' : ''?>>India</option>
                    <option value="england" <?php echo getInputData('country')=='england' ? 'selected' : ''?>>England</option>
                    <option value="australia" <?php echo getInputData('country')=='australia' ? 'selected' : ''?>>Australia</option>
                    <option value="singapore" <?php echo getInputData('country')=='singapore' ? 'selected' : ''?>>Singapore</option>
                    <option value="canada" <?php echo getInputData('country')=='canada' ? 'selected' : ''?>>Canada</option>
                </select><br><br>
                <label class="text">Phone : </label>
                <input type="text" class="input phone" name="phone" value="<?php if(isset($phone)){echo $phone ; } ?>"><br><br>
                <label class="text">Language Preference : </label>
                <select class="language" name="language">
                    <option value="tamil" <?php echo getInputData('language')=='tamil' ? 'selected' : '' ?>>Tamil</option>
                    <option value="english" <?php echo getInputData('language') =='english' ? 'selected' : '' ?>>English</option>
                    <option value="telugu" <?php echo getInputData('language') =='telugu' ? 'selected' : '' ?>>Telugu</option>
                    <option value="kannada" <?php echo getInputData('language') =='kannada' ? 'selected' : '' ?>>Kannada</option>
                    <option value="malayalam" <?php echo getInputData('language')=='malayalam' ? 'selected' : ''  ?>>Malayalam</option>
                    <option value="hindi" <?php echo getInputData('language')=='hindi' ? 'selected' : ''  ?>>Hindi</option>
                </select><br><br>
                <label class="text">Profile Image:</label>
                <input type="file" class="file-button" name="file" value="choose file.." /><br>
                <input type="submit" class="button" value="Create New User" name="submit">
                <input type="submit" class="button" value="Cancel" name="cancel">
            </form>
        </div>
    </body>
</html>