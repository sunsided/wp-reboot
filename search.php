<?php

  $GLOBALS["page_classes"] = 'search';

  get_header();

  $dwooParams['searchterms'] = get_search_query();

  ?>
	<div id="searchresult_header" class="searchresult_header">
		<h2 class="searchresult_header">Ergebnisse der Blog-Suche</h2>
		<p>Du hast den Blog nach dem Inhalt <q>{$searchterms}</q> durchsucht. Hier ist, was sich finden ließ.</p>
	</div>
	<div class="separate"></div>

<?php
    
  include(TEMPLATEPATH.'/theloop.php');

  get_footer();
