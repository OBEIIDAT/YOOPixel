<?php
defined('ABSPATH') || exit;
?>

<!-- Welcome + Actions (شبكة مزدوجة في الأعلى) -->
<div class="yp-dashboard-grid">
    <?php include __DIR__ . '/dashboard-cards/card-welcome.php'; ?>
    <?php include __DIR__ . '/dashboard-cards/card-actions.php'; ?>
</div>

<!-- Website Management في الأسفل -->
<div class="yp-dashboard-grid">
    <?php include __DIR__ . '/dashboard-cards/card-links.php'; ?>
</div>

<!-- Popup for dynamic submenu -->
<?php include __DIR__ . '/popup.php'; ?>
