<?php

declare(strict_types=1);

add_action('after_setup_theme', function (): void {
  add_theme_support('block-templates');
  add_theme_support('editor-styles');
  add_theme_support('wp-block-styles');
  add_theme_support('post-thumbnails');
});

add_action('wp_enqueue_scripts', function (): void {
  wp_enqueue_style(
    'bizgathers-style',
    get_stylesheet_uri(),
    [],
    wp_get_theme()->get('Version')
  );
});

add_action('enqueue_block_editor_assets', function (): void {
  // Keep editor typography/colors close to front-end.
  wp_enqueue_style(
    'bizgathers-editor-style',
    get_stylesheet_uri(),
    [],
    wp_get_theme()->get('Version')
  );
});

/**
 * MVP: Businesses as a real custom post type + filters.
 */

const BG_BIZ_POST_TYPE = 'bg_business';
const BG_TAX_CATEGORY = 'bg_category';
const BG_TAX_LOCATION = 'bg_location';

const BG_META_PHONE = '_bg_phone';
const BG_META_ADDRESS = '_bg_address';
const BG_META_FACEBOOK = '_bg_facebook_url';
const BG_META_RATING = '_bg_rating';
const BG_META_VERIFIED = '_bg_verified';

add_action('init', function (): void {
  register_post_type(BG_BIZ_POST_TYPE, [
    'labels' => [
      'name' => 'Businesses',
      'singular_name' => 'Business',
      'add_new_item' => 'Add New Business',
      'edit_item' => 'Edit Business',
      'view_item' => 'View Business',
      'search_items' => 'Search Businesses',
    ],
    'public' => true,
    'show_in_rest' => true,
    'menu_icon' => 'dashicons-store',
    'supports' => ['title', 'editor', 'excerpt', 'thumbnail', 'revisions'],
    'has_archive' => true,
    'rewrite' => ['slug' => 'business'],
  ]);

  register_taxonomy(BG_TAX_CATEGORY, [BG_BIZ_POST_TYPE], [
    'labels' => [
      'name' => 'Business Categories',
      'singular_name' => 'Business Category',
    ],
    'public' => true,
    'show_in_rest' => true,
    'hierarchical' => true,
    'rewrite' => ['slug' => 'business-category'],
  ]);

  register_taxonomy(BG_TAX_LOCATION, [BG_BIZ_POST_TYPE], [
    'labels' => [
      'name' => 'Locations',
      'singular_name' => 'Location',
    ],
    'public' => true,
    'show_in_rest' => true,
    'hierarchical' => true,
    'rewrite' => ['slug' => 'business-location'],
  ]);

  // Post meta (stored per business).
  register_post_meta(BG_BIZ_POST_TYPE, BG_META_PHONE, [
    'type' => 'string',
    'single' => true,
    'show_in_rest' => true,
    'sanitize_callback' => 'sanitize_text_field',
    'auth_callback' => static function () { return current_user_can('edit_posts'); },
  ]);
  register_post_meta(BG_BIZ_POST_TYPE, BG_META_ADDRESS, [
    'type' => 'string',
    'single' => true,
    'show_in_rest' => true,
    'sanitize_callback' => 'sanitize_text_field',
    'auth_callback' => static function () { return current_user_can('edit_posts'); },
  ]);
  register_post_meta(BG_BIZ_POST_TYPE, BG_META_FACEBOOK, [
    'type' => 'string',
    'single' => true,
    'show_in_rest' => true,
    'sanitize_callback' => 'esc_url_raw',
    'auth_callback' => static function () { return current_user_can('edit_posts'); },
  ]);
  register_post_meta(BG_BIZ_POST_TYPE, BG_META_RATING, [
    'type' => 'number',
    'single' => true,
    'show_in_rest' => true,
    'sanitize_callback' => static function ($value) {
      $n = is_numeric($value) ? (float) $value : 0.0;
      if ($n < 0) $n = 0;
      if ($n > 5) $n = 5;
      return $n;
    },
    'auth_callback' => static function () { return current_user_can('edit_posts'); },
  ]);
  register_post_meta(BG_BIZ_POST_TYPE, BG_META_VERIFIED, [
    'type' => 'boolean',
    'single' => true,
    'show_in_rest' => true,
    'sanitize_callback' => static function ($value) { return (bool) $value; },
    'auth_callback' => static function () { return current_user_can('edit_posts'); },
  ]);
});

