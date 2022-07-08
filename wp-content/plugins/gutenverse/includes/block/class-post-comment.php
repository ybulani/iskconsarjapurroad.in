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
class Post_Comment extends Block_Abstract {
	/**
	 * $attributes, $content
	 *
	 * @param int $post_id .
	 *
	 * @return string
	 */
	public function render_content( $post_id ) {
		$post_id = $post_id ? $post_id : get_the_ID();

		if ( ! empty( $post_id ) ) {
			$comments = get_comments(
				array(
					'post_id' => $post_id,
					'status'  => 'approve',
				)
			);

			$comment_list = wp_list_comments(
				array(
					'per_page'          => 10,
					'reverse_top_level' => false,
					'echo'              => false,
				),
				$comments
			);

			if ( ! empty( $comment_list ) ) {
				ob_start();
				comment_form( array(), $post_id );
				$content = ob_get_clean();

				return '<ol class="commentlist">' . $comment_list . '</ol><div class="comment-form">' . $content . '</div>';
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

		return '<div class="' . $element_id . $display_classes . $animation_class . ' guten-post-comment guten-element">' . $this->render_content( $post_id ) . '</div>';
	}
}
