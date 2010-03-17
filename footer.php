<?php

  global $dwoo;

  // Suchformular
  $search = array();
  $search["title"] = __("Suchen...", "reboot");
  $search["text"] = __("Blog durchsuchen...", "reboot");

  // Footer anzeigen
  $params = array();
  $params["search"] = $search;
  $dwoo->output(TPL_PATH.'/footer.tpl', $params);
