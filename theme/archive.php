<?php
/**
 * @package WordPress
 * @subpackage apiolotto
 * @since apiolotto 1.0
 * The template for displaying archive pages
 */

$templates = ['index.twig'];

$context = Timber::context();

$queried_object = get_queried_object();
$context['queried_post_type'] = get_post_type();
$context['queried_taxonomy'] = isset($queried_object->taxonomy) ? $queried_object->taxonomy : '';
$context['queried_term'] = isset($queried_object->slug) ? $queried_object->slug : '';

$context['wallpaperscats'] = Timber::get_terms('wallpaper_category');

$papers = Timber::get_posts([
    'post_type' => 'wallpaper',
    'posts_per_page' => -1,
    'order' => 'ASC',
    'tax_query' => array(
        array (
            'taxonomy' => 'wallpaper_category',
            'field' => 'slug',
            'terms' => $context['queried_term'],
        )
    ),
]);

$context['papers'] = $papers;
$context['thiscat'] = Timber::get_term($context['queried_term']->ID);

array_unshift($templates, 'category-' . $context['queried_taxonomy'] . '.twig');


Timber::render($templates, $context);
