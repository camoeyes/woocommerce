<?php

// Add the field to the checkout page

add_action('woocommerce_after_checkout_billing_form', 'my_custom_checkout_field', 15);
function my_custom_checkout_field( $checkout ) {
    echo '<div id="my_custom_checkout_field"><h3>'.__('').'</h3>';
    woocommerce_form_field( 'my_field_name', array(
        'type'          => 'text',
        'class'         => array('my-field-class form-row-wide'),
        'label'         => __('<span style="color:red;"><strong style="color:red;margin:0;font-family:none !important;">Other</strong></span>'),
        'placeholder'       => __('Type Here.'),
        ), $checkout->get_value( 'my_field_name' ));
    echo '</div>';
}


// Update the order meta with field value order edit screen etc


add_action('woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta');
function my_custom_checkout_field_update_order_meta( $order_id ) {
    if ($_POST['my_field_name']) update_post_meta( $order_id, 'Source', esc_attr($_POST['my_field_name']));
}



/**
 * Outputs a rasio button form field
 */
function woocommerce_form_field_radio( $key, $args, $value = '' ) {
  			global $woocommerce;
				$defaults = array(
								 'type' => 'radio',
								'label' => '',
								'placeholder' => '',
								'required' => false,
								'class' => array( ),
								'label_class' => array( ),
								'return' => false,
								'options' => array( )
				);
				$args     = wp_parse_args( $args, $defaults );
				if ( ( isset( $args[ 'clear' ] ) && $args[ 'clear' ] ) )
								$after = '<div class="clear"></div>';
				else
								$after = '';
				$required = ( $args[ 'required' ] ) ? ' <abbr class="required" title="' . esc_attr__( 'required', 'woocommerce' ) . '">*</abbr>' : '';
				switch ( $args[ 'type' ] ) {
								case "select":
												$options = '';
												if ( !empty( $args[ 'options' ] ) )
																foreach ( $args[ 'options' ] as $option_key => $option_text )
																				$options .= '<input type="radio" name="' . $key . '" id="' . $key . '" value="' . $option_key . '" ' . selected( $value, $option_key, false ) . 'class="select">' . $option_text . '' . "\r\n";
												$field = '<p class="form-row ' . implode( ' ', $args[ 'class' ] ) . '" id="' . $key . '_field">
<label for="' . $key . '" class="' . implode( ' ', $args[ 'label_class' ] ) . '">' . $args[ 'label' ] . $required . '</label>
' . $options . '
</p>' . $after;
												break;
				} //$args[ 'type' ]
				if ( $args[ 'return' ] )
								return $field;
				else
								echo $field;
}
/**
 * Add the field to the checkout
**/
add_action( 'woocommerce_after_checkout_billing_form', 'hear_about_us_field', 10 );
function hear_about_us_field( $checkout ) {
				echo '<div id="hear_about_us_field" style="background: lightgoldenrodyellow;"><h3>' . __( 'How\'d you First find us?' ) . '</h3>';
				woocommerce_form_field_radio( 'hear_about_us', array(
								 'type' => 'select',
								'class' => array(
												 'here-about-us form-row-wide'
								),
								'label' => __( '' ),
								'placeholder' => __( 'Source' ),
								'required' => false,
								'options' => array(
												'Google' => 'Google<br/>',
												'Other Search' => 'Other Search Engine<br/>',
												'Friend' => 'Friend<br/>',
												'Friend/Facebook' => 'Facebook/Friend<br/>',
												'YouTube' => 'Someone on YouTube<br/>',
												'Other' => 'Other<br/>'

												
								)
				), $checkout->get_value( 'hear_about_us' ) );
				echo '</div>'; 
}

/**
 * Update the order meta with field value
 **/
add_action( 'woocommerce_checkout_update_order_meta', 'hear_about_us_field_update_order_meta' );
function hear_about_us_field_update_order_meta( $order_id ) {
				if ( $_POST[ 'hear_about_us' ] )
								update_post_meta( $order_id, 'How did you hear about us?', esc_attr( $_POST[ 'hear_about_us' ] ) );
}




?>
