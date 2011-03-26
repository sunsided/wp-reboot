<?php

function Dwoo_Plugin_insert_sidebar_compile(Dwoo_Compiler $compiler, $name)
{
    return '""; dynamic_sidebar('.$name.')';
}
