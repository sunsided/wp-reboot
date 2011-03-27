<?php

  $GLOBALS["page_classes"] = 'categoryarchive';

  get_header();

  $searchterm = single_cat_title("", FALSE);

  
?>

<div id="searchresult_header" class="searchresult_header">
<h2 class="searchresult_header">Kategoriearchiv</h2>
<p>Du betrachtest das Archiv der Kategorie <strong><?php echo $searchterm; ?></strong>.</p>
</div>
<div class="separate"></div>

<?php  
  
  include(TEMPLATEPATH.'/theloop.php');

  get_footer();
