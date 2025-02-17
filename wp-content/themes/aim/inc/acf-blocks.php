<?php

add_action("acf/init", "register_acf_blocks");

function register_acf_blocks()
{
    if (function_exists("acf_register_block_type")) {
        // Get blocks from blocks directory
        $blocks_dir = get_template_directory() . '/blocks';
        $blocks = array_filter(scandir($blocks_dir), function ($item) use ($blocks_dir) {
            return is_dir($blocks_dir . '/' . $item) && !in_array($item, ['.', '..']);
        });

        foreach ($blocks as $block) {
            if (file_exists(get_template_directory() . "/blocks/{$block}/register.php")) {
                require_once get_template_directory() . "/blocks/{$block}/register.php";
            }
        }
    }
}
