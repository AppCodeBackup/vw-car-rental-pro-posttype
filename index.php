<?php 
/*
 Plugin Name: VW Car Rental Pro Posttype
 lugin URI: https://www.vwthemes.com/
 Description: Creating new post type for VW Car Rental Pro Theme.
 Author: VW Themes
 Version: 1.0
 Author URI: https://www.vwthemes.com/
*/

define( 'VW_CAR_RENTAL_PRO_POSTTYPE_VERSION', '1.0' );
add_action( 'init', 'carscategory');
add_action( 'init', 'vw_car_rental_pro_posttype_create_post_type' );

function vw_car_rental_pro_posttype_create_post_type() {

  register_post_type( 'car',
    array(
      'labels' => array(
        'name' => __( 'Car','vw-car-rental-pro-posttype' ),
        'singular_name' => __( 'Car','vw-car-rental-pro-posttype' )
      ),
        'capability_type' => 'post',
        'menu_icon'  => 'dashicons-businessman',
        'public' => true,
        'supports' => array( 
          'title',
          'editor',
          'thumbnail'
      )
    )
  );

  register_post_type( 'services',
    array(
        'labels' => array(
            'name' => __( 'Services','vw-car-rental-pro-posttype' ),
            'singular_name' => __( 'Services','vw-car-rental-pro-posttype' )
        ),
        'capability_type' =>  'post',
        'menu_icon'  => 'dashicons-tag',
        'public' => true,
        'supports' => array(
        'title',
        'editor',
        'thumbnail',
        'page-attributes',
        'comments'
        )
    )
  );

  register_post_type( 'testimonials',
    array(
  		'labels' => array(
  			'name' => __( 'Testimonials','vw-car-rental-pro-posttype' ),
  			'singular_name' => __( 'Testimonials','vw-car-rental-pro-posttype' )
  		),
  		'capability_type' => 'post',
  		'menu_icon'  => 'dashicons-businessman',
  		'public' => true,
  		'supports' => array(
  			'title',
  			'editor',
  			'thumbnail'
  		)
		)
	);
}

/* ---------------- Car Start ----------------- */

function carscategory() {
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name'              => __( 'Categories', 'vw-car-rental-pro-posttype' ),
    'singular_name'     => __( 'Categories', 'vw-car-rental-pro-posttype' ),
    'search_items'      => __( 'Search cats', 'vw-car-rental-pro-posttype' ),
    'all_items'         => __( 'All Categories', 'vw-car-rental-pro-posttype' ),
    'parent_item'       => __( 'Parent Categories', 'vw-car-rental-pro-posttype' ),
    'parent_item_colon' => __( 'Parent Categories:', 'vw-car-rental-pro-posttype' ),
    'edit_item'         => __( 'Edit Categories', 'vw-car-rental-pro-posttype' ),
    'update_item'       => __( 'Update Categories', 'vw-car-rental-pro-posttype' ),
    'add_new_item'      => __( 'Add New Categories', 'vw-car-rental-pro-posttype' ),
    'new_item_name'     => __( 'New Categories Name', 'vw-car-rental-pro-posttype' ),
    'menu_name'         => __( 'Categories', 'vw-car-rental-pro-posttype' ),
  );
  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'carscategory' ),
  );
  register_taxonomy( 'carscategory', array( 'car' ), $args );
}

// Car Meta
function vw_car_rental_pro_posttype_bn_custom_meta_car() {

    add_meta_box( 'bn_meta', __( 'Car Meta', 'vw-car-rental-pro-posttype-pro' ), 'vw_car_rental_pro_posttype_bn_meta_callback_car', 'car', 'normal', 'high' );
}
/* Hook things in for admin*/
if (is_admin()){
  add_action('admin_menu', 'vw_car_rental_pro_posttype_bn_custom_meta_car');
}

