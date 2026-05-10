<?php
/**
 * Title: Home – Hero
 * Slug: bizgathers/home-hero
 * Categories: featured
 */
?>

<!-- wp:group {"className":"bg-grid","layout":{"type":"constrained"}} -->
<div class="wp-block-group bg-grid">
  <!-- wp:group {"className":"bg-card","style":{"spacing":{"padding":{"top":"28px","bottom":"28px","left":"28px","right":"28px"}}},"layout":{"type":"constrained"}} -->
  <div class="wp-block-group bg-card" style="padding-top:28px;padding-right:28px;padding-bottom:28px;padding-left:28px">
    <!-- wp:paragraph {"style":{"typography":{"fontSize":"12px","fontWeight":"700"},"color":{"text":"var(--muted)"},"border":{"radius":"999px"},"spacing":{"padding":{"top":"6px","bottom":"6px","left":"10px","right":"10px"}}},"backgroundColor":"transparent","className":"bg-pill"} -->
    <p class="bg-pill" style="border-radius:999px;padding-top:6px;padding-right:10px;padding-bottom:6px;padding-left:10px;color:var(--muted);font-size:12px;font-weight:700">Online directory for local SMEs</p>
    <!-- /wp:paragraph -->

    <!-- wp:heading {"level":1} -->
    <h1 class="wp-block-heading">Find trusted local businesses—fast.</h1>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"style":{"color":{"text":"var(--muted)"}}} -->
    <p style="color:var(--muted)">Search by service and location, filter by trust score, and explore verified listings with clear profiles.</p>
    <!-- /wp:paragraph -->

    <!-- wp:group {"className":"bg-card","style":{"spacing":{"padding":{"top":"16px","bottom":"16px","left":"16px","right":"16px"},"margin":{"top":"18px"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group bg-card" style="margin-top:18px;padding-top:16px;padding-right:16px;padding-bottom:16px;padding-left:16px">
      <!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"12px"}}}} -->
      <div class="wp-block-columns">
        <!-- wp:column -->
        <div class="wp-block-column">
          <!-- wp:search {"label":"Service type","showLabel":false,"placeholder":"Service type (e.g., Coffee, Salon)","buttonText":"Search","buttonUseIcon":false} /-->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column">
          <!-- wp:paragraph {"style":{"color":{"text":"var(--muted)"},"typography":{"fontSize":"12px"}}} -->
          <p style="color:var(--muted);font-size:12px">Tip: use categories + trust score filters in the Directory page.</p>
          <!-- /wp:paragraph -->
        </div>
        <!-- /wp:column -->
      </div>
      <!-- /wp:columns -->

      <!-- wp:buttons {"style":{"spacing":{"margin":{"top":"10px"}}}} -->
      <div class="wp-block-buttons" style="margin-top:10px">
        <!-- wp:button {"style":{"color":{"background":"var(--brand)","text":"#000"},"border":{"radius":"999px"}}} -->
        <div class="wp-block-button"><a class="wp-block-button__link has-text-color has-background wp-element-button" style="border-radius:999px;color:#000;background-color:var(--brand)">Get Listed — It’s Free</a></div>
        <!-- /wp:button -->
        <!-- wp:button {"style":{"border":{"radius":"999px"},"color":{"background":"var(--card)","text":"var(--fg)"},"elements":{"link":{"color":{"text":"var(--fg)"}}}}} -->
        <div class="wp-block-button"><a class="wp-block-button__link has-text-color has-background has-link-color wp-element-button" style="border-radius:999px;background-color:var(--card);color:var(--fg)">Browse directory</a></div>
        <!-- /wp:button -->
      </div>
      <!-- /wp:buttons -->
    </div>
    <!-- /wp:group -->
  </div>
  <!-- /wp:group -->
</div>
<!-- /wp:group -->

