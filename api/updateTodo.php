<?php
$user = "example_user";
$password = "password";
$database = "example_database";
$table = "todo_list";

try {
    $item_id = $_GET['item_id'];
    $content = $_POST['content'];
    if ($item_id == "" || $content == "") {
        echo "Invalid content";
        http_response_code(400);
        exit();
    }

    $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $sql = "UPDATE $database.$table SET content='" . $content . "' WHERE item_id=$item_id ";
    $db->prepare($sql);
    $db->query($sql);
    http_response_code(200);
    header("HX-Refresh: false");
    echo "
        <div class=\"flex w-full bg-neutral-800 rounded-lg shadow-sm p-5 space-x-1 hover:scale-[1.01] items-center transition-all ease-in-out\" id=\"item-" . $item_id . "\" key=\"item-" . $item_id . "\">
            <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-6 w-6 shrink-0 hover:stroke-[#a3e635]\" fill=\"none\" viewBox=\"0 0 24 24\" stroke-width=\"1.5\" stroke=\"#d9f99d\" class=\"w-6 h-6\">
                <path stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z\" />
            </svg>

            <span class=\"flex grow px-1 font-sans\">" . $content . "</span>
            
            <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-6 w-6 shrink-0 hover:stroke-[#fde047] cursor-pointer\" fill=\"none\" viewBox=\"0 0 24 24\" stroke-width=\"1.5\" stroke=\"#fef08a\" class=\"w-6 h-6\" hx-get=\"/api/getUpdateTodo.php?item_id=" . $item_id . "&content=" . $content . "\" hx-target=\"#item-" . $item_id . "\" hx-swap=\"innerHTML\">
                <path stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10\" />
            </svg>

            <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-6 w-6 shrink-0 hover:stroke-[#ef4444] cursor-pointer\" fill=\"none\" viewBox=\"0 0 24 24\" stroke-width=\"1.5\" stroke=\"#f87171\" class=\"w-6 h-6\" hx-delete=\"/api/removeTodo.php?item_id=" . $item_id . "\" hx-target=\"#item-" . $item_id . "\" hx-swap=\"outerHTML\">
                <path stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z\" />
            </svg>
        </div>";

    exit();
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    http_response_code(400);
    die();
}
