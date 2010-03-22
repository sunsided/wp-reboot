<?php

  $dwooParams['page_classes'] = 'single';
  $dwooParams['is_single'] = TRUE;

  get_header();

  include(TEMPLATEPATH.'/theloop.php');

  /*get_sidebar();*/

  get_footer();
