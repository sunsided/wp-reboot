<?php

  $GLOBALS["page_classes"] = 'datearchive';

  get_header();

  if (is_year ()) {
    $dwooParams['archive']['searchterm'] = get_the_date(__('Y'));
  }
  elseif (is_month()) {
      $dwooParams['archive']['searchterm'] = get_the_date(__('F Y'));
  }
  elseif (is_day()) {
      $dwooParams['archive']['searchterm'] = get_the_date(__('j. F  Y'));
  }
  elseif (is_time()) {
      $dwooParams['archive']['searchterm'] = get_the_time(__('j. F Y, H:i \U\h\r'));
  }

  $dwooParams['archive']['is_year'] = is_year();
  $dwooParams['archive']['is_month'] = is_month();
  $dwooParams['archive']['is_day'] = is_day();
  $dwooParams['archive']['is_time'] = is_time();

  $dwoo->output(TPL_PATH.'/date.tpl', $dwooParams);
  include(TEMPLATEPATH.'/theloop.php');

  get_footer();
