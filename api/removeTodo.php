<?php
$user = "example_user";
$password = "password";
$database = "example_database";
$table = "todo_list";

try {
    $item_id = $_GET['item_id'];

    if ($item_id == "") {
        http_response_code(400);
        exit();
    }

    $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $sql = "DELETE FROM $database.$table WHERE item_id=$item_id";
    $db->prepare($sql);
    $db->query($sql);
    echo "
    <div class=\"flex w-full bg-neutral-800 rounded-lg shadow-sm p-5 space-x-1 items-center transition-all text-red-400 stroke-red-400 ease-in-out\" remove-me=\"1s\">
        <svg xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"0 0 24 24\" stroke-width=\"1.5\" stroke=\"currentColor\" class=\"w-6 h-6\">
            <path stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0\" /></svg>
        <span class=\"flex grow font-sans\">Item removed...</span>
    </div>";

    exit();
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    http_response_code(400);
    die();
}
