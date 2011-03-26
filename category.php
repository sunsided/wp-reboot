<?php

  $dwooParams['page_classes'] = 'categoryarchive';

  get_header();

  $dwooParams['archive']['searchterm'] = single_cat_title("", FALSE);

  $dwoo->output(TPL_PATH.'/category.tpl', $dwooParams);
  include(TEMPLATEPATH.'/theloop.php');

  get_footer();
