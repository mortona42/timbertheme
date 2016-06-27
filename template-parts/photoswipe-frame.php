<?php
/**
 * The Template for displaying photoswipe frame.
 */
$context = Timber::get_context();
$post = new TimberPost();
Timber::render('photoswipe-frame.twig', $context);