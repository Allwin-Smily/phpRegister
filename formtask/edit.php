<?php 
ini_set('display_errors', 'on');
error_reporting(E_ALL);
include_once 'lib.php';
$mysqli = getDbObj();
//updating process of details do here
if (!empty(getInputData('submit'))) {
    $id = getInputData('id');
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
    $update = '
        UPDATE user_details 
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
                WHERE id = "'.$id.'"
            ';
    if ($password != $confirm_password) {
        $error_pass = "Password not Match!";
    } else {
        $result = $mysqli->query($update);
            if(!empty($result)) {
                header('Location: overview.php');
            } else {
                die("failure");
            }

    }
    }
} else {
    //provide the old details in field
    if (!empty(getInputData('edit'))) {
        $id = getInputData('edit');
        $record = 'SELECT * FROM user_details WHERE id = ' . $id;
        $result = $mysqli->query($record);
        if ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $user_id = $row['user_id'];
            $first_name = $row['first_name'];
            $middle_initial = $row['middle_initial'];
            $last_name = $row['last_name'];
            $email = $row['email'];
            $password = $row['password'];
            $confirm_password = $row['confirm_password'];
            $address = $row['address'];
            $city = $row['city'];
            $state = $row['state'];
            $pincode = $row['pincode'];
            $country = $row['country'];
            $phone = $row['phone'];
            $language = $row['language'];
        }
    }
}
?>
<html>
    <head>
        <title>Edit Details</title>
        <link type="text/css" rel="stylesheet" href="edit.css">
    </head>
    <body>
        <div class="container-width">
        <form action="" method="post">
            <h1>Edit Details</h1>
            <input type="hidden" class="input user_id" name="id" value="<?php if(isset($id)){echo $id ; } ?>"><br><br>
            <label class="text"> User ID : </label>
            <input type="text" class="input user_id" name="user_id" value="<?php if(isset($user_id)){echo $user_id ; } ?>">
            <span>*</span> 
            <?php if(!empty($error) && in_array('user_id', $error) ) { ?>
            <span>Fill it</span>
            <?php } ?>
            <br><br>
            <label class="text">First Name : </label>
            <input type="text" class="input first_name" name="first_name" 
                   value="<?php if(isset($first_name)){echo $first_name ; }?>">
            <span>*</span> 
            <?php if(!empty($error) && in_array('first_name', $error) ) { ?>
            <span>Fill it</span>
            <?php } ?>
            <br><br>
            <label class="text">Middle Initial : </label>
            <input type="text" class="input middle_initial" name="middle_initial" value="<?php if(isset($middle_initial)){echo $middle_initial ; } ?>"><br><br>
            <label class="text">Last Name : </label>
            <input type="text" class="input last_name" name="last_name" value="<?php if(isset($last_name)){echo $last_name ; } ?>">
            <span>*</span> 
            <?php if(!empty($error) && in_array('last_name', $error) ) { ?>
            <span>Fill it</span>
            <?php } ?>
            <br><br>
            <label class="text">Email:</label>
            <input type="text" class="input email" name="email" value="<?php if(isset($email)){echo $email ; } ?>">
            <br><br>
            <label class="text">Password : </label>
            <input type="password" class="input password" name="password" >
            <span>*</span> 
            <?php if(!empty($error) && in_array('password', $error) ) { ?>
            <span>Fill it</span>
            <?php } ?>
            <br><br>
            <label class="text">Confirm Password : </label>
            <input type="password" class="input confirm_password" name="confirm_password" >
            <span>*</span> 
            <?php if(!empty($error) && in_array('confirm_password', $error) ) { ?>
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
                <option value="tamilnadu" <?php echo $state =='tamilnadu' ? 'selected' : ''?>>TamilNadu</option>
                <option value="goa" <?php echo $state =='goa' ? 'selected' : ''?>>Goa</option>
                <option value="andhrapradesh" <?php $state =='andhrapradesh' ? 'selected' : ''?>>Andhra Pradesh</option>
                <option value="karantaka" <?php echo $state =='karantaka' ? 'selected' : ''?>>Karantaka</option>
                <option value="kerala" <?php echo $state =='kerala' ? 'selected' : ''?>>Kerala</option>
                <option value="delhi" <?php echo $state =='delhi' ? 'selected' : ''?>>Delhi</option>
            </select><br><br>
            <label class="text">Zip/Pincode : </label>
            <input type="text" class="input pincode" name="pincode" value="<?php if(isset($pincode)){echo $pincode ; } ?>"><br><br>
            <label class="text">Country : </label>
            <select class="country" name="country">
                <option value="india" <?php echo $country=='india' ? 'selected' : ''?>>India</option>
                <option value="england" <?php echo $country=='england' ? 'selected' : ''?>>England</option>
                <option value="australia" <?php echo $country=='australia' ? 'selected' : ''?>>Australia</option>
                <option value="singapore" <?php echo $country=='singapore' ? 'selected' : ''?>>Singapore</option>
                <option value="canada" <?php echo $country=='canada' ? 'selected' : ''?>>Canada</option>
            </select><br><br>
            <label class="text">Phone : </label>
            <input type="text" class="input phone" name="phone" value="<?php if(isset($phone)){echo $phone ; } ?>"><br><br>
            <label class="text">Language Preference : </label>
            <select class="language" name="language">
                <option value="tamil" <?php echo $language =='tamil' ? 'selected' : '' ?>>Tamil</option>
                <option value="english" <?php echo $language =='english' ? 'selected' : '' ?>>English</option>
                <option value="telugu" <?php echo $language =='telugu' ? 'selected' : '' ?>>Telugu</option>
                <option value="kannada" <?php echo $language =='kannada' ? 'selected' : '' ?>>Kannada</option>
                <option value="malayalam" <?php echo $language=='malayalam' ? 'selected' : ''  ?>>Malayalam</option>
                <option value="hindi" <?php echo $language=='hindi' ? 'selected' : ''  ?>>Hindi</option>
            </select><br><br>
            <input type="submit" class="button" value="Update" name="submit">
            <input type="submit" class="button" value="Cancel" name="cancel">
        </form>
        </div>
    </body>
</html>