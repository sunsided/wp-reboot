    </div>

    {if $pagination}
      <div class="separate lighter"></div>
      <div class="pagination" role="navigation">
            {$pagination}
      </div>
    {/if}

    <div class="separate"></div>

    <div id="footer">

      Zurück nach <a href="#top">oben</a>.
      {include 'searchform.tpl'}

    </div>
  </div>

  {wp_footer}

</body>
</html>