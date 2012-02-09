<?php
  ob_start();
?>

<!doctype html>

<html dir="{value}html_text_direction{value}" lang="{value}html_lang{value}">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset={value}html_character_set{value}" />

  <title>{value}html_page_title{value}</title>

  <link rel="icon" type="image/png" href="{publiclink}images/favicon.ico{publiclink}" />

  <meta name="generator" value="osCommerce Online Merchant" />

  <script type="text/javascript" src="public/external/jquery/jquery-1.7.1.min.js"></script>

<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
  <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

  <script type="text/javascript" src="public/external/bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="public/external/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="public/external/bootstrap/css/bootstrap-responsive.min.css" />

  <link rel="stylesheet" type="text/css" href="{publiclink}templates/default/stylesheets/general.css{publiclink}" />
</head>

<body>

<div class="container">
  {import}{value}html_page_contents_file{value}{import}

  <footer class="row">
    <div class="span12">
      <hr />

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
