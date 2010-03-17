<?php

function Dwoo_Plugin_option_compile(Dwoo_Compiler $compiler, $value)
{
    return 'get_option('.$value.')';
}