add_action('add_meta_boxes', function (): void {
  add_meta_box(
    'bg_business_details',
    'Business Details',
    'bg_render_business_metabox',
    BG_BIZ_POST_TYPE,
    'normal',
    'high'
  );
});

function bg_render_business_metabox(\WP_Post $post): void {
  wp_nonce_field('bg_business_save', 'bg_business_nonce');

  $phone = (string) get_post_meta($post->ID, BG_META_PHONE, true);
  $address = (string) get_post_meta($post->ID, BG_META_ADDRESS, true);
  $facebook = (string) get_post_meta($post->ID, BG_META_FACEBOOK, true);
  $rating = (string) get_post_meta($post->ID, BG_META_RATING, true);
  $verified = (bool) get_post_meta($post->ID, BG_META_VERIFIED, true);
  ?>
  <p>
    <label for="bg_phone"><strong>Phone</strong></label><br/>
    <input id="bg_phone" name="bg_phone" type="text" value="<?php echo esc_attr($phone); ?>" style="width:100%" />
  </p>
  <p>
    <label for="bg_address"><strong>Address</strong></label><br/>
    <input id="bg_address" name="bg_address" type="text" value="<?php echo esc_attr($address); ?>" style="width:100%" />
  </p>
  <p>
    <label for="bg_facebook"><strong>Facebook URL</strong></label><br/>
    <input id="bg_facebook" name="bg_facebook" type="url" value="<?php echo esc_attr($facebook); ?>" style="width:100%" />
  </p>
  <p style="display:flex; gap: 14px; align-items:center; flex-wrap:wrap;">
    <span>
      <label for="bg_rating"><strong>Rating (0–5)</strong></label><br/>
      <input id="bg_rating" name="bg_rating" type="number" min="0" max="5" step="0.1" value="<?php echo esc_attr($rating); ?>" />
    </span>
    <label style="display:flex; gap:8px; align-items:center; margin-top: 18px;">
      <input name="bg_verified" type="checkbox" value="1" <?php checked($verified); ?> />
      <strong>Verified by BizGathers</strong>
    </label>
  </p>
  <?php
}

add_action('save_post_' . BG_BIZ_POST_TYPE, function (int $post_id): void {
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
  if (!isset($_POST['bg_business_nonce']) || !wp_verify_nonce((string) $_POST['bg_business_nonce'], 'bg_business_save')) return;
  if (!current_user_can('edit_post', $post_id)) return;

  update_post_meta($post_id, BG_META_PHONE, sanitize_text_field((string) ($_POST['bg_phone'] ?? '')));
  update_post_meta($post_id, BG_META_ADDRESS, sanitize_text_field((string) ($_POST['bg_address'] ?? '')));
  update_post_meta($post_id, BG_META_FACEBOOK, esc_url_raw((string) ($_POST['bg_facebook'] ?? '')));

  $rating_raw = $_POST['bg_rating'] ?? '';
  $rating = is_numeric($rating_raw) ? (float) $rating_raw : 0.0;
  if ($rating < 0) $rating = 0;
  if ($rating > 5) $rating = 5;
  update_post_meta($post_id, BG_META_RATING, $rating);

  $verified = isset($_POST['bg_verified']) && (string) $_POST['bg_verified'] === '1';
  update_post_meta($post_id, BG_META_VERIFIED, $verified);
});

/**
 * Directory shortcode with filters.
 *
 * Usage: add a Shortcode block with [bizgathers_directory]
 */
