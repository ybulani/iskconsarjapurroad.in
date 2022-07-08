<?php
/**
 * Blocks
 *
 * @author Jegstudio
 * @since 1.0.0
 * @package gutenverse
 */

namespace Gutenverse\Block;

/**
 * Class Init
 *
 * @package Gutenverse
 */
class Post_Title extends Block_Abstract {
	/**
	 * Render content
	 *
	 * @param int $post_id .
	 *
	 * @return string
	 */
	public function render_content( $post_id ) {
		$html_tag   = esc_html( $this->attributes['htmlTag'] );
		$link_to    = $this->attributes['linkTo'];
		$post_title = $post_id ? get_the_title( $post_id ) : get_the_title();

		switch ( $link_to ) {
			case 'home':
				$home_url = get_home_url();

				return '<' . $html_tag . '>
					<a href="' . $home_url . '">' . $post_title . '</a>
                </' . $html_tag . '>';
			case 'post':
				$post_url = get_post_permalink( $post_id );

				return '<' . $html_tag . '>
					<a href="' . $post_url . '">' . $post_title . '</a>
				</' . $html_tag . '>';
			case 'custom':
				$custom_url = esc_html( $this->attributes['customURL'] );

				return '<' . $html_tag . '>
					<a href="' . $custom_url . '">' . $post_title . '</a>
				</' . $html_tag . '>';
			default:
				return '<' . $html_tag . '>' . $post_title . '</' . $html_tag . '>';
		}
	}

	/**
	 * Render view in editor
	 */
	public function render_gutenberg() {
		$post_id = esc_html( $this->attributes['backendPostId'] );

		return $this->render_content( $post_id );
	}

	/**
	 * Render view in frontend
	 */
	public function render_frontend() {
		$element_id      = $this->attributes['elementId'];
		$post_id         = esc_html( $this->attributes['postId'] );
		$display_classes = $this->set_display_classes();
		$animation_class = $this->set_animation_classes();

		return '<div class="' . $element_id . $display_classes . $animation_class . ' guten-post-title guten-element">' . $this->render_content( $post_id ) . '</div>';
	}
}