function vw_car_rental_pro_posttype_bn_meta_callback_car( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'bn_nonce' );
    $bn_stored_meta = get_post_meta( $post->ID );

    $car_rent = get_post_meta( $post->ID, 'meta-car-rent', true );
    $car_duration = get_post_meta( $post->ID, 'meta-car-duration', true );
    $car_seats = get_post_meta( $post->ID, 'meta-car-seats', true );
    $car_year = get_post_meta( $post->ID, 'meta-car-year', true );
    $car_ac = get_post_meta( $post->ID, 'meta-car-ac', true );
    $car_luggage = get_post_meta( $post->ID, 'meta-car-luggage', true );
    $car_transmission = get_post_meta( $post->ID, 'meta-car-transmission', true );
    $car_doors = get_post_meta( $post->ID, 'meta-car-doors', true );
    ?>
  <div id="property_stuff">
    <table id="list-table">     
      <tbody id="the-list" data-wp-lists="list:meta">
        <tr id="meta-1">
          <td class="left">
              <?php _e( 'Car Rent', 'vw-car-rental-pro-posttype' )?>
          </td>
          <td class="left" >
              <input type="text" name="meta-car-rent" id="meta-car-rent" value="<?php echo esc_html($car_rent); ?>" />
          </td>
        </tr>
        <tr id="meta-2">
          <td class="left">
              <?php _e( 'Duration', 'vw-car-rental-pro-posttype' )?>
          </td>
          <td class="left" >
              <input type="text" name="meta-car-duration" id="meta-car-duration" value="<?php echo esc_html($car_duration); ?>" />
          </td>
        </tr>
        <tr id="meta-3">
          <td class="left">
              <?php _e( 'No Of Seats', 'vw-car-rental-pro-posttype' )?>
          </td>
          <td class="left" >
              <input type="text" name="meta-car-seats" id="meta-car-seats" value="<?php echo esc_html($car_seats); ?>" />
          </td>
        </tr>
        <tr id="meta-4">
          <td class="left">
            <?php _e( 'Model Year', 'vw-car-rental-pro-posttype' )?>
          </td>
          <td class="left" >
            <input type="text" name="meta-car-year" id="meta-car-year" value="<?php echo esc_html($car_year); ?>" />
          </td>
        </tr>
        <tr id="meta-5">
          <td class="left">
            <?php _e( 'Air Condition', 'vw-car-rental-pro-posttype' )?>
          </td>
          <td class="left" >
            <input type="text" name="meta-car-ac" id="meta-car-ac" value="<?php echo esc_html($car_ac); ?>" />
          </td>
        </tr>
        <tr id="meta-6">
          <td class="left">
            <?php _e( 'Luggage', 'vw-car-rental-pro-posttype' )?>
          </td>
          <td class="left" >
            <input type="text" name="meta-car-luggage" id="meta-car-luggage" value="<?php echo esc_html($car_luggage); ?>" />
          </td>
        </tr>
        <tr id="meta-7">
          <td class="left">
            <?php _e( 'Transmission', 'vw-car-rental-pro-posttype' )?>
          </td>
          <td class="left" >
            <input type="text" name="meta-car-transmission" id="meta-car-transmission" value="<?php echo esc_html($car_transmission); ?>" />
          </td>
        </tr>
        <tr id="meta-7">
          <td class="left">
            <?php _e( 'Doors', 'vw-car-rental-pro-posttype' )?>
          </td>
          <td class="left" >
            <input type="text" name="meta-car-doors" id="meta-car-doors" value="<?php echo esc_html($car_doors); ?>" />
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <?php
}

function vw_car_rental_pro_posttype_bn_meta_save_car( $post_id ) {

  if (!isset($_POST['bn_nonce']) || !wp_verify_nonce($_POST['bn_nonce'], basename(__FILE__))) {
    return;
  }

  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }
  if( isset( $_POST[ 'meta-car-rent' ] ) ) {
      update_post_meta( $post_id, 'meta-car-rent', sanitize_text_field($_POST[ 'meta-car-rent' ]) );
  } 

  if( isset( $_POST[ 'meta-car-duration' ] ) ) {
      update_post_meta( $post_id, 'meta-car-duration', sanitize_text_field($_POST[ 'meta-car-duration' ]) );
  } 

  if( isset( $_POST[ 'meta-car-seats' ] ) ) {
      update_post_meta( $post_id, 'meta-car-seats', sanitize_text_field($_POST[ 'meta-car-seats' ]) );
  } 

  if( isset( $_POST[ 'meta-car-year' ] ) ) {
      update_post_meta( $post_id, 'meta-car-year', sanitize_text_field($_POST[ 'meta-car-year' ]) );
  } 

  if( isset( $_POST[ 'meta-car-ac' ] ) ) {
      update_post_meta( $post_id, 'meta-car-ac', sanitize_text_field($_POST[ 'meta-car-ac' ]) );
  } 

  if( isset( $_POST[ 'meta-car-luggage' ] ) ) {
      update_post_meta( $post_id, 'meta-car-luggage', sanitize_text_field($_POST[ 'meta-car-luggage' ]) );
  } 

  if( isset( $_POST[ 'meta-car-transmission' ] ) ) {
      update_post_meta( $post_id, 'meta-car-transmission', sanitize_text_field($_POST[ 'meta-car-transmission' ]) );
  } 

  if( isset( $_POST[ 'meta-car-doors' ] ) ) {
      update_post_meta( $post_id, 'meta-car-doors', sanitize_text_field($_POST[ 'meta-car-doors' ]) );
  }
 
}
add_action( 'save_post', 'vw_car_rental_pro_posttype_bn_meta_save_car' );

/* Services shortcode */
function vw_car_rental_pro_posttype_car_func( $atts ) {
  $services = '';
  $services = '<div class="row">';
  $query = new WP_Query( array( 'post_type' => 'car') );

    if ( $query->have_posts() ) :

  $k=1;
  $new = new WP_Query('post_type=car');

  while ($new->have_posts()) : $new->the_post();
        $custom_url ='';
        $post_id = get_the_ID();
        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'medium' );
        $url = $thumb['0'];
        $carrent = get_post_meta($post_id,'meta-car-rent',true);
        $carduration = get_post_meta($post_id,'meta-car-duration',true);
        $carseats = get_post_meta($post_id,'meta-car-seats',true);
        $caryear = get_post_meta($post_id,'meta-car-year',true);
        $cartra = get_post_meta($post_id,'meta-car-transmission',true);
        $carac = get_post_meta($post_id,'meta-car-ac',true);
        $excerpt = wp_trim_words(get_the_excerpt(),15);
        if(get_post_meta($post_id,'meta-services-url',true !='')){$custom_url =get_post_meta($post_id,'meta-services-url',true); } else{ $custom_url = get_permalink(); }
        $services .= '<div class="col-lg-4 col-md-6 col-sm-6">
                      <div class="car-box">
                        <img src="'.esc_url($url).'">
                        <h4>
                          '.$carrent.'&nbsp;&#x2215;
                          <sub>'.$carduration.'</sub>
                        </h4>
                        <h5><a href="'.esc_url($custom_url).'">'.esc_html(get_the_title()) .'</a></h5>
                        <div class="car-features">
                          <span>
                            <i class="fas fa-user"></i>
                            '.$carseats.'
                          </span>&#x2758;
                          <span>
                            <i class="fas fa-share-alt"></i>
                            '.$cartra.'
                          </span>&#x2758;
                          <span>
                            <i class="fas fa-car"></i>
                            '.$caryear.'
                          </span>
                          <span>&#x2758;
                            <i class="far fa-snowflake"></i>
                            '.$carac.'
                          </span>
                        </div>
                        <div class="car-info">
                          '.$excerpt.'
                        </div>
                      </div>
                  </div>';


    if($k%2 == 0){
      $services.= '<div class="clearfix"></div>';
    }
      $k++;
  endwhile;
  else :
    $services = '<h2 class="center">'.esc_html__('Post Not Found','vw-car-rental-pro-posttype').'</h2>';
  endif;
  $services .= '</div>';
  return $services;
}

add_shortcode( 'vw-car-rental-pro-car', 'vw_car_rental_pro_posttype_car_func' );


