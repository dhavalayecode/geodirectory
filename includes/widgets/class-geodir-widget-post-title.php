<?php

/**
 * GeoDir_Widget_Post_Title class.
 *
 * @since 2.0.0
 */
class GeoDir_Widget_Post_Title extends WP_Super_Duper {


	public $arguments;
	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {

		$options = array(
			'textdomain'    => GEODIRECTORY_TEXTDOMAIN,
			'block-icon'    => 'minus',
			'block-category'=> 'common',
			'block-keywords'=> "['title','geo','geodir']",
			'block-output'   => array( // the block visual output elements as an array
				array(
					'element' => 'h1',
					'class'   => '[%className%]',
					'element_require' => '[%tag%]=="h1"',
					'content'   => __("Demo title h1","geodirectory"),
				),
				array(
					'element' => 'h2',
					'class'   => '[%className%]',
					'element_require' => '[%tag%]=="h2"',
					'content'   => __("Demo title h2","geodirectory"),
				),
				array(
					'element' => 'h3',
					'class'   => '[%className%]',
					'element_require' => '[%tag%]=="h3"',
					'content'   => __("Demo title h3","geodirectory"),
				),

			),
			'class_name'    => __CLASS__,
			'base_id'       => 'gd_post_title', // this us used as the widget id and the shortcode id.
			'name'          => __('GD > Post Title','geodirectory'), // the name of the widget.
			'widget_ops'    => array(
				'classname'   => 'geodir-post-title', // widget class
				'description' => esc_html__('This shows a GD post title with link.','geodirectory'), // widget description
				'geodirectory' => true,
			),
			'arguments'     => array(
				'tag'  => array(
					'title' => __('Output Type:', 'geodirectory'),
					'desc' => __('How the images should be displayed.', 'geodirectory'),
					'type' => 'select',
					'options'   =>  array(
						"h2" => "h2",
						"h3" => "h3",
						"h1" => "h1",
					),
					'default'  => 'h2',
					'desc_tip' => true,
					'advanced' => true
				)
			)
		);


		parent::__construct( $options );
	}


	/**
	 * The Super block output function.
	 *
	 * @param array $args
	 * @param array $widget_args
	 * @param string $content
	 *
	 * @return mixed|string|void
	 */
	public function output($args = array(), $widget_args = array(),$content = ''){
		global $post;
		ob_start();
		// options
		$defaults = array(
			'tag'      => 'h2', // h1, h2, h3
		);

		/**
		 * Parse incoming $args into an array and merge it with $defaults
		 */
		$args = wp_parse_args( $args, $defaults );

		?>
		<<?php echo esc_attr($args['tag']);?> class="geodir-entry-title">
			<a href="<?php the_permalink(); ?>" title="<?php echo wp_sprintf( 'View: %s', stripslashes( the_title_attribute( array( 'echo' => false ) ) ) ); ?>"><?php echo stripslashes( get_the_title() ); ?></a>
		</<?php echo esc_attr($args['tag']);?>>
		<?php

		return ob_get_clean();

	}

}

