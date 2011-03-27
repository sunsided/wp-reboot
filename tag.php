<?php

  $GLOBALS["page_classes"] = 'tagarchive';

  get_header();

  $dwooParams['archive']['searchterm'] = single_tag_title("", FALSE);

  $dwoo->output(TPL_PATH.'/tag.tpl', $dwooParams);
  include(TEMPLATEPATH.'/theloop.php');

  get_footer();
