<?php
require_once "_includes/db_connect.php";
/* _v2 adds try / catch / finally error checking */
$results = [];
$insertedRows = 0;

try {
  if (!isset($_REQUEST["expense_name"]) || !isset($_REQUEST["amount"])) {
    throw new Exception('Required data is missing i.e. expense_name, amount or details');
  } else {
    $query = "INSERT INTO expense (added_on, expense_name, amount, details) VALUES (?, ?, ?, ?)";
    //$added_on = date('yyyy-mm-dd');

    if ($stmt = mysqli_prepare($link, $query)) {
      mysqli_stmt_bind_param($stmt, 'ssis', $_REQUEST["date"], $_REQUEST["expense_name"], $_REQUEST["amount"], $_REQUEST["details"]);
      mysqli_stmt_execute($stmt);
      $insertedRows = mysqli_stmt_affected_rows($stmt);

      if ($insertedRows > 0) {
        $results[] = [
          "insertedRows" => $insertedRows,
          "id" => $link->insert_id,
          "date" => $_REQUEST["date"],
          "expense_name" => $_REQUEST["expense_name"],
          "amount" => $_REQUEST["amount"],
          "details" => $_REQUEST["details"]
        ];
      } else {
        throw new Exception("No rows were inserted");
      }
      //removed the echo from here
      //echo json_encode($results);
    } else {
      throw new Exception("Prepared statement did not insert records.");
    }
  }

} catch (Exception $error) {
  //add to results array rather than echoing out errors
  $results[] = ["error" => $error->getMessage()];
} finally {
  //echo out results
  echo json_encode($results);
}

?>