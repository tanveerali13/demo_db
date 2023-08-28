<?php
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

require_once "_includes/db_connect.php";

$results = [];
$insertedRows = 0;

//INSERT INTO `demo` (`demoID`, `name`, `email`, `tvshow`, `timestamp`) VALUES (NULL, 'Tom Cruise', 'tom@mail.com', 'Mission Impossible', current_timestamp());

$query = "INSERT INTO demo(name, email, tvshow) VALUES (?, ?, ?)";

if ($stmt =  mysqli_prepare($link, $query)){
    mysqli_stmt_bind_param($stmt, 'sss', $_REQUEST["full_name"], $_REQUEST["email"], $_REQUEST["tvshow"]);
    mysqli_stmt_execute($stmt);
    $insertedRows = mysqli_stmt_affected_rows($stmt);

    if($insertedRows >0){
        $results[] = [
            "insertedRows" => $insertedRows,
            "id" => $link->insert_id,
            "full_name" => $_REQUEST["full_name"]
        ];
    }
    echo json_encode($results);
}

//https://www.sktanveer65.web582.com/dynamic-web-prog/demo_db/app/insert.php?full_name=Robin&email=robin@mail.com&tvshow=Robinhood
 //test

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>insert</title>
</head>
<body>
    <form action="" method="POST">
        <input type="text" name="full_name" placeholder="Write full name">
        <input type="email" name="email" placeholder="Email">
        <input type="text" name="tvshow" placeholder="Enter TV Show">
        <input type="submit" value="submit">
    </form>
</body>
</html>

