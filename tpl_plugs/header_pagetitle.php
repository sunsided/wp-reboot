<?php

function Dwoo_Plugin_header_pagetitle_compile(Dwoo_Compiler $compiler)
{
    return '""; wp_title("&laquo; ", true, "right")';
}
