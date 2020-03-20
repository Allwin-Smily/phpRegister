<?php
//making connection to database
function getDbObj()
{
    $mysqli = new mysqli ('localhost','ss4u','123456','details');
    if ($mysqli ->connect_errno ) {
        printf("Connnection failed:%s\n", $mysqli->connect_error);
        die();
    }
    return $mysqli;
}

//return the inputvalue as POST or GET method or Default
function getInputData($fieldName, $default = '')
{
    $inputValue = null;
    if (!empty($fieldName) && isset($_POST[$fieldName])) {
        $inputValue = $_POST[$fieldName];
    } else if (!empty($fieldName) && isset($_GET[$fieldName])) {
        $inputValue = $_GET[$fieldName];
    }
    if (empty($inputValue) && !empty($fieldName) && !empty($default)) {
        $inputValue = $default;
    }
    return $inputValue;
}

// Here it validate the mandatory fields
function fieldValidation() {
    $errorArray = array();
    $validate = array('user_id','first_name','last_name','password','confirm_password');
    foreach ($validate as $key => $field) {
        $input = getInputData($field);
        if (!$input || empty($input)) {
            $errorArray[] = $field;
        }
    }
    return $errorArray;
}