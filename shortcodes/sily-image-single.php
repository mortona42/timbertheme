<?php

function sinceileftyou_sily_image_single_ui() {
  $image_sizes = array_combine(get_intermediate_image_sizes(), get_intermediate_image_sizes());

  $shortcode_ui_args = array(
    'label'          => esc_html__( 'SILY Image - Single' ),
    'listItemImage'  => 'dashicons-format-gallery',
  );

  $shortcode_ui_args['attrs'] = array(
    array(
      'label'        => esc_html__( 'Quote' ),
      'attr'         => 'quote',
      'type'         => 'text',
    ),
    
    array(
      'label'  => esc_html__( 'Image Align' ),
      'attr'   => 'image_align',
      'type'   => 'select',
      'options' => array(
        'center' => esc_html__( 'Center' ),
        'left' => esc_html__( 'Left' ),
        'right' => esc_html__( 'Right' ),
      ),
      'value' => 'center',
    ),

    array(
      'label'  => esc_html__( 'Image' ),
      'attr'   => 'image',
      'type'   => 'attachment',
      'libraryType' => array( 'image' ),
      'addButton'   => esc_html__( 'Select Image' ),
      'frameTitle'  => esc_html__( 'Select Image' ),
    ),

    array(
      'label'        => esc_html__( 'Caption' ),
      'attr'         => 'caption',
      'type'         => 'textarea',
    )
  );

  shortcode_ui_register_for_shortcode(
    'sily-image-single',
    $shortcode_ui_args
  );
}
add_action( 'register_shortcode_ui', 'sinceileftyou_sily_image_single_ui' );

function sinceileftyou_sily_image_single_shortcode( $attrs, $content = '' ) {
  if ( empty($attrs['image']) ) {
    return '';
  }

  $context = array();
  $context['caption'] = isset($attrs['caption']) ? $attrs['caption'] : false;
  $context['quote'] = isset($attrs['quote']) ? $attrs['quote'] : false;
  $context['image_align'] = $attrs['image_align'];

  switch($attrs['image_align']) {
    case 'left':
      $context['quote_align'] = 'right';
      break;
    case 'right':
      $context['quote_align'] = 'left';
      break;
    case 'center':
      $context['quote_align'] = 'center';
      break;
  }


  $attachment_id = $attrs['image'];
  $image = wp_get_attachment_image_src($attachment_id, 'full');
  $context['img_src_orig'] = $image[0];
  $context['img_src'] = wp_get_attachment_image_url( $attachment_id, 'medium' );
  $context['img_width'] = $image[1];
  $context['img_height'] = $image[2];
  $context['img_srcset'] = wp_get_attachment_image_srcset( $attachment_id, 'medium' );


  return Timber::compile('sily-image-single.twig', $context);
}