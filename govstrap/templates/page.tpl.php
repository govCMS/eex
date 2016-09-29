<?php
/**
 * @file
 * page.tpl.php - Returns the HTML for a single Drupal page.
 */
?>
<header id="header" class="header <?php print $container_class; ?>" role="banner">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <a href="#content" class="skip-top">Skip to content</a>
      </div>
      <div class="col-md-6 text-right" id="top-header-menu">
        <?php print render($page['header']); ?>
      </div>
      <div class="col-md-9" id="logo">
        <a href="/"><img src="<?php print '/'.drupal_get_path('theme', 'govstrap').'/img/logo-trans.png';?>" alt="eex.gov.au Energy Efficiency Exchange" /></a>
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

<main class="container">
  <?php if (!empty($page['highlighted'])): ?>
      <div class="row">
        <div class="col-md-12 col-no-padding">
          <div class="highlighted jumbotron"><?php print render($page['highlighted']); ?></div>
        </div>
      </div>
  <?php endif; ?>
  <div id="main" class="main-container row">
    <?php print $messages; ?>
    <div id="content">
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
    </div>
  </div>
</main>

<?php if (!empty($page['footer_menu'])): ?>
    <div id="footer-menu" class="container">
      <div class="row">
        <div class="col-md-9">
          <?php print render($page['footer_menu']); ?>
        </div>
        <div class="col-md-3">
          <div class="print-friendly">This site is print friendly</div>
        </div>
      </div>
    </div>
<?php endif; ?>

<?php if (!empty($page['footer'])): ?>
  <footer id="footer" class="footer <?php print $container_class; ?>">
    <?php print render($page['footer']); ?>
  </footer>
<?php endif; ?>
