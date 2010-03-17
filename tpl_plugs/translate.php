<?php

function Dwoo_Plugin_translate_compile(Dwoo_Compiler $compiler, $value)
{
    return '__('.$value.', "reboot")';
}
