<?php

function Dwoo_Plugin_wp_footer_compile(Dwoo_Compiler $compiler)
{
    return '""; wp_footer()';
}
