<?php

$content = $_GET['content'];
$item_id = $_GET['item_id'];
if ($content == "" || $item_id == "") {
    echo "Invalid content or item_id";
    http_response_code(400);
    exit();
}

echo "
<form hx-post=\"/api/updateTodo.php?item_id=" . $item_id . "\" hx-swap=\"outerHTML\" class=\"flex w-full bg-neutral-800 rounded-lg shadow-sm space-x-1 items-center transition-all ease-in-out\" hx-target=\"#item-" . $item_id . "\">
    <svg xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"0 0 24 24\" stroke-width=\"1.5\" stroke=\"currentColor\" class=\"w-6 h-6\">
        <path stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10\" />
    </svg>
    <input name=\"content\" id=\"content\" type=\"text\" class=\"text-white placeholder:text-slate-500 outline-none border-none active:outline-none active:border-none rounded-sm w-full bg-transparent\"  value=\"" . $content . "\">
</form>";
