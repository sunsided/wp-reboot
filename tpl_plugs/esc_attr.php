<?php

function Dwoo_Plugin_esc_attr_compile(Dwoo_Compiler $compiler, $value)
{
    return 'esc_attr('.$value.')';
}
