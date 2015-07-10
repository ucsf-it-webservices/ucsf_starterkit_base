<!doctype html>
<!--[if IE 7]>
  <html class="no-js ie7 oldie"<?php print $html_attributes; ?>>
<![endif]-->
<!--[if IEMobile 7]>
  <html<?php print $html_attributes; ?> class="no-js iem7">
<![endif]-->
<!--[if (gt IEMobile 7)|!(IEMobile)]>
  <html class="no-js" lang="en">
<![endif]-->
<!--[if lt IE 7]>
  <html class="no-js ie6 oldie" <?php print $html_attributes; ?>>
<![endif]-->
<!--[if (IE 7)&!(IEMobile)]>
  <html class="no-js ie7 oldie" <?php print $html_attributes; ?>>
<![endif]-->
<!--[if (IE 8)&!(IEMobile)]>
  <html class="no-js oldie" <?php print $html_attributes; ?>>
<![endif]-->
<!--[if gt IE 8]>
  <html class="no-js" <?php print $html_attributes; ?>>
<![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)]><html class="no-js"<?php print $rdf_namespaces; ?>><![endif]-->
  <!--[if gte IE 6]>
  <script type = "text/javascript">
    var ieClass="";
    if(document.documentMode==7)
      {
        ieClass="ie7";
      }
    else if(document.documentMode==8)
      {
        ieClass="ie8";
      }
    else if(document.documentMode==9)
      {
        ieClass="ie9";
      }

      document.documentElement.className += " ";
      document.documentElement.className += ieClass;
  </script>
<![endif]-->
<?php print $mothership_poorthemers_helper; ?>
<head>
<title><?php print $head_title; ?></title>
<?php print $head; ?>
<?php if(theme_get_setting('mothership_mobile')){  ?>
<meta name="MobileOptimized" content="width">
<meta name="HandheldFriendly" content="true"><?php } ?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
<meta http-equiv="cleartype" content="on">
<meta http-equiv="X-UA-Compatible" content="IE=8,chrome=1">
<?php print $styles; ?>
<?php if(theme_get_setting('mothership_respondjs')) { ?>
<!--[if lt IE 9]>
  <script src="<?php print $mothership_path; ?>/js/respond.min.js"></script>
<![endif]-->
<?php } ?>
<!--[if lt IE 9]>
  <script src="<?php print $mothership_path; ?>/js/html5.js"></script>
<![endif]-->
<?php print $selectivizr; ?>
<?php
  if(!theme_get_setting('mothership_script_place_footer')) {
    print $scripts;
  }
?>
</head>
<body class="<?php print $classes; ?>" id="hold" <?php print $attributes;?>>

<!--[if lt IE 7]><p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p><![endif]-->
<a href="#main-content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?> </a>
<?php print $page_top; //stuff from modules always render first ?>
<?php print $page; // uses the page.tpl ?>
<?php
  if(theme_get_setting('mothership_script_place_footer')) {
    print $scripts;
  }
?>
<?php print $page_bottom; //stuff from modules always render last ?>
</body>
</html>

