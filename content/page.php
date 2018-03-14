<?php

echo '<div class="zero-page">';
echo '<div class="page-posts">';

do_action('indiezero-before-posts');

if (have_posts()) {
    while (have_posts()) {
        the_post();

        if (!is_page()) {
            do_action('indiezero-before-title');

            echo '<div class="indiezero-entry-title">';
            the_title();
            echo '</div>';

            do_action('indiezero-after-title');
        }

        do_action('indiezero-before-content');

        echo '<div class="indiezero-entry-content">';
        the_content();
        echo '</div>';

        do_action('indiezero-after-content');
    }
}

do_action('indiezero-after-posts');

echo '</div>';
echo '</div>';
