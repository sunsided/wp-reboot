<?php

function Dwoo_Plugin_language_attributes_compile(Dwoo_Compiler $compiler)
{
    ob_start();
    language_attributes();
    $attrs = ob_get_contents();
    ob_end_clean();

    return "sprintf('".$attrs."')";
}
