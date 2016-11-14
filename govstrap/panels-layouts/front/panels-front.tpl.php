
<div class="page-template-home-1" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
  <?php if ($content['top']): ?>
    <div class="row page-front-top">
      <div class="inside"><?php print $content['top']; ?></div>
    </div>
  <?php endif; ?>

  <div class="row page-front-middle">
    <div class="col-sm-8 page-front-middle-left">
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
    <div class="col-sm-4 page-front-middle-right">
      <div class="inside"><?php print $content['right']; ?></div>
    </div>
  </div>

  <?php if ($content['bottom']): ?>
    <div class="row page-front-bottom">
      <div class="inside"><?php print $content['bottom']; ?></div>
    </div>
  <?php endif; ?>
</div>
