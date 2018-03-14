<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php

get_header();
if (is_home()) {
    get_template_part('content/blog');
} else {
    get_template_part('content/page');
}

get_footer();

?>

</body>
</html>