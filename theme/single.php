<?php
/**
 * @package WordPress
 * @subpackage apiolotto
 * @since apiolotto 1.0
 * The template for displaying all single posts
 */

$context = Timber::context();

$post = $context['post'];
$designers = Timber::get_posts([
    'post_type' => 'designer',
    'posts_per_page' => -1,
    'order' => 'ASC',
]);

$context['designers'] = $designers;

$materials = Timber::get_posts([
    'post_type' => 'materiale',
    'posts_per_page' => -1,
    'order' => 'ASC',
]);

$context['materials'] = $materials;

$templates = [
  'posts/single-' . $post->ID . '.twig',
  'posts/single-' . $post->slug . '.twig',
  'posts/single-' . $post->post_type . '.twig',
  'posts/single.twig',
];

Timber::render($templates, $context);
