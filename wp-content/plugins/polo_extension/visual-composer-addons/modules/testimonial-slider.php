<?php
if ( ! class_exists( 'Crumina_Testimonial_Slider' ) ) {

	class Crumina_Testimonial_Slider {

		function __construct() {
			add_action( 'vc_before_init', array( &$this, 'slider_init' ) );
			add_shortcode( 'crumina_testimonial_slider', array( &$this, 'slider_form' ) );
		}

		function slider_init() {

			if ( function_exists( 'vc_map' ) ) {
				vc_map(
					array(
						"name"                    => esc_html__( "Polo Testimonial slider", 'polo_extension' ),
						"base"                    => "crumina_testimonial_slider",
						"class"                   => "",
						"icon"                    => "testimonial-slider",
						"category"                => esc_html__( 'Polo Modules', 'polo_extension' ),
						"as_parent"               => array( 'only' => 'crumina_testimonial' ),
						"content_element"         => true,
						"js_view"                 => 'VcColumnView',
						"show_settings_on_create" => true,
						"params"                  => array(
							array(
								'type'        => 'dropdown',
								'heading'     => esc_html__( 'Controls style', 'polo_extension' ),
								'value'       => array(
									esc_html__( 'Dots', 'polo_extension' )   => 'dots',
									esc_html__( 'Arrows', 'polo_extension' ) => 'arrows',
								),
								'admin_label' => true,
								'param_name'  => 'controls_style',
							),
							array(
								'type'       => 'number',
								'heading'    => esc_html__( 'Slides to show', 'polo_extension' ),
								'param_name' => 'slides_to_show',
								'min'        => 0,
								'std'        => '3',
							),
							array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Extra class name', 'polo_extension' ),
								'param_name'  => 'el_class',
								'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'polo_extension' ),
							),
						)
					)
				);
			}

		}

		function slider_form( $atts, $content = null ) {

			$controls_style = $slides_to_show = $el_class = '';

			extract(
				shortcode_atts(
					array(
						'controls_style' => 'dots',
						'slides_to_show' => '3',
						'el_class'       => '',
					), $atts
				)
			);

			$output = $data_dots = '';

			if ( 'dots' === $controls_style ) {
				$data_dots = 'data-carousel-dots="true"';
			}

			preg_match_all( '/' . get_shortcode_regex() . '/s', $content, $matches );
			$output .= '<div class="carousel ' . $el_class . '" data-carousel-col="' . $slides_to_show . '" ' . $data_dots . '>';
			if(isset($matches[0]) && !empty($matches[0])){
				foreach($matches[0] as $single_shortcode){
					$single_shortcode = str_replace('crumina_testimonial','crumina_testimonial in_slider="true"',$single_shortcode);
					$output .= do_shortcode($single_shortcode);
				}
			}
			$output .= '</div>';//.carousel

			return $output;

		}

	}

}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Crumina_Testimonial_Slider extends WPBakeryShortCodesContainer {
	}

}

if ( class_exists( 'Crumina_Testimonial_Slider' ) ) {
	$Crumina_Testimonial_Slider = new Crumina_Testimonial_Slider;
}