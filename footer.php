<?php

  global $dwoo, $dwooParams;

  // Suchformular
  $search = array();
  $search["title"] = __("Suchen...", "reboot");
  $search["text"] = __("Blog durchsuchen...", "reboot");

  // Footer anzeigen
  $params = $dwooParams;
  $params["search"] = $search;

  // Pagination!
  if(function_exists('PaginationFu'))
  {
     $pagination = get_PaginationFu();
     $params['has_pagination'] = $pagination !== FALSE;
     $params['pagination'] = $pagination;
  }

  $dwoo->output(TPL_PATH.'/footer.tpl', $params);
