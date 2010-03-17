<?php

function Dwoo_Plugin_logout_url_compile(Dwoo_Compiler $compiler)
{
    return 'wp_logout_url(get_permalink())';
}
