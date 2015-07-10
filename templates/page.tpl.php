<?php
//kpr(get_defined_vars());
//kpr($theme_hook_suggestions);
//template naming
//page--[CONTENT TYPE].tpl.php
?>
<?php if( theme_get_setting('mothership_poorthemers_helper') ){ ?>
<!--page.tpl.php-->
<?php } ?>

<?php print $mothership_poorthemers_helper; ?>
<?php
  $extraclass = '';
  if (!$logo) { $extraclass = 'without-logo'; }
?>


<?php if($page['top_header']): ?>
<div class="top-region-container clearfix">
  <div class="top-header-region row <?php print $extraclass; ?>">
    <?php print render($page['top_header']); ?>
  </div>
</div>
<?php endif; ?>

<div class="header-container <?php print $extraclass; ?>">
  <header role="banner" class="row">
    <div class="inner-wrapper">
        <div class="siteinfo">
        <?php if ($logo): ?>
          <figure>
          <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home">
            <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
          </a>
          </figure>
        <?php elseif($site_name OR $site_slogan ): ?>
        <hgroup>
          <?php if($site_name): ?>
            <h1>
              <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home">
                <?php print $site_name; ?>
              </a>
            </h1>
          <?php endif; ?>
          <?php if ($site_slogan): ?>
            <h2><?php print $site_slogan; ?></h2>
          <?php endif; ?>
        </hgroup>
        <?php endif; ?>
      </div>

      <?php if($page['header']): ?>
        <a href="#" id="mobile-link" style="display: none"><span></span></a>
        <div class="header-region">
          <?php print render($page['header']); ?>
        </div>
      <?php endif; ?>
    </div>
  </header>
</div>

<div class="page-container">
  <?php print $breadcrumb; ?>
  <div class="page row clearfix">
    <div class="inner-wrapper">

      <div role="main" id="main-content" class="col">
        <?php print render($page['content_top']); ?>
        <?php print render($title_prefix); ?>
        <?php if ($title): ?>
          <h1><?php print $title; ?></h1>
        <?php endif; ?>
        <?php print render($title_suffix); ?>

        <?php if ($action_links): ?>
          <ul class="action-links"><?php print render($action_links); ?></ul>
        <?php endif; ?>

        <?php if (isset($tabs['#primary'][0]) || isset($tabs['#secondary'][0])): ?>
          <nav class="tabs"><?php print render($tabs); ?></nav>
        <?php endif; ?>

        <?php if($page['highlighted'] OR $messages){ ?>
          <div class="drupal-messages">
          <?php print render($page['highlighted']); ?>
          <?php print $messages; ?>
          </div>
        <?php } ?>

        <?php print render($page['content_pre']); ?>
        <?php print render($page['content']); ?>
        <?php print render($page['content_post']); ?>

      </div><!--/main-->
      <?php if ($page['sidebar_first']): ?>

          <div class="sidebar-first col">
            <?php print render($page['sidebar_first']); ?>
          </div>

      <?php endif; ?>

      <?php if ($page['sidebar_second']): ?>

        <div class="sidebar-second col">
          <?php print render($page['sidebar_second']); ?>
        </div>

      <?php endif; ?>
    </div>
  </div><!--/page-->
</div>

<?php if (isset($page['footer']) OR isset($page['footer_top'])): ?>
<div class="footer-container">
  <footer role="contentinfo" class="row">
    <?php if (isset($page['footer_top'])): ?>
    <div class="footer-top"><?php print render($page['footer_top']); ?></div>
    <?php endif ?>
    <?php if (isset($page['footer'])): ?>
    <div class="footer">
      <?php print render($page['footer']); ?>
    </div>
    <?php endif ?>
  </footer>
</div>
<?php endif ?>