/* ----------------- Services --------------------- */
function vw_car_rental_pro_posttype_images_metabox_enqueue($hook) {
  if ( 'post.php' === $hook || 'post-new.php' === $hook ) {
    wp_enqueue_script('vw-car-rental-pro-posttype-pro-images-metabox', plugin_dir_url( __FILE__ ) . '/js/img-metabox.js', array('jquery', 'jquery-ui-sortable'));

    global $post;
    if ( $post ) {
      wp_enqueue_media( array(
          'post' => $post->ID,
        )
      );
    }

  }
}
add_action('admin_enqueue_scripts', 'vw_car_rental_pro_posttype_images_metabox_enqueue');
// Services Meta
function vw_car_rental_pro_posttype_bn_custom_meta_services() {

    add_meta_box( 'bn_meta', __( 'Services Meta', 'vw-car-rental-pro-posttype-pro' ), 'vw_car_rental_pro_posttype_bn_meta_callback_services', 'services', 'normal', 'high' );
}
/* Hook things in for admin*/
if (is_admin()){
  add_action('admin_menu', 'vw_car_rental_pro_posttype_bn_custom_meta_services');
}

function vw_car_rental_pro_posttype_bn_meta_callback_services( $post ) {



    wp_nonce_field( basename( __FILE__ ), 'bn_nonce' );
    $bn_stored_meta = get_post_meta( $post->ID );
    $service_image = get_post_meta( $post->ID, 'service-meta-image', true );
    ?>
  <div id="property_stuff">
    <table id="list-table">     
      <tbody id="the-list" data-wp-lists="list:meta">
        <tr id="meta-1">
          <p>
            <label for="meta-image"><?php echo esc_html('Icon Image'); ?></label><br>
            <input type="text" name="service-meta-image" id="service-meta-image" class="meta-image regular-text" value="<?php echo esc_attr( $service_image ); ?>">
            <input type="button" class="button image-upload" value="Browse">
          </p>
          <div class="image-preview"><img src="<?php echo $bn_stored_meta['service-meta-image'][0]; ?>" style="max-width: 250px;"></div>
        </tr>
      </tbody>
    </table>
  </div>
  <?php
}

function vw_car_rental_pro_posttype_bn_meta_save_services( $post_id ) {

  if (!isset($_POST['bn_nonce']) || !wp_verify_nonce($_POST['bn_nonce'], basename(__FILE__))) {
    return;
  }

  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }
  // Save Image
  if( isset( $_POST[ 'service-meta-image' ] ) ) {
      update_post_meta( $post_id, 'service-meta-image', esc_url_raw($_POST[ 'service-meta-image' ]) );
  }
  
}
add_action( 'save_post', 'vw_car_rental_pro_posttype_bn_meta_save_services' );

/* Services shortcode */
function vw_car_rental_pro_posttype_services_func( $atts ) {

  $services = '';
  $services = '<div class="row">';
  $query = new WP_Query( array( 'post_type' => 'services') );

    if ( $query->have_posts() ) :

  $k=1;
  $new = new WP_Query('post_type=services');

  while ($new->have_posts()) : $new->the_post();
        $custom_url ='';
        $post_id = get_the_ID();
        $excerpt = wp_trim_words(get_the_excerpt(),25);
        $services_image= get_post_meta(get_the_ID(), 'service-meta-image', true);
        if(get_post_meta($post_id,'meta-services-url',true !='')){$custom_url =get_post_meta($post_id,'meta-services-url',true); } else{ $custom_url = get_permalink(); }
        $services .= '<div class="col-lg-4 col-md-4 col-sm-6 services-box">
                        <div>
                          <div class="services_icon">
                            <img class="" src="'.esc_url($services_image).'">
                          </div>
                        </div>
                        <div>
                          <h4><a href="'.esc_url($custom_url).'">'.esc_html(get_the_title()) .'</a></h4>
                          <div class="services-info">
                            '.$excerpt.'
                          </div>
                        </div>
                      </div>';


    if($k%2 == 0){
      $services.= '<div class="clearfix"></div>';
    }
      $k++;
  endwhile;
  else :
    $services = '<h2 class="center">'.esc_html__('Post Not Found','vw-car-rental-pro-posttype').'</h2>';
  endif;
  $services .= '</div>';
  return $services;
}

add_shortcode( 'vw-car-rental-pro-services', 'vw_car_rental_pro_posttype_services_func' );

/*----------------------Testimonial section ----------------------*/

