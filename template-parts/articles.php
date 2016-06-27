<?php

$context = Timber::get_context();
$context['posts'] = Timber::get_posts();
$context['featured'] = array_shift($context['posts']);
Timber::render('articles.twig', $context);