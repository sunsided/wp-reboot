<body {language_attributes}>

  <a id="top" name="top"></a>
  <div id="page"{if $page_classes} class="{$page_classes}"{/if}>

    <div id="header" role="banner">
        <div class="transparency"></div>
        <div class="title"><a href="{option 'home'}/" rel="home"><h1>{bloginfo 'name'}</h1></a></div>
        <div class="description">{bloginfo 'description'}</div>

        <div id="mainnavigation" class="menubar" role="navigation">
          <a class="mainnavlink{if $current_subdomain == 'blog'} currenttopic{/if}" id="navtopersonal" rel="me bookmark" href="{$urltopersonal}" title="{$titleforpersonal}"><div>Persönliches</div></a>
          <a class="mainnavlink{if $current_subdomain == 'photo'} currenttopic{/if}" id="navtophoto" rel="me bookmark" href="{$urltophoto}" title="{$titleforphoto}"><div>Fotografie</div></a>
          <a class="mainnavlink{if $current_subdomain == 'dev'} currenttopic{/if}" id="navtocode" rel="me bookmark" href="{$urltocode}" title="{$titleforcode}"><div>Programmierung</div></a>
        </div>
    </div>

    <div class="separate"></div>

        <div id="header-sidebar" class="sidebar"><ul class="sidebar">{insert_sidebar 'header'}</ul></div>
  	<div id="content" class="narrowcolumn" role="main">
