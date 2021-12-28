<?php
/**
 * @package WordPress
 * @subpackage apiolotto
 * @since apiolotto 1.0
 * Template Name: Home
 */
$context = Timber::context();

$context['archivetags'] = $terms = Timber::get_terms( [
    'taxonomy' => 'tag_archivio',
    'hide_empty'    => false,
 ] );

shuffle($context['archivetags']);
$context['archivetags'] = array_slice($context['archivetags'], 0,12);

$pt = Timber::get_posts([
    'post_type' => 'archivio',
    'posts_per_page' => -1,
    'order' => 'ASC',
    'tax_query' => array(
        array (
            'taxonomy' => 'categoria_archivio',
            'field' => 'slug',
            'terms' => 'pt',
        )
    ),
]);

$context['pt'] = $pt;

$cwf = Timber::get_posts([
    'post_type' => 'archivio',
    'posts_per_page' => -1,
    'order' => 'ASC',
    'tax_query' => array(
        array (
            'taxonomy' => 'categoria_archivio',
            'field' => 'slug',
            'terms' => 'cwf',
        )
    ),
]);

$context['cwf'] = $cwf;
$context['archivecats'] = Timber::get_terms('categoria_archivio');

$date_now = date('Y-m-d H:i:s');
$ptterms = Timber::get_terms( ['taxonomy'=>'tag_archivio'] );

foreach ( $ptterms as &$ptterm ) {
    $tag_group_query = Timber::get_posts(
    array(
        'post_type' => 'archivio',
        'tax_query' => array(
            array(
            'taxonomy' => 'tag_archivio',
            'field' => 'slug',
            'terms' => array( $ptterm->slug ),
            'operator' => 'IN'
            )
        ),
    ));
    $ptterm->group = $tag_group_query;

}
$context['ptterms'] = $ptterms;


Timber::render('pages/home.twig', $context);
