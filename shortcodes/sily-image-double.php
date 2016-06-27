<?php

function sinceileftyou_sily_image_double_ui() {
  $image_sizes = array_combine(get_intermediate_image_sizes(), get_intermediate_image_sizes());

  $shortcode_ui_args = array(
    'label'          => esc_html__( 'SILY Image - Double' ),
    'listItemImage'  => 'dashicons-format-gallery',
  );

  $shortcode_ui_args['attrs'] = array(
    array(
      'label'        => esc_html__( 'Quote' ),
      'attr'         => 'quote',
      'type'         => 'text',
    ),

    array(
      'label'  => esc_html__( 'Left image' ),
      'attr'   => 'image_left',
      'type'   => 'attachment',
      'libraryType' => array( 'image' ),
      'addButton'   => esc_html__( 'Select left image' ),
      'frameTitle'  => esc_html__( 'Select left image' ),
    ),
    
    array(
      'label'        => esc_html__( 'Left caption' ),
      'attr'         => 'caption_left',
      'type'         => 'textarea',
    ),

    array(
      'label'  => esc_html__( 'Right image' ),
      'attr'   => 'image_right',
      'type'   => 'attachment',
      'libraryType' => array( 'image' ),
      'addButton'   => esc_html__( 'Select right image' ),
      'frameTitle'  => esc_html__( 'Select right image' ),
    ),

    array(
      'label'        => esc_html__( 'Right caption' ),
      'attr'         => 'caption_right',
      'type'         => 'textarea',
    )
  );


  shortcode_ui_register_for_shortcode(
    'sily-image-double',
    $shortcode_ui_args
  );
}
add_action( 'register_shortcode_ui', 'sinceileftyou_sily_image_double_ui' );

function sinceileftyou_sily_image_double_shortcode( $attrs, $content = '' ) {
  if ( empty($attrs['image_left']) || empty($attrs['image_right']) ) {
    return '';
  }

  if ( isset($attrs['quote'])) {
    $context['quote'] = $attrs['quote'];
  }
  if ( isset($attrs['caption_left'])) {
    $context['caption_left'] = $attrs['caption_left'];
  }
  if ( isset($attrs['caption_right'])) {
    $context['caption_right'] = $attrs['caption_right'];
  }

  $attachment_left_id = $attrs['image_left'];
  $image = wp_get_attachment_image_src($attachment_left_id, 'full');
  $context['img_left_src_orig'] = $image[0];
  $context['img_left_width'] = $image[1];
  $context['img_left_height'] = $image[2];
  $context['img_left_src'] = wp_get_attachment_image_url( $attachment_left_id, 'medium' );
  $context['img_left_srcset'] = wp_get_attachment_image_srcset( $attachment_left_id, 'medium' );

  $attachment_right_id = $attrs['image_right'];
  $image = wp_get_attachment_image_src($attachment_right_id, 'full');
  $context['img_right_src_orig'] = $image[0];
  $context['img_right_width'] = $image[1];
  $context['img_right_height'] = $image[2];
  $context['img_right_src'] = wp_get_attachment_image_url( $attachment_right_id, 'medium' );
  $context['img_right_srcset'] = wp_get_attachment_image_srcset( $attachment_right_id, 'medium' );

  return Timber::compile('sily-image-double.twig', $context);
}