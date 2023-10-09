<?php
$user = "example_user";
$password = "password";
$database = "example_database";
$table = "todo_list";

try {
    $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);
    $data = [];
    $sql = "SELECT item_id,content FROM $table";
    $result = $db->query($sql);

    foreach ($result as $row) {
        $item = new stdClass();
        $item->item_id = $row['item_id'];
        $item->content = $row['content'];
        array_push($data,  $item);
    }

    header("Content-Type: application/json");
    echo json_encode($data);
    exit();
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
