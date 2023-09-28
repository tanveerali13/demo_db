<?php
//// Displaying errors
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once "_includes/db_connect.php";

$query = "UPDATE expense SET added_on=?, expense_name=?, amount=?, details=? WHERE id=?";

if ($stmt = mysqli_prepare($link, $query)) {
    mysqli_stmt_bind_param($stmt, 'ssisi', $_GET["date"], $_GET["expense_name"], $_GET["amount"], $_GET["details"], $_GET["id"]);
    mysqli_stmt_execute($stmt);
    $stmt->close();
}
?>