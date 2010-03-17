<?php

function Dwoo_Plugin_next_posts_link_compile(Dwoo_Compiler $compiler, $value)
{
    return '""; next_posts_link(__('.$value.', "reboot"))';
}
