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
class Post_Date extends Block_Abstract {
	/**
	 * Render content
	 *
	 * @param int $post_id .
	 *
	 * @return string
	 */
	public function render_content( $post_id ) {
		$type          = esc_html( $this->attributes['dateType'] );
		$format        = esc_html( $this->attributes['dateFormat'] );
		$custom_format = esc_html( $this->attributes['customFormat'] );
		$html_tag      = esc_html( $this->attributes['htmlTag'] );
		$link_to       = esc_html( $this->attributes['linkTo'] );
		$post_id       = $post_id ? $post_id : get_the_ID();

		if ( ! empty( $post_id ) ) {
			if ( 'both' === $type ) {
				$date = gutenverse_get_post_date( $post_id, $format, 'published', $custom_format );
				$date = $date . esc_html__( ' - Updated on ', 'gutenverse' );
				$date = $date . gutenverse_get_post_date( $post_id, $format, 'modified', $custom_format );
			} else {
				$date = gutenverse_get_post_date( $post_id, $format, $type, $custom_format );
			}

			if ( ! empty( $date ) ) {
				switch ( $link_to ) {
					case 'home':
						$home_url = get_home_url();

						$content = '<' . $html_tag . '>
                            <a href="' . $home_url . '">' . $date . '</a>
                        </' . $html_tag . '>';
						break;
					case 'post':
						$post_url = get_post_permalink( $post_id );

						$content = '<' . $html_tag . '>
                            <a href="' . $post_url . '">' . $date . '</a>
                        </' . $html_tag . '>';
						break;
					case 'custom':
						$custom_url = esc_html( $this->attributes['customURL'] );

						$content = '<' . $html_tag . '>
                            <a href="' . $custom_url . '">' . $date . '</a>
                        </' . $html_tag . '>';
						break;
					default:
						$content = '<' . $html_tag . '>' . $date . '</' . $html_tag . '>';
						break;
				}

				return $content;
			}
		}

		return $this->empty_content();
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

		return '<div class="' . $element_id . $display_classes . $animation_class . ' guten-post-date guten-element">' . $this->render_content( $post_id ) . '</div>';
	}
}
