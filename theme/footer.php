<?php
/**
 * @package WordPress
 * @subpackage apiolotto
 * @since apiolotto 1.0
 * The template for displaying the footer
 * Third party plugins that hijack the theme will call wp_footer() to get the footer template.
 * We use this to end our output buffer (started in header.php) and render into the template.
 */

$context = Timber::context();

$context['content'] = ob_get_contents();

ob_end_clean();

Timber::render('plugin.twig', $context);
