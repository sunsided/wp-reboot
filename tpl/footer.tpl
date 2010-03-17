    </div>

    <div class="separate lighter"></div>

      <div class="pagination" role="navigation">

            <!--
  			<div class="prevlink">{next_posts_link '&laquo; &Auml;ltere Beitr&auml;ge'}</div>
  			<div class="nextlink">{previous_posts_link 'Neuere Eintr&auml;ge &raquo;'}</div>
            -->

            <?php if(function_exists('wp_paginate')) {
                wp_paginate();
            } ?>

      </div>

    <div class="separate"></div>

    <div id="footer">

      Zurück nach <a href="#top">oben</a>.
      {include(file='searchform.tpl')}

    </div>
  </div>

  {wp_footer}

</body>
</html>