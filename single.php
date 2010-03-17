<?php

  get_header();

  $dwooParams['is_single'] = TRUE;
  include(TEMPLATEPATH.'/theloop.php');

  /*get_sidebar();*/

  get_footer();
