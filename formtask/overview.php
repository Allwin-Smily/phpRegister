<?php 
ini_set('display_errors', 'on');
error_reporting(E_ALL);
include 'lib.php';
$mysqli = getDbObj();
    $query = '
            SELECT *FROM user_details
            ';
        $result = $mysqli->query($query);
?>
<html>
    <head>
        <title>Overview of details</title>
        <script language="JavaScript" type="text/javascript">
            function checkDelete() {
                return confirm('Do You Want to Delete the Details?');
            }
        </script>
    </head>
    <body>
        <table width="100%" border="1">
            <tr>
            <th>ID</th>
            <th>USER ID</th>
            <th>FIRST NAME</th>
            <th>LAST NAME</th>
            <th>EMAIL</th>
            <th>Edit</th>
            <th>Delete</th>
            </tr>
            <?php if(!empty($result)) {?>
            <?php 
            while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td align="center"><?php echo $row["id"]; ?></td>
                <td align="center"><?php echo $row["user_id"]; ?></td>
                <td align="center"><?php echo $row["first_name"]; ?></td>
                <td align="center"><?php echo $row["last_name"]; ?></td>
                <td align="center"><?php echo $row["email"]; ?></td>
                <td align="center">
                    <a href="edit.php?edit=<?php echo $row["id"]; ?>">Edit</a>
                </td>
                <td align="center">
                    <a href="delete.php?delete=<?php echo $row["id"]; ?>" onclick="return checkDelete()">Delete</a>
                </td>
            </tr>
            <?php } }
            else {
            ?>
            <tr><td>Data Not Found</td></tr>
            <?php }
            ?>
        </table>
    </body>
</html>