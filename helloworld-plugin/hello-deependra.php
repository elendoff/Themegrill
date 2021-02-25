<?php
/*
 * Plugin Name: Hello Deependra
 * Plugin URI: https://demowordpress/plugins/hello-world
 * Description: Simple HelloWorld Plugin Example .
 * Version: 1.0.0
 * Author: Deependra
 * Author URI: https://deepench.com
 * Text Domain: hello-Deependra
*/

function addMenu()
{
    add_menu_page(
        'Hello World',
        'Hello World',
        'manage_options',
        'Hello World',
        'HelloExample',
        '25'
    );
}
add_action("admin_menu", "addMenu");
function HelloExample()
{
    echo "<h1>Hello WOrld</h1>";
}
