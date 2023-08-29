<?php
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

require_once "_includes/db_connect.php";

$results = [];
$insertedRows = 0;

$query = "INSERT INTO expense(expense_name, amount, details) VALUES (?, ?, ?)";

if ($stmt =  mysqli_prepare($link, $query)){
    mysqli_stmt_bind_param($stmt, 'sis', $_REQUEST["expense_name"], $_REQUEST["amount"], $_REQUEST["details"]);
    mysqli_stmt_execute($stmt);
    $insertedRows = mysqli_stmt_affected_rows($stmt);

    if($insertedRows >0){
        $results[] = [
            "insertedRows" => $insertedRows,
            "id" => $link->insert_id,
            "expense_name" => $_REQUEST["expense_name"],
            "amount" => $_REQUEST["amount"],
            "details" => $_REQUEST["details"]
        ];
    }
    echo json_encode($results);
}

//https://www.sktanveer65.web582.com/dynamic-web-prog/demo_db/app/insert.php?expense_name=Fuel&amount=90&details=Trip to Mont-Tremblant

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>insert</title>
</head>
<body>
    <section>
        <h1>Expense Tracker</h1>
        <form action="" method="POST">
            <table>
                <tr>
                    <td><h3>Expense Name</h3></td>
                    <td><input type="text" name="expense_name" placeholder="Name the expense" required></td>
                </tr>

                <tr>
                    <td><h3>Amount</h3></td>
                    <td><input type="float" name="amount" placeholder="Amount" required></td>
                </tr>

                <tr>
                    <td><h3>Details</h3></td>
                    <td><input type="text" name="details" placeholder="Details"></td>
                </tr>

                <tr>
                    <td></td>
                    <td><input type="submit" value="Submit"></td>
                </tr>

            </table>      
        </form>
    </section>
</body>
</html>

