<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);
include 'lib.php';
$mysqli = getDbObj();
if(!empty(getInputData('delete'))) {
    $id = getInputData('delete');
        $query = '
                DELETE FROM user_details WHERE id = "'.$id.'"
            ';
if($mysqli->query($query)) {
    header('Location: overview.php');
}
else {
    die("error");
}
}
