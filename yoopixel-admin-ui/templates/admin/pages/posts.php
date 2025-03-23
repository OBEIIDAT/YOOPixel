<?php
defined('ABSPATH') || exit;

$author      = isset($_GET['author'])   ? intval($_GET['author']) : '';
$month       = isset($_GET['m'])        ? sanitize_text_field($_GET['m']) : '';
$cat         = isset($_GET['cat'])      ? intval($_GET['cat']) : '';
$tag_id      = isset($_GET['tag_id'])   ? intval($_GET['tag_id']) : '';
$per_page    = isset($_GET['per_page']) ? sanitize_text_field($_GET['per_page']) : 20;
$search      = isset($_GET['s'])        ? sanitize_text_field($_GET['s']) : '';
$paged       = isset($_GET['paged'])    ? max(1, intval($_GET['paged'])) : 1;
$post_status = isset($_GET['post_status']) ? sanitize_text_field($_GET['post_status']) : '';

if ($per_page === 'ALL') $per_page = -1;

$args = [
  'post_type'      => 'post',
  'posts_per_page' => $per_page,
  'paged'          => $paged,
  's'              => $search,
];

if ($author)      $args['author'] = $author;
if ($month)       $args['m'] = $month;
if ($cat)         $args['cat'] = $cat;
if ($tag_id)      $args['tag_id'] = $tag_id;
if ($post_status) $args['post_status'] = $post_status;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bulk_action'], $_POST['post_ids'])) {
  $action = $_POST['bulk_action'];
  $post_ids = array_map('intval', $_POST['post_ids']);
  if ($action === 'delete') {
    foreach ($post_ids as $post_id) {
      wp_delete_post($post_id, true);
    }
    wp_redirect(remove_query_arg(['bulk_action', 'post_ids'], $_SERVER['REQUEST_URI']));
    exit;
  }
}

$wp_query = new WP_Query($args);
$found_posts = $wp_query->found_posts;
$total_pages = $wp_query->max_num_pages;
?>

