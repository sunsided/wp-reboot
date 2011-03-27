<?php

  $GLOBALS["page_classes"] = 'datearchive';

  get_header();

  if (is_year ()) {
    $searchterm = get_the_date(__('Y'));
  }
  elseif (is_month()) {
      $searchterm = get_the_date(__('F Y'));
  }
  elseif (is_day()) {
      $searchterm = get_the_date(__('j. F  Y'));
  }
  elseif (is_time()) {
      $searchterm = get_the_time(__('j. F Y, H:i \U\h\r'));
  }

?>
  
<div id="searchresult_header" class="searchresult_header">
<h2 class="searchresult_header">Ergebnisse der 
    <?php if(is_year()): ?>Jahres-<?php elseif(is_month()): ?>Monats-<?php elseif(is_day()): ?>Tages-<?php elseif(is_time()): ?>Zeit-<?php endif; ?>Archivsuche</h2>
<p><?php if(is_year()): ?>
    Du hast den Blog nach dem Jahr <strong>{$archive.searchterm}</strong> durchsucht.
    <?php elseif(is_month()): ?>
    Du hast den Blog nach dem Monat <strong>{$archive.searchterm}</strong> durchsucht.
    <?php elseif(is_day()): ?>
    Du hast den Blog nach dem <strong>{$archive.searchterm}</strong> durchsucht.
    <?php elseif(is_time()): ?>
    Du hast den Blog nach der Uhrzeit <strong>{$archive.searchterm}</strong> durchsucht.
    Respekt dafür.
    <?php endif; ?>
    Hier ist, was sich finden ließ.</p>
</div>
<div class="separate"></div>
  
  <?php
  
  include(TEMPLATEPATH.'/theloop.php');

  get_footer();
