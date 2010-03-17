<?php

function Dwoo_Plugin_post_class_compile(Dwoo_Compiler $compiler, $value = '')
{
    return 'post_class('.$value.')';
}