<div class="yoopixel-posts-wrapper">
  <h2><span class="dashicons dashicons-edit"></span> <?php _e('Manage Posts', 'yoopixel'); ?></h2>

  <div class="yp-posts-toolbar">
    <a href="<?php echo admin_url('post-new.php'); ?>" class="yp-btn-add"><?php _e('+ Add New Post', 'yoopixel'); ?></a>

    <form method="get" class="yp-posts-filters">
      <input type="hidden" name="page" value="yoopixel-posts" />
      <input type="text" name="s" placeholder="<?php _e('Search posts...', 'yoopixel'); ?>" value="<?php echo esc_attr($search); ?>" />

      <select name="m">
        <option value=""><?php _e('All dates', 'yoopixel'); ?></option>
        <?php
        global $wpdb;
        $months = $wpdb->get_results("
          SELECT DISTINCT YEAR(post_date) AS year, MONTH(post_date) AS month
          FROM $wpdb->posts
          WHERE post_type = 'post' AND post_status != 'auto-draft'
          ORDER BY post_date DESC
        ");
        foreach ($months as $m) {
          $month_val = zeroise($m->year, 4) . zeroise($m->month, 2);
          $label = date_i18n("F Y", mktime(0, 0, 0, $m->month, 1, $m->year));
          echo '<option value="' . esc_attr($month_val) . '" ' . selected($month, $month_val, false) . '>' . esc_html($label) . '</option>';
        }
        ?>
      </select>

      <select name="cat">
        <option value=""><?php _e('All categories', 'yoopixel'); ?></option>
        <?php foreach (get_categories(['hide_empty' => false]) as $c): ?>
          <option value="<?php echo esc_attr($c->term_id); ?>" <?php selected($cat, $c->term_id); ?>>
            <?php echo esc_html($c->name); ?>
          </option>
        <?php endforeach; ?>
      </select>

      <select name="tag_id">
        <option value=""><?php _e('All tags', 'yoopixel'); ?></option>
        <?php foreach (get_tags(['hide_empty' => false]) as $tag): ?>
          <option value="<?php echo esc_attr($tag->term_id); ?>" <?php selected($tag_id, $tag->term_id); ?>>
            <?php echo esc_html($tag->name); ?>
          </option>
        <?php endforeach; ?>
      </select>

      <select name="post_status">
        <option value=""><?php _e('All statuses', 'yoopixel'); ?></option>
        <option value="publish" <?php selected($post_status, 'publish'); ?>><?php _e('Published', 'yoopixel'); ?></option>
        <option value="draft" <?php selected($post_status, 'draft'); ?>><?php _e('Draft', 'yoopixel'); ?></option>
        <option value="pending" <?php selected($post_status, 'pending'); ?>><?php _e('Pending', 'yoopixel'); ?></option>
        <option value="private" <?php selected($post_status, 'private'); ?>><?php _e('Private', 'yoopixel'); ?></option>
        <option value="trash" <?php selected($post_status, 'trash'); ?>><?php _e('Trash', 'yoopixel'); ?></option>
      </select>

      <select name="per_page">
        <?php foreach ([20, 40, 60, 80, 100, 'ALL'] as $num): ?>
          <option value="<?php echo esc_attr($num); ?>" <?php selected($_GET['per_page'] ?? 20, $num); ?>>
            <?php echo $num === 'ALL' ? __('All', 'yoopixel') : $num; ?>
          </option>
        <?php endforeach; ?>
      </select>
    </form>
  </div>

  <form method="post">
    <div class="yp-posts-bulk-bar">
      <select name="bulk_action">
        <option value=""><?php _e('Bulk actions', 'yoopixel'); ?></option>
        <option value="delete"><?php _e('Delete', 'yoopixel'); ?></option>
      </select>
      <button type="submit" class="yp-btn-apply"><?php _e('Apply', 'yoopixel'); ?></button>
    </div>

    <div class="yp-posts-table">
      <div class="yp-posts-header">
        <input type="checkbox" onclick="document.querySelectorAll('.yp-select-post').forEach(cb => cb.checked = this.checked)" />
        <div><?php _e('Title', 'yoopixel'); ?></div>
        <div><?php _e('Author', 'yoopixel'); ?></div>
        <div><?php _e('Categories', 'yoopixel'); ?></div>
        <div><?php _e('Tags', 'yoopixel'); ?></div>
        <div><?php _e('Comments', 'yoopixel'); ?></div>
        <div><?php _e('Date', 'yoopixel'); ?></div>
        <div><?php _e('Actions', 'yoopixel'); ?></div>
      </div>

      <?php if ($wp_query->have_posts()): ?>
        <?php while ($wp_query->have_posts()): $wp_query->the_post(); ?>
          <div class="yp-posts-row">
            <input type="checkbox" class="yp-select-post" name="post_ids[]" value="<?php the_ID(); ?>" />
            <div><a href="<?php echo get_edit_post_link(); ?>" style="color:#EEB44E;"><?php the_title(); ?></a></div>
            <div><a href="<?php echo esc_url(add_query_arg('author', get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a></div>
            <div><?php the_category(', '); ?></div>
            <div>
              <?php
              $tags = get_the_tags();
              if ($tags) {
                $out = array_map(function($tag) {
                  return '<a href="' . esc_url(add_query_arg('tag_id', $tag->term_id)) . '">' . esc_html($tag->name) . '</a>';
                }, $tags);
                echo implode(', ', $out);
              } else {
                echo '-';
              }
              ?>
            </div>
            <div><?php echo get_comments_number(); ?></div>
            <div><?php echo get_the_date(); ?></div>
            <div class="post-actions">
              <?php if (get_post_status() === 'trash'): ?>
                <a href="<?php echo esc_url(wp_nonce_url(admin_url("post.php?post=" . get_the_ID() . "&action=untrash"), 'untrash-post_' . get_the_ID())); ?>" title="Restore Post">
                  <svg width="20" height="20" fill="#2ecc71" viewBox="0 0 24 24"><path d="M3 6h18v2H3V6zm2 3h14v13H5V9zm7 1v9h2v-9h3l-4-4-4 4h3z"/></svg>
                </a>
                <a href="<?php echo get_delete_post_link(get_the_ID(), '', true); ?>" onclick="return confirm('Are you sure you want to permanently delete this post?');" title="Delete Permanently">
                  <svg width="20" height="20" fill="#e74c3c" viewBox="0 0 24 24"><path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-4.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"/></svg>
                </a>
              <?php else: ?>
                <a href="<?php echo get_edit_post_link(); ?>" title="Edit Post">
                  <svg width="20" height="20" fill="#EEB44E" viewBox="0 0 24 24"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM21.41 6.34c.38-.38.38-1.02 0-1.41l-2.34-2.34a.9959.9959 0 0 0-1.41 0L15.13 4.21l3.75 3.75 2.53-2.53z"/></svg>
                </a>
                <a href="<?php echo get_delete_post_link(); ?>" onclick="return confirm('Are you sure?');" title="Move to Trash">
                  <svg width="20" height="20" fill="#e74c3c" viewBox="0 0 24 24"><path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-4.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"/></svg>
                </a>
              <?php endif; ?>
            </div>
          </div>
        <?php endwhile; wp_reset_postdata(); ?>
      <?php else: ?>
        <div class="yp-posts-row"><div colspan="8"><?php _e('No posts found.', 'yoopixel'); ?></div></div>
      <?php endif; ?>
    </div>
  </form>

  <div class="yp-posts-toolbar" style="justify-content: space-between; margin-top: 25px;">
    <div><?php echo sprintf(__('Showing %d posts', 'yoopixel'), $found_posts); ?></div>
    <div>
      <?php
      echo paginate_links([
        'base'      => add_query_arg('paged', '%#%'),
        'format'    => '',
        'current'   => $paged,
        'total'     => $total_pages,
        'prev_text' => '«',
        'next_text' => '»'
      ]);
      ?>
    </div>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const filterForm = document.querySelector('.yp-posts-filters');
    if (!filterForm) return;

    // فلترة تلقائية عند تغيير select
    filterForm.querySelectorAll('select').forEach(function (field) {
      field.addEventListener('change', function () {
        filterForm.submit();
      });
    });

    // فلترة تلقائية عند كتابة 3 أحرف أو أكثر في حقل البحث
    const searchInput = filterForm.querySelector('input[name="s"]');
    let typingTimer;

    if (searchInput) {
      searchInput.addEventListener('keyup', function () {
        clearTimeout(typingTimer);
        if (searchInput.value.length >= 3 || searchInput.value.length === 0) {
          typingTimer = setTimeout(function () {
            filterForm.submit();
          }, 500); // تأخير بسيط لتفادي كثرة الإرسال
        }
      });

      // فلترة عند الضغط على Enter
      searchInput.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
          e.preventDefault();
          filterForm.submit();
        }
      });
    }
  });
</script>

