<?php

  $GLOBALS["page_classes"] = 'tagarchive';

  get_header();

  $searchterm = single_tag_title("", FALSE);

  ?>
  
<div id="searchresult_header" class="searchresult_header">
<h2 class="searchresult_header">Schlüsselwortarchiv</h2>
<p>Du betrachtest das Archiv des Tags <strong><?php echo $searchterm; ?></strong>.</p>
</div>
<div class="separate"></div>
  
  <?php
    
  include(TEMPLATEPATH.'/theloop.php');

  get_footer();
