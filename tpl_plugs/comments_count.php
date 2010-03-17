<?php

/**
 * Lädt die comments.php
 */
function Dwoo_Plugin_comments_count_compile(Dwoo_Compiler $compiler)
{
    return 'reboot_comments_count_text()';
}
