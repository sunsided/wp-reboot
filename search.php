<?php

  $GLOBALS["page_classes"] = 'search';

  get_header();

  $dwooParams['searchterms'] = get_search_query();

  $dwoo->output(TPL_PATH.'/search.tpl', $dwooParams);
  include(TEMPLATEPATH.'/theloop.php');

  get_footer();
