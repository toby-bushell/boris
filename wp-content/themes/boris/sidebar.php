<?php
/**
 * The Template for displaying all single posts
 *
 *
 * @package  WordPress
 * @subpackage  Timber
 */
$args = array(
 	'type'            => 'monthly',
 	'limit'           => '',
 	'format'          => 'html',
 	'before'          => '',
 	'after'           => '',
 	'show_post_count' => false,
 	'echo'            => 1,
 	'order'           => 'DESC',
  'post_type'       => 'post'
 );

$context['args'] = $args;
// $context['archives'] = Timber::get_posts($args);
$context['categories'] = Timber::get_terms('category');

Timber::render( array( 'sidebar.twig' ), $context );
