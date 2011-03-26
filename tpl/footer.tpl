    </div>

    <a id="bottom" name="bottom"></a>
    {if $pagination}
      <div class="separate lighter"></div>
      <div class="pagination" role="navigation">
            {$pagination}
      </div>
    {/if}

    <div class="separate"></div>

    <div id="footer">

        <div id="footer-head"></div>
        <div id="footer-left" class="sidebar">

            <ul class="sidebar">
            {insert_sidebar 'footer_left'}
            </ul>

        </div><div id="footer-right" class="sidebar">
            <ul class="sidebar">
            <li>
            <h2 class="widgettitle" style="">Blog durchsuchen</h2>
            {include 'searchform.tpl'}
            </li>
            {insert_sidebar 'footer_right'}
            </ul>
        </div>

        <div class="separate lighter flowbreaker"></div>
        <small>(Serviert in <?php timer_stop(1); ?> Sekunden)</small>
        <p>Zurück nach <a href="#top">oben</a>.</p>
    </div>
  </div>

  {wp_footer}

</body>
</html>