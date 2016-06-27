<?php
/**
 * The Template for displaying entry header.
 */
$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

$context['subtitle'] = CFS()->get( 'subtitle' );

$attachment_id = $post->_thumbnail_id;
$image = wp_get_attachment_image_src($attachment_id, 'full');
$context['img_src_orig'] = $image[0];
$context['img_src'] = wp_get_attachment_image_url( $attachment_id, 'entry-header' );
$context['img_width'] = $image[1];
$context['img_height'] = $image[2];
$context['img_srcset'] = wp_get_attachment_image_srcset( $attachment_id, 'entry-header' );

Timber::render('entry-header.twig', $context);