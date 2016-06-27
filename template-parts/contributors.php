<?php

$context = Timber::get_context();

$context['contributors'] = Timber::get_posts(array('post_type' => 'post'));

Timber::render('contributors.twig', $context);