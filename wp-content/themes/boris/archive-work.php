<?php
/**
 * The template for displaying Archive pages.
 */


$templates = array( 'work-index.twig' );

$context = Timber::get_context();

$args = new WP_Query (array (
  'posts_per_page'      => 10,
  'post_type'           => 'work',
  'meta_key'            => 'portfolio_project_order',
  'orderby'             => 'meta_value_num',
  'order'               => 'DESC'
));
$portfolio = Timber::get_posts($args);

$context['portfolio'] = $portfolio;

Timber::render( $templates, $context );