function vw_car_rental_pro_posttype_bn_testimonial_meta_box() {
	add_meta_box( 'vw-car-rental-pro-posttype-testimonial-meta', __( 'Enter Details', 'vw-car-rental-pro-posttype' ), 'vw_car_rental_pro_posttype_bn_testimonial_meta_callback', 'testimonials', 'normal', 'high' );
}
// Hook things in for admin
if (is_admin()){
    add_action('admin_menu', 'vw_car_rental_pro_posttype_bn_testimonial_meta_box');
}
/* Adds a meta box for custom post */
function vw_car_rental_pro_posttype_bn_testimonial_meta_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'vw_car_rental_pro_posttype_posttype_testimonial_meta_nonce' );
  $bn_stored_meta = get_post_meta( $post->ID );
  if(!empty($bn_stored_meta['vw_car_rental_pro_posttype_testimonial_desigstory'][0]))
      $bn_vw_car_rental_pro_posttype_testimonial_desigstory = $bn_stored_meta['vw_car_rental_pro_posttype_testimonial_desigstory'][0];
    else
      $bn_vw_car_rental_pro_posttype_testimonial_desigstory = '';
	?>
	<div id="testimonials_custom_stuff">
		<table id="list">
			<tbody id="the-list" data-wp-lists="list:meta">
				<tr id="meta-1">
					<td class="left">
						<?php _e( 'Designation', 'vw-car-rental-pro-posttype' )?>
					</td>
					<td class="left" >
						<input type="text" name="vw_car_rental_pro_posttype_testimonial_desigstory" id="vw_car_rental_pro_posttype_testimonial_desigstory" value="<?php echo esc_attr( $bn_vw_car_rental_pro_posttype_testimonial_desigstory ); ?>" />
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<?php
}

/* Saves the custom meta input */
function vw_car_rental_pro_posttype_bn_metadesig_save( $post_id ) {
	if (!isset($_POST['vw_car_rental_pro_posttype_posttype_testimonial_meta_nonce']) || !wp_verify_nonce($_POST['vw_car_rental_pro_posttype_posttype_testimonial_meta_nonce'], basename(__FILE__))) {
		return;
	}

	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	// Save desig.
	if( isset( $_POST[ 'vw_car_rental_pro_posttype_testimonial_desigstory' ] ) ) {
		update_post_meta( $post_id, 'vw_car_rental_pro_posttype_testimonial_desigstory', sanitize_text_field($_POST[ 'vw_car_rental_pro_posttype_testimonial_desigstory']) );
	}
}

add_action( 'save_post', 'vw_car_rental_pro_posttype_bn_metadesig_save' );


/*------------------- Testimonial Shortcode -------------------------*/

function vw_car_rental_pro_posttype_testimonials_func( $atts ) {
    $testimonial = ''; 
    $testimonial = '<div id="testimonials"><div class="row testimonial_shortcodes">';
      $new = new WP_Query( array( 'post_type' => 'testimonials') );
      if ( $new->have_posts() ) :
        $k=1;
        while ($new->have_posts()) : $new->the_post();
          $post_id = get_the_ID();
          $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'medium' );
          $url = $thumb['0'];
          $excerpt = vw_car_rental_pro_string_limit_words(get_the_excerpt(),30);
          $designation = get_post_meta($post_id,'vw_car_rental_pro_posttype_testimonial_desigstory',true);

          $testimonial .= '<div class="col-lg-4 col-md-6 col-sm-6 mb-4"><div class="testimonial_box_sc text-center">';
                if (has_post_thumbnail()){
                    $testimonial.= '<img src="'.esc_url($url).'">';
                    }
               $testimonial .= '<div class="qoute_text_sc pb-3">'.$excerpt.'</div>
                <h4 class="testimonial_name_sc"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h4>
                <cite>'.esc_html($designation).'</cite>
              </div></div>';
          $k++;         
        endwhile; 
        wp_reset_postdata();
      else :
        $testimonial = '<div id="testimonial" class="testimonial_wrap col-md-3 mt-3 mb-4"><h2 class="center">'.__('Not Found','vw-car-rental-pro-posttype').'</h2></div>';
      endif;
    $testimonial .= '</div></div>';
    return $testimonial;
}
add_shortcode( 'vw-car-rental-pro-testimonials', 'vw_car_rental_pro_posttype_testimonials_func' );

