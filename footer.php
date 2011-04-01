<?php

  global $dwoo, $dwooParams;

  // Suchformular
  $search = array();
  $search["title"] = __("Suchen...", "reboot");
  $search["text"] = __("Blog durchsuchen...", "reboot");

  // Footer anzeigen
  $GLOBALS["search"] = $search;

  // Pagination!
  if(function_exists('PaginationFu'))
  {
     $pagination = get_PaginationFu();
     $GLOBALS['has_pagination'] = $pagination !== FALSE;
     $GLOBALS['pagination'] = $pagination;
  }

?>
    </div>

    <a id="bottom" name="bottom"></a>
    <?php if(!empty($GLOBALS['has_pagination'])): ?>
      <div class="separate lighter"></div>
      <div class="pagination" role="navigation">
            <?php echo $GLOBALS['pagination']; ?>
      </div>
    <?php endif; ?>

    <div class="separate"></div>

    <div id="footer">

        <div id="footer-head"></div>
        <div id="footer-left" class="sidebar">

            <ul class="sidebar">
			<?php dynamic_sidebar('footer_left') ?>
            </ul>
        </div>
	<div id="footer-center" class="sidebar">
		<ul class="sidebar">
		<?php dynamic_sidebar('footer_center'); ?>
		</ul>
	</div>
	<div id="footer-right" class="sidebar">
            <ul class="sidebar">
            <li>
            <h2 class="widgettitle" style="">Blog durchsuchen</h2>
            <?php get_search_form();?>
            </li>
			<?php dynamic_sidebar('footer_right') ?>
            </ul>
        </div>

        <div class="separate lighter flowbreaker"></div>
        <small>(Generiert in <?php timer_stop(1); ?> Sekunden)</small>
        <p>Zurück nach <a href="#top">oben</a>.</p>
    </div>
  </div>

  <?php wp_footer(); ?>

</body>
</html>
