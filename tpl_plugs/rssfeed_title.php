<?php

function Dwoo_Plugin_rssfeed_title_compile(Dwoo_Compiler $compiler, $value)
{
    return "esc_attr(sprintf(__(".$value.", 'reboot'), get_bloginfo('name')))";
}
