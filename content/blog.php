<?php

echo '<div class="zero-page">';
echo '<div class="blog-posts">';

if (have_posts()) {
    while (have_posts()) {
        the_post();

        echo '<div class="indiezero-blog-header">';
        echo '<div class="indiezero-blog-avatar"></div>';
        echo '<div class="indiezero-blog-header-contents">';

        if ('post' === get_post_type()) {
            echo indiezero_time_link();
        };

        the_title('<div class="indiezero-entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></div>');

        echo '</div>';
        echo '</div>';

        echo '<div class="indiezero-entry-content">';
        the_content();

        wp_link_pages(array(
          'before'      => '<div class="page-links">' . __('Pages:', 'indiezero'),
          'after'       => '</div>',
          'link_before' => '<span class="page-number">',
          'link_after'  => '</span>',
        ));

        echo '</div>';
    }

    the_posts_pagination(array(
    'prev_text' => indiezero_get_svg(array( 'icon' => 'arrow-left' )) . '<span class="screen-reader-text">' . __('Previous page', 'indiezero') . '</span>',
    'next_text' => '<span class="screen-reader-text">' . __('Next page', 'indiezero') . '</span>' . indiezero_get_svg(array( 'icon' => 'arrow-right' )),
    'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'indiezero') . ' </span>',
  ));
}

echo '</div>';
echo '</div>';