add_shortcode('bizgathers_directory', function ($atts = []): string {
  $atts = shortcode_atts([
    'per_page' => 12,
  ], (array) $atts, 'bizgathers_directory');

  $q = wp_unslash($_GET);
  $search = isset($q['q']) ? sanitize_text_field((string) $q['q']) : '';
  $cat = isset($q['cat']) ? sanitize_text_field((string) $q['cat']) : '';
  $loc = isset($q['loc']) ? sanitize_text_field((string) $q['loc']) : '';
  $verified = isset($q['verified']) ? (string) $q['verified'] : '';
  $min_rating = isset($q['min_rating']) ? (float) $q['min_rating'] : 0.0;
  $paged = max(1, (int) (get_query_var('paged') ?: (isset($q['pg']) ? (int) $q['pg'] : 1)));

  $tax_query = ['relation' => 'AND'];
  if ($cat !== '') {
    $tax_query[] = [
      'taxonomy' => BG_TAX_CATEGORY,
      'field' => is_numeric($cat) ? 'term_id' : 'slug',
      'terms' => is_numeric($cat) ? (int) $cat : $cat,
    ];
  }
  if ($loc !== '') {
    $tax_query[] = [
      'taxonomy' => BG_TAX_LOCATION,
      'field' => is_numeric($loc) ? 'term_id' : 'slug',
      'terms' => is_numeric($loc) ? (int) $loc : $loc,
    ];
  }

  $meta_query = ['relation' => 'AND'];
  if ($verified === '1') {
    $meta_query[] = ['key' => BG_META_VERIFIED, 'value' => true, 'compare' => '='];
  }
  if ($min_rating > 0) {
    $meta_query[] = ['key' => BG_META_RATING, 'value' => $min_rating, 'type' => 'NUMERIC', 'compare' => '>='];
  }

  $args = [
    'post_type' => BG_BIZ_POST_TYPE,
    'post_status' => 'publish',
    's' => $search,
    'paged' => $paged,
    'posts_per_page' => (int) $atts['per_page'],
    'orderby' => 'date',
    'order' => 'DESC',
  ];
  if (count($tax_query) > 1) $args['tax_query'] = $tax_query;
  if (count($meta_query) > 1) $args['meta_query'] = $meta_query;

  $query = new \WP_Query($args);

  $cats = get_terms(['taxonomy' => BG_TAX_CATEGORY, 'hide_empty' => false]);
  $locs = get_terms(['taxonomy' => BG_TAX_LOCATION, 'hide_empty' => false]);

  ob_start();
  ?>
  <div class="bg-card" style="padding:16px; margin-top: 18px;">
    <form method="get" style="display:grid; gap:12px;">
      <div style="display:grid; gap:10px; grid-template-columns: repeat(12, 1fr);">
        <div style="grid-column: span 12;">
          <input name="q" value="<?php echo esc_attr($search); ?>" placeholder="Search businesses…" style="width:100%;padding:12px 14px;border-radius:16px;border:1px solid var(--border);background:color-mix(in oklab,var(--bg) 70%,transparent);color:var(--fg)"/>
        </div>
        <div style="grid-column: span 12; display:grid; gap:10px; grid-template-columns: repeat(12, 1fr);">
          <div style="grid-column: span 12; min-width: 220px;">
            <select name="cat" style="width:100%;padding:12px 14px;border-radius:16px;border:1px solid var(--border);background:color-mix(in oklab,var(--bg) 70%,transparent);color:var(--fg)">
              <option value="">All categories</option>
              <?php foreach ($cats as $t): ?>
                <option value="<?php echo esc_attr((string) $t->slug); ?>" <?php selected($cat, (string) $t->slug); ?>><?php echo esc_html($t->name); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div style="grid-column: span 12; min-width: 220px;">
            <select name="loc" style="width:100%;padding:12px 14px;border-radius:16px;border:1px solid var(--border);background:color-mix(in oklab,var(--bg) 70%,transparent);color:var(--fg)">
              <option value="">All locations</option>
              <?php foreach ($locs as $t): ?>
                <option value="<?php echo esc_attr((string) $t->slug); ?>" <?php selected($loc, (string) $t->slug); ?>><?php echo esc_html($t->name); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div style="grid-column: span 12; min-width: 220px; display:flex; gap:10px; flex-wrap:wrap; align-items:center;">
            <label style="display:flex; gap:8px; align-items:center;">
              <input type="checkbox" name="verified" value="1" <?php checked($verified, '1'); ?> />
              <span style="color:var(--muted); font-weight:700;">Verified</span>
            </label>
            <label style="display:flex; gap:8px; align-items:center; margin-left:auto;">
              <span style="color:var(--muted); font-weight:700;">Min rating</span>
              <input type="number" name="min_rating" min="0" max="5" step="0.1" value="<?php echo esc_attr((string) $min_rating); ?>" style="width:110px;padding:10px 12px;border-radius:14px;border:1px solid var(--border);background:color-mix(in oklab,var(--bg) 70%,transparent);color:var(--fg)"/>
            </label>
          </div>
        </div>
      </div>
      <div style="display:flex; gap:10px; flex-wrap:wrap;">
        <button class="btn-brand" type="submit">Apply filters</button>
        <a class="btn-ghost" href="<?php echo esc_url(get_permalink()); ?>">Reset</a>
      </div>
    </form>
  </div>

  <div style="margin-top: 18px;">
    <?php if (!$query->have_posts()): ?>
      <div class="bg-card" style="padding:16px;">
        <strong>No businesses found.</strong>
        <div style="color:var(--muted); margin-top: 6px;">Try clearing filters or searching a different term.</div>
      </div>
    <?php else: ?>
      <div style="display:grid; gap:14px; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));">
        <?php while ($query->have_posts()): $query->the_post();
          $pid = get_the_ID();
          $rating = (float) get_post_meta($pid, BG_META_RATING, true);
          $is_verified = (bool) get_post_meta($pid, BG_META_VERIFIED, true);
          $phone = (string) get_post_meta($pid, BG_META_PHONE, true);
          $address = (string) get_post_meta($pid, BG_META_ADDRESS, true);
          $fb = (string) get_post_meta($pid, BG_META_FACEBOOK, true);
          ?>
          <article class="bg-card" style="padding:16px; overflow:hidden;">
            <div style="display:flex; align-items:flex-start; justify-content:space-between; gap: 10px;">
              <div>
                <a href="<?php the_permalink(); ?>" style="color:var(--fg); text-decoration:none; font-weight:800; font-size: 16px;">
                  <?php the_title(); ?>
                </a>
                <div style="color:var(--muted); margin-top: 6px; font-size: 13px;">
                  <?php echo esc_html(wp_strip_all_tags(get_the_excerpt())); ?>
                </div>
              </div>
              <?php if ($is_verified): ?>
                <span style="background: var(--brand-2); color: var(--brand); font-weight: 800; font-size: 11px; padding: 6px 10px; border-radius: 999px;">Verified</span>
              <?php endif; ?>
            </div>

            <div style="display:flex; gap:10px; flex-wrap:wrap; margin-top: 12px; color: var(--muted); font-weight: 700; font-size: 12px;">
              <?php if ($rating > 0): ?><span style="background:color-mix(in oklab,var(--bg) 70%,transparent);padding:6px 10px;border-radius:999px;border:1px solid var(--border);">⭐ <?php echo esc_html(number_format($rating, 1)); ?></span><?php endif; ?>
              <?php if ($phone !== ''): ?><span style="background:color-mix(in oklab,var(--bg) 70%,transparent);padding:6px 10px;border-radius:999px;border:1px solid var(--border);"><?php echo esc_html($phone); ?></span><?php endif; ?>
            </div>

            <?php if ($address !== ''): ?>
              <div style="margin-top: 10px; color: var(--muted); font-size: 13px;">
                <?php echo esc_html($address); ?>
              </div>
            <?php endif; ?>

            <div style="display:flex; gap:10px; flex-wrap:wrap; margin-top: 14px;">
              <a class="btn-ghost" href="<?php the_permalink(); ?>">View profile</a>
              <?php if ($fb !== ''): ?>
                <a class="btn-brand" href="<?php echo esc_url($fb); ?>" target="_blank" rel="noreferrer">Facebook</a>
              <?php endif; ?>
            </div>
          </article>
        <?php endwhile; ?>
      </div>

      <div style="margin-top: 18px; display:flex; justify-content:center;">
        <?php
          $base = remove_query_arg(['pg']);
          echo paginate_links([
            'total' => (int) $query->max_num_pages,
            'current' => $paged,
            'format' => '',
            'add_args' => array_filter([
              'q' => $search ?: null,
              'cat' => $cat ?: null,
              'loc' => $loc ?: null,
              'verified' => $verified === '1' ? '1' : null,
              'min_rating' => $min_rating > 0 ? (string) $min_rating : null,
              'pg' => '%#%',
            ], static fn ($v) => $v !== null),
            'type' => 'list',
          ]);
        ?>
      </div>
    <?php endif; ?>
  </div>
  <?php

  wp_reset_postdata();
  return (string) ob_get_clean();
});

