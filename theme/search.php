<?php
/**
 * @package WordPress
 * @subpackage apiolotto
 * @since apiolotto 1.0
 * The template for displaying search results pages
 */

$context['posts'] = new Timber\PostQuery();

Timber::render('search.twig', Timber::context());
