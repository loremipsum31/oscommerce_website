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

  <link type="text/css" rel="stylesheet" href="public/external/jquery/ui/themes/Aristo/Aristo.css" />
  <script type="text/javascript" src="public/external/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>

  <link type="text/css" rel="stylesheet" href="public/external/flexslider/flexslider.css" rel="stylesheet" />
  <script type="text/javascript" src="public/external/flexslider/jquery.flexslider-min.js"></script>

  <script type="text/javascript" src="{publiclink}javascript/jquery/jquery.equalResize.js|Admin{publiclink}"></script>

  <link rel="stylesheet" type="text/less" media="screen" href="{publiclink}templates/default/stylesheets/less/general.less{publiclink}" />
  <script type="text/javascript" src="public/external/less/less-1.2.1.min.js"></script>
</head>

<body>

<div id="wrapper">

<header>
  <div id="logo">
    <a href="{link}Index{link}"><img src="{publiclink}images/oscommerce.png{publiclink}" /></a>
  </div>

  <div id="nav">
    <button id="nbUs">{lang}navbutton_us{lang}</button><button id="nbProducts">{lang}navbutton_products{lang}</button><button id="nbServices">{lang}navbutton_services{lang}</button><button id="nbCommunity">{lang}navbutton_community{lang}</button><button id="nbPlaceholder">?</button>
  </div>
</header>

<script>
$('#nav').buttonset();
$('#nbUs').button({ icons: { primary: 'ui-icon-person' } }).click( function() { document.location.href = '{link}Us{link}'; } );
$('#nbProducts').button({ icons: { primary: 'ui-icon-radio-on' } }).click( function() { document.location.href = '{link}Products{link}'; } );
$('#nbServices').button({ icons: { primary: 'ui-icon-check' } }).click( function() { document.location.href = '{link}Services{link}'; } );
$('#nbCommunity').button({ icons: { primary: 'ui-icon-comment' } }).click( function() { document.location.href = '{link}Community{link}'; } );
$('#nbPlaceholder').button().click( function() { document.location.href = '{link}Index{link}'; } );
</script>

{import}{value}html_page_contents_file{value}{import}

<footer>
  {lang}copyright_footer{lang}
</footer>

</div>

</body>

</html>

<?php
  $content = ob_get_clean();

  echo $OSCOM_Template->parseContent($content);
?>
