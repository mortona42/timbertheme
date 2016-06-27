<?php

$context = Timber::get_context();

$context['menu'] = new TimberMenu();

$context['blog_name'] = get_bloginfo('name');

Timber::render('header.twig', $context);