<?php
    //connect to db
require_once "_includes/db_connect.php";

$stmt = mysqli_prepare($link, "SELECT expense_name, amount, details, added_on FROM expense");

//execute the statment / query from above
mysqli_stmt_execute($stmt);

//get results
$result = mysqli_stmt_get_result($stmt);

//loop through
while($row = mysqli_fetch_assoc($result)){
    $results[] = $row;
}

//encode $ display json
echo json_encode($results);

//close the link to the db
mysqli_close($link);

?>
