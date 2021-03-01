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
function when_my_plugin_activate()
{
    if (get_option('plugin_status') != 'active') {
        echo '<div class="notice-success notice is-dismissible"><p>Hello World</p></div>';
        update_option('plugin_status', 'active');
    }
}
add_action('admin_notices', 'when_my_plugin_activate');

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
