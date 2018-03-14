<?php

function twentyseventeen_include_svg_icons()
{
    // Define SVG sprite file.
    $svg_icons = get_parent_theme_file_path('/images/svg-icons.svg');

    // If it exists, include it.
    if (file_exists($svg_icons)) {
        require_once($svg_icons);
    }
}
add_action('wp_footer', 'twentyseventeen_include_svg_icons', 9999);

function indiezero_time_link()
{
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

    // if you want the updated time
    // if (get_the_time('U') !== get_the_modified_time('U')) {
    //     $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    // }

    $time_string = sprintf(
        $time_string,
        get_the_date(DATE_W3C),
        get_the_date(),
        get_the_modified_date(DATE_W3C),
        get_the_modified_date()
    );

    // Wrap the time string in a link, and preface it with 'Posted on'.
    return sprintf(
        /* translators: %s: post date */
        __('<span class="screen-reader-text">Posted on</span> %s', 'twentyseventeen'),
        // could be a link if you want
        // '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
        '<div class="indiezero-blog-date">' . $time_string . '</div>'
    );
}

function indiezero_posted_on()
{
    // Get the author name; wrap it in a link.
    $byline = sprintf(
      /* translators: %s: post author */
      __('by %s', 'indiezero'),
      '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . get_the_author() . '</a></span>'
  );

    // Finally, let's write all of this to the page.
    echo '<span class="posted-on">' . indiezero_time_link() . '</span><span class="byline"> ' . $byline . '</span>';
}

function indiezero_get_svg($args = array())
{
    // Make sure $args are an array.
    if (empty($args)) {
        return __('Please define default parameters in the form of an array.', 'twentyseventeen');
    }

    // Define an icon.
    if (false === array_key_exists('icon', $args)) {
        return __('Please define an SVG icon filename.', 'twentyseventeen');
    }

    // Set defaults.
    $defaults = array(
        'icon'        => '',
        'title'       => '',
        'desc'        => '',
        'fallback'    => false,
    );

    // Parse args.
    $args = wp_parse_args($args, $defaults);

    // Set aria hidden.
    $aria_hidden = ' aria-hidden="true"';

    // Set ARIA.
    $aria_labelledby = '';

    if ($args['title']) {
        $aria_hidden     = '';
        $unique_id       = uniqid();
        $aria_labelledby = ' aria-labelledby="title-' . $unique_id . '"';

        if ($args['desc']) {
            $aria_labelledby = ' aria-labelledby="title-' . $unique_id . ' desc-' . $unique_id . '"';
        }
    }

    // Begin SVG markup.
    $svg = '<svg class="svg-icon icon-' . esc_attr($args['icon']) . '"' . $aria_hidden . $aria_labelledby . ' role="img">';

    // Display the title.
    if ($args['title']) {
        $svg .= '<title id="title-' . $unique_id . '">' . esc_html($args['title']) . '</title>';

        // Display the desc only if the title is already set.
        if ($args['desc']) {
            $svg .= '<desc id="desc-' . $unique_id . '">' . esc_html($args['desc']) . '</desc>';
        }
    }

    $svg .= ' <use href="#icon-' . esc_html($args['icon']) . '" xlink:href="#icon-' . esc_html($args['icon']) . '"></use> ';

    // Add some markup to use as a fallback for browsers that do not support SVGs.
    if ($args['fallback']) {
        $svg .= '<span class="svg-fallback icon-' . esc_attr($args['icon']) . '"></span>';
    }

    $svg .= '</svg>';

    return $svg;
}
