<div class="searchform" role="search">
  <label for="searchbox">{translate 'Suche:'}</label>
  <form id="searchform" method="get" action="{bloginfo 'home'}/">
    <div>
        <input
          title="{$search.title}"
          type="text" name="s" id="searchbox" size="20" value="{$search.text}"
          onblur="if (this.value == '') { this.value = '{$search.text}';}"
          onfocus="if (this.value == '{$search.text}'){ this.value = '';}"
       />
       <input type="hidden" id="searchsubmit" />
       <!-- <input type="submit" value="Search" /> -->
    </div>
  </form>
</div>