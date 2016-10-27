
<div class="page-template-home-1" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
  <?php if ($content['top']): ?>
    <div class="row">
      <!-- Placeholder for hero image start -->
      <div id="banner-primary" class="banner">
        <div class="wrap"
             style="background-image: url(https://eex.govspace.gov.au/files/2016/05/EEX-HOMEPAGE-MAY-2016-2-990x311.jpg);
             cursor: pointer;
             -webkit-background-size: cover;
              -moz-background-size: cover;
              -o-background-size: cover;
              background-size: cover;">
          <div id="feature-title">
            <h3>
              <a href="https://eex.govspace.gov.au/2016/10/new-eextra-october-2016/" title="NEW: eeXtra – October 2016">NEW: eeXtra – October 2016</a>
            </h3>The latest round-up of energy-efficiency projects and innovations from Australia and around the world.
          </div><!-- end #feature-title --><div class="banner_alt"></div>
        </div>
      </div>
      <!-- Placeholder for hero image finish-->
      <div class="inside"><?php print $content['top']; ?></div>
    </div>
  <?php endif; ?>

  <div class="row">
    <div class="col-sm-8">
      <div class="browse-home">
        <h3>Find information in these areas:</h3>
        <ul>
          <li><a href="/industry-sectors/" title="Industry Sectors">Industry Sectors</a></li>
          <li><a href="/technologies/" title="Technologies">Technologies</a></li>
          <li class="last"><a href="/energy-management/" title="Energy Management">Energy Management</a></li>
        </ul>
      </div>
      <div class="inside"><?php print $content['left']; ?></div>
    </div>
    <div class="col-sm-4">
      <div class="inside"><?php print $content['right']; ?></div>
    </div>
  </div>

  <?php if ($content['bottom']): ?>
    <div class="row">
      <div class="inside"><?php print $content['bottom']; ?></div>
    </div>
  <?php endif; ?>
</div>
