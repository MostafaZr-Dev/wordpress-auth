<?php

$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'general_options';
$tabs = [
    "general_options" => "عمومی",
    "login_options" => "ورود",
    "register_options" => "ثبت نام"
];

echo "<h2 class='nav-tab-wrapper'>";
foreach ($tabs as $tab => $name){
    $class = ($tab == $active_tab)? ' nav-tab-active' : '';
    echo "<a class='nav-tab{$class}' href='?page=wp_auth&tab={$tab}'>{$name}</a>";
}
echo "</h2>";
