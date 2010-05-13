<body {language_attributes}>

  <a id="top" name="top"></a>
  <div id="page"{if $page_classes} class="{$page_classes}"{/if}>

    <div id="header" role="banner">
        <div class="title"><a href="{option 'home'}/" rel="home"><h1>{bloginfo 'name'}</h1></a></div>
        <div class="description">{bloginfo 'description'}</div>

        <div id="mainnavigation" class="menubar" role="navigation">
          <a class="mainnavlink{if $current_subdomain == 'blog'} currenttopic{/if}" id="navtopersonal" href="{$urltopersonal}"><div>Persönliches</div></a>
          <a class="mainnavlink{if $current_subdomain == 'photo'} currenttopic{/if}" id="navtophoto" href="{$urltophoto}"><div>Fotografie</div></a>
          <a class="mainnavlink{if $current_subdomain == 'dev'} currenttopic{/if}" id="navtocode" href="{$urltocode}"><div>Programmierung</div></a>
        </div>
    </div>

    <div class="separate"></div>

  	<div id="content" class="narrowcolumn" role="main">
