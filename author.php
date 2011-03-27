<?php

  $GLOBALS["page_classes"] = 'authorarchive';

  get_header();


  if(isset($_GET['author_name'])) :
    $curauth = get_user_by('slug', $author_name);
  else :
    $curauth = get_userdata(intval($author));
  endif;

  $dwooParams['archive']['searchterm'] = $curauth->display_name;

  $dwoo->output(TPL_PATH.'/author.tpl', $dwooParams);
  include(TEMPLATEPATH.'/theloop.php');

  get_footer();
