<?php

function Dwoo_Plugin_edit_post_link_compile(Dwoo_Compiler $compiler, $value, $prepend, $append, $id)
{
    return '""; edit_post_link(__('.$value.', "reboot"), '.$prepend.', '.$append.', '.$id.')';
}
