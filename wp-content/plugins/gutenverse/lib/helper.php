<?php
/**
 * Helper Functionality
 *
 * @author Jegstudio
 * @since 1.0.0
 * @package gutenverse
 */

if ( ! function_exists( 'jlog' ) ) {
	/**
	 * Print Log
	 */
	function jlog() {
		$numargs  = func_num_args();
		$arg_list = func_get_args();
		for ( $i = 0; $i < $numargs; $i++ ) {
			echo '<pre>';
			print_r( $arg_list[ $i ] );
			echo '</pre>';
		}
	}
}

if ( ! function_exists( 'gutenverse_secure_permalink' ) ) {
	/**
	 * Get Secure Permalink
	 *
	 * @param string $url .
	 *
	 * @return string|string[]|null
	 */
	function gutenverse_secure_permalink( $url ) {
		if ( is_ssl() ) {
			$url = preg_replace( '/^http:/i', 'https:', $url );
		} else {
			$url = preg_replace( '/^https:/i', 'http:', $url );
		}

		return $url;
	}
}

if ( ! function_exists( 'gutenverse_encode_url' ) ) {
	/**
	 * Encode URL
	 *
	 * @param int $post_id .
	 *
	 * @return string
	 */
	function gutenverse_encode_url( $post_id ) {
		$url = get_permalink( $post_id );

		return urlencode( $url ); //phpcs:ignore
	}
}

if ( ! function_exists( 'gutenverse_print_html' ) ) {
	/**
	 * Print HTML with wp_kses
	 *
	 * @param HTML   $html .
	 * @param string $condition .
	 */
	function gutenverse_print_html( $html, $condition = null ) {
		echo wp_kses( $html, wp_kses_allowed_html( $condition ) );
	}
}

if ( ! function_exists( 'gutenverse_get_post_date' ) ) {
	/**
	 * Get the post date
	 *
	 * @param \WP_Post      $post Post object.
	 * @param date_format   $format string.
	 * @param display       $type string.
	 * @param custom_format $custom string.
	 *
	 * @return string
	 */
	function gutenverse_get_post_date( $post, $format, $type, $custom ) {
		if ( 'ago' === $format ) {
			$output = gutenverse_get_ago_format( $type, $post );
		} elseif ( 'custom' === $format ) {
			$output = gutenverse_get_date_format( $custom, $post, $type );
		} else {
			$output = gutenverse_get_date_format( null, $post, $type );
		}

		return $output;
	}
}


if ( ! function_exists( 'gutenverse_get_date_format' ) ) {
	/**
	 * Get date format
	 *
	 * @param date_format $format string.
	 * @param \WP_Post    $post Post object.
	 * @param display     $type string.
	 *
	 * @return string|int|false
	 */
	function gutenverse_get_date_format( $format = '', $post = null, $type = '' ) {
		if ( 'published' === $type ) {
			return get_the_date( $format, $post );
		}

		return get_the_modified_date( $format, $post );
	}
}

if ( ! function_exists( 'gutenverse_get_ago_format' ) ) {
	/**
	 * Get ago format
	 *
	 * @param display  $type string.
	 * @param \WP_Post $post Post object.
	 *
	 * @return string
	 */
	function gutenverse_get_ago_format( $type, $post ) {
		if ( 'published' === $type ) {
			$output = gutenverse_ago_time( human_time_diff( get_the_time( 'U', $post ), time() ) );
		} else {
			$output = gutenverse_ago_time( human_time_diff( get_the_modified_time( 'U', $post ), time() ) );
		}

		return $output;
	}
}

if ( ! function_exists( 'gutenverse_ago_time' ) ) {
	/**
	 * Get ago time
	 *
	 * @param ago_time $time string.
	 *
	 * @return string
	 */
	function gutenverse_ago_time( $time ) {
		return esc_html(
			sprintf(
				/* translators: 1: Time from now. */
				esc_html__( '%s ago', 'gutenverse' ),
				$time
			)
		);
	}
}

