<?php

  $dwooParams['page_classes'] = 'fourohfour';

  get_header();

  $dwoo->output(TPL_PATH.'/nothing_found.tpl', $dwooParams);

  /*get_sidebar();*/

  get_footer();
