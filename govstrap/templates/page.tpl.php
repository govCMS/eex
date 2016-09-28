<?php
/**
 * @file
 * page.tpl.php - Returns the HTML for a single Drupal page.
 */
?>
<header id="header" class="header <?php print $container_class; ?>" role="banner">
  <?php print render($page['header']); ?>
  <div class="container">
    <div class="row">
      <div class="col-md-9" id="logo">
        <a href="/"><img src="<?php print '/'.drupal_get_path('theme', 'govstrap').'/img/coas.svg';?>" height="64" alt="EEX Home" /></a>
      </div>
      <div class="col-md-3 text-right" id="search">
        <?php print $search_box; ?>
      </div>
    </div>
  </div>
</header><!-- /#page-header -->

<nav id="navigation" class="<?php print $container_class; ?>">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <?php print render($page['navigation']); ?>
      </div>
    </div>
  </div>

</nav><!-- /#navigation -->

<main>
  <div id="main" class="main-container <?php print $container_class; ?>">
    <?php if (!empty($page['highlighted'])): ?>
      <div class="highlighted jumbotron"><?php print render($page['highlighted']); ?></div>
    <?php endif; ?>
    <?php print $messages; ?>
    <div id="content" class="row">
      <?php if (!empty($page['sidebar_first'])): ?>
        <aside class="col-sm-3" role="complementary">
          <?php print render($page['sidebar_first']); ?>
        </aside>  <!-- /#sidebar-first -->
      <?php endif; ?>
      <section id="main-content-section" class="<?php print $content_column_class; ?>" role="main">
        <a id="main-content"></a>
        <?php if (!empty($breadcrumb)): print $breadcrumb; endif;?>
        <?php print render($title_prefix); ?>
        <?php if (!empty($title)): ?>
          <h1 class="page-header"><?php print $title; ?></h1>
        <?php endif; ?>
        <?php print render($title_suffix); ?>
        <?php if (!empty($tabs)): ?>
          <?php print render($tabs); ?>
        <?php endif; ?>
        <?php if (!empty($page['help'])): ?>
          <?php print render($page['help']); ?>
        <?php endif; ?>
        <?php if (!empty($action_links)): ?>
          <ul class="action-links"><?php print render($action_links); ?></ul>
        <?php endif; ?>
        <div id="page-content">
          <?php print render($page['content']); ?>
        </div>
      </section>
      <?php if (!empty($page['sidebar_second'])): ?>
        <aside class="col-sm-3" role="complementary">
          <?php print render($page['sidebar_second']); ?>
        </aside>  <!-- /#sidebar-second -->
      <?php endif; ?>

      <?php if (!empty($page['footer_menu'])): ?>
        <div id="footer-menu" class="col-md-12 <?php print $container_class; ?>">
          <?php print render($page['footer_menu']); ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</main>

<?php if (!empty($page['footer'])): ?>
  <footer id="footer" class="footer <?php print $container_class; ?>">
    <?php print render($page['footer']); ?>
  </footer>
<?php endif; ?>
