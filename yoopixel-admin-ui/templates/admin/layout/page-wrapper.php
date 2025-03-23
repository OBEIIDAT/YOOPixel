<?php
defined('ABSPATH') || exit;

include __DIR__ . '/../dashboard-header.php';
?>

<div class="yp-page-wrapper">
  <?php
  if (isset($yp_inner_page)) {
      include $yp_inner_page;
  }
  ?>
</div>

<?php include __DIR__ . '/../dashboard-footer.php'; ?>