if ( ! function_exists( 'gutenverse_post_class' ) ) {
	/**
	 * Get post class
	 *
	 * @param string $class User defined class.
	 * @param null   $post_id Post ID.
	 *
	 * @return string
	 */
	function gutenverse_post_class( $class = '', $post_id = null ) {
		// Separates classes with a single space, collates classes for post DIV.
		return 'class="' . join( ' ', gutenverse_get_post_class( $class, $post_id ) ) . '"';
	}
}

if ( ! function_exists( 'gutenverse_get_post_class' ) ) {
	/**
	 * Custom implementation of get_post_class for Jeg Element
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 * @param int|WP_Post  $post_id Optional. Post ID or post object.
	 *
	 * @return array Array of classes.
	 */
	function gutenverse_get_post_class( $class = '', $post_id = null ) {
		$post = get_post( $post_id );

		$classes = array();

		if ( $class ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_map( 'esc_attr', $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}

		if ( ! $post ) {
			return $classes;
		}

		$classes[] = 'post-' . $post->ID;
		if ( ! is_admin() ) {
			$classes[] = $post->post_type;
		}
		$classes[] = 'type-' . $post->post_type;
		$classes[] = 'status-' . $post->post_status;

		// Post Format.
		if ( post_type_supports( $post->post_type, 'post-formats' ) ) {
			$post_format = get_post_format( $post->ID );

			if ( $post_format && ! is_wp_error( $post_format ) ) {
				$classes[] = 'format-' . sanitize_html_class( $post_format );
			} else {
				$classes[] = 'format-standard';
			}
		}

		$post_password_required = post_password_required( $post->ID );

		// Post requires password.
		if ( $post_password_required ) {
			$classes[] = 'post-password-required';
		} elseif ( ! empty( $post->post_password ) ) {
			$classes[] = 'post-password-protected';
		}

		// Post thumbnails.
		if ( current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail( $post->ID ) && ! is_attachment( $post ) && ! $post_password_required ) {
			$classes[] = 'has-post-thumbnail';
		}

		// sticky for Sticky Posts.
		if ( is_sticky( $post->ID ) ) {
			if ( is_home() && ! is_paged() ) {
				$classes[] = 'sticky';
			} elseif ( is_admin() ) {
				$classes[] = 'status-sticky';
			}
		}

		// hentry for hAtom compliance.
		$classes[] = 'hentry';

		// All public taxonomies.
		$taxonomies = get_taxonomies( array( 'public' => true ) );
		foreach ( (array) $taxonomies as $taxonomy ) {
			if ( is_object_in_taxonomy( $post->post_type, $taxonomy ) ) {
				foreach ( (array) get_the_terms( $post->ID, $taxonomy ) as $term ) {
					if ( empty( $term->slug ) ) {
						continue;
					}

					$term_class = sanitize_html_class( $term->slug, $term->term_id );
					if ( is_numeric( $term_class ) || ! trim( $term_class, '-' ) ) {
						$term_class = $term->term_id;
					}

					// 'post_tag' uses the 'tag' prefix for backward compatibility.
					if ( 'post_tag' === $taxonomy ) {
						$classes[] = 'tag-' . $term_class;
					} else {
						$classes[] = sanitize_html_class( $taxonomy . '-' . $term_class, $taxonomy . '-' . $term->term_id );
					}
				}
			}
		}

		$classes = array_map( 'esc_attr', $classes );

		return array_unique( $classes );
	}
}

if ( ! function_exists( 'gutenverse_join_array' ) ) {
	/**
	 * Merge array into string with comma (,)
	 *
	 * @param array $values .
	 * @param bool  $wrap .
	 */
	function gutenverse_join_array( $values, $wrap = true ) {
		return $wrap ? '<span>' . implode( ', ', $values ) . ' </span>' : implode( ', ', $values );
	}
}

if ( ! function_exists( 'gutenverse_get_json' ) ) {
	/**
	 * Get JSON data
	 *
	 * @param string $path .
	 */
	function gutenverse_get_json( $path ) {
		ob_start();
		include $path;
		$data = ob_get_clean();

		return json_decode( $data, true );
	}
}

if ( ! function_exists( 'gutenverse_header_font' ) ) {
	/**
	 * Header Font
	 *
	 * @param array $font_families Array of font family.
	 * @param array $font_variables Array of font id that needed to be loaded.
	 *
	 * @return void
	 */
	function gutenverse_header_font( $font_families, $font_variables ) {
		$families = array();

		foreach ( $font_families as $font ) {
			$family = $font['value'];
			$type   = $font['type'];
			$id     = ! empty( $font['id'] ) ? $font['id'] : null;

			if ( 'google' === $type && ( in_array( $id, $font_variables, true ) || null === $id ) ) {
				$families[ $family ] = isset( $families[ $family ] ) ? $families[ $family ] : array();

				if ( 'google' === $type && ! empty( $font['weight'] ) ) {
					array_push( $families[ $family ], $font['weight'] );
				}
			}
		}

		$google_fonts = gutenverse_google_font_params( $families );

		if ( ! empty( $google_fonts ) ) {
			$font_url = add_query_arg(
				array(
					'family' => join( '|', $google_fonts ),
				),
				'//fonts.googleapis.com/css'
			);

			// Enqueue google font.
			wp_enqueue_style(
				'gutenverse-google-font',
				$font_url,
				array(),
				GUTENVERSE_VERSION
			);
		}
	}
}

if ( ! function_exists( 'gutenverse_google_font_params' ) ) {
	/**
	 * Get Google Font params
	 *
	 * @param array $families List of font families.
	 *
	 * @return array
	 */
	function gutenverse_google_font_params( $families ) {
		$result = array();

		foreach ( $families as $family => $weights ) {
			$defaults = array( '400', '400italic', '700', '700italic' );
			$weights  = array_merge(
				$defaults,
				$weights
			);
			$weights  = join( ',', array_unique( $weights ) );
			$result[] = ! empty( $weights ) ? "{$family}:{$weights}" : $family;
		}

		return $result;
	}
}

if ( ! function_exists( 'gutenverse_is_previewer' ) ) {
	/**
	 * If current page is previewer
	 */
	function gutenverse_is_previewer() {
		return isset( $_GET['preview'] );
	}
}

if ( ! function_exists( 'gutenverse_is_autosave' ) ) {
	/**
	 * If current request is autosave
	 */
	function gutenverse_is_autosave() {
		return defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE;
	}
}


if ( ! function_exists( 'gutenverse_pro_activated' ) ) {
	/**
	 * Check if gutenverse pro installed.
	 */
	function gutenverse_pro_activated() {
		return defined( 'GUTENVERSE_PRO' );
	}
}

if ( ! function_exists( 'gutenverse_pro_installed' ) ) {
	/**
	 * Check if gutenverse pro activated.
	 */
	function gutenverse_pro_installed() {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
		$plugin = 'gutenverse-pro/gutenverse-pro.php';

		$installed_plugins = get_plugins();

		return isset( $installed_plugins[ $plugin ] );
	}
}


if ( ! function_exists( 'print_header_style' ) ) {
	/**
	 * Print Header Style
	 *
	 * @param string $name Name of style.
	 * @param string $content Content of css.
	 */
	function gutenverse_print_header_style( $name, $content ) {
		?>
		<style id="<?php echo esc_attr( $name ); ?>"> 
			<?php
				echo wp_specialchars_decode( trim( $content ) ); // phpcs:ignore
			?>
		</style>
		<?php
	}
}

if ( ! function_exists( 'is_gutenverse_compatible' ) ) {
	/**
	 * Check if gutenverse is compatible.
	 */
	function is_gutenverse_compatible() {
		return defined( 'GUTENBERG_VERSION' ) || version_compare( $GLOBALS['wp_version'], '5.9', '>=' );
	}
}
