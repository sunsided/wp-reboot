<?php

function Dwoo_Plugin_bloginfo_compile(Dwoo_Compiler $compiler, $value)
{
    return 'get_bloginfo('.$value.')';
}
