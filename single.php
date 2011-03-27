<?php

  $GLOBALS["page_classes"] = 'single';
  $GLOBALS["is_single"] = TRUE;

  get_header();

  include(TEMPLATEPATH.'/theloop.php');

  /*get_sidebar();*/

  get_footer();
