<?php
/**
 * The Template for single work
 */
$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;
$context['categories'] = Timber::get_terms('category');


if ( post_password_required( $post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} else {
	Timber::render( 'single-work.twig', $context );
}
