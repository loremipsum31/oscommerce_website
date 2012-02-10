<?php
/**
 * osCommerce Website
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

// for index.php HPDL
/*
  use osCommerce\OM\Core\Registry;
  echo Registry::get('Template')->getContent();
*/

  ob_start();
?>

<!doctype html>

<html dir="{value}html_text_direction{value}" lang="{value}html_lang{value}">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset={value}html_character_set{value}" />

  <title>{value}html_page_title{value}</title>

  <link rel="icon" type="image/png" href="{publiclink}images/favicon.ico{publiclink}" />

  <meta name="generator" value="osCommerce Online Merchant" />
  <meta name="robots" content="noindex,nofollow" />

  <script type="text/javascript" src="public/external/jquery/jquery-1.7.1.min.js"></script>

<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
  <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

  <script type="text/javascript" src="public/external/bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="{publiclink}templates/default/stylesheets/general.css{publiclink}" />
</head>

<body>

<div class="container">

<header class="row">
  <div id="logo" class="span4">
    <a href="{link}Index{link}"><img src="{publiclink}images/oscommerce.png{publiclink}" /></a>
  </div>

  <div id="nav" class="span8">
    <div class="btn-group">
      <a href="{link}Index{link}" class="btn" id="btnHome"><i class="icon-home"></i></a>
      <a href="{link}Us{link}" class="btn" id="btnUs"><i class="icon-user"></i>{lang}navbutton_us{lang}</a>
      <a href="{link}Products{link}" class="btn" id="btnProducts"><i class="icon-download"></i>{lang}navbutton_products{lang}</a>
      <a href="{link}Services{link}" class="btn" id="btnServices"><i class="icon-cog"></i>{lang}navbutton_services{lang}</a>
      <a href="{link}Community{link}" class="btn" id="btnCommunity"><i class="icon-comment"></i>{lang}navbutton_community{lang}</a>
    </div>
  </div>
</header>

<script>
$(function() {
  if ( '{value}current_site_application{value}' == 'Index' ) {
    $('#btnHome').remove();
  } else {
    $('#btn{value}current_site_application{value}').addClass('btn-success');
    $('#btn{value}current_site_application{value} i').addClass('icon-white');
  }
});
</script>

{import}{value}html_page_contents_file{value}{import}

<footer class="row">
  <div class="span12">
    {lang}copyright_footer{lang}
  </div>
</footer>

</div>

</body>

</html>

<?php
  $content = ob_get_clean();

  echo $OSCOM_Template->parseContent($content);
?>
