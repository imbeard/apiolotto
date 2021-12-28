<?php
/**
 * @package WordPress
 * @subpackage apiolotto
 * @since apiolotto 1.0
 * The template for displaying all pages
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 */

$context = Timber::context();

$post = $context['post'];

$templates = [
  'pages/page-' . $post->ID . '.twig',
  'pages/page-' . $post->slug . '.twig',
  'pages/page-' . $post->post_type . '.twig',
  'pages/page.twig',
];

Timber::render($templates, $context);
