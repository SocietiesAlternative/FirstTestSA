<?php
require_once('aq_resizer.php');
/**
 * Blocks Initializer
 *
 * Enqueue CSS/JS of all the blocks.
 *
 * @since   1.0.0
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue Gutenberg block assets for both frontend + backend.
 *
 * `wp-blocks`: includes block type registration and related functions.
 *
 * @since 1.0.0
 */
function my_block_cgb_block_assets() {
	// Styles.
	wp_enqueue_style(
		'posts-masonry-block-style-css', // Handle.
		plugins_url( 'dist/blocks.style.build.css', dirname( __FILE__ ) ) // Block style CSS.
		// array( 'wp-blocks' ) // Dependency to include the CSS after it.
		// filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.style.build.css' ) // Version: filemtime — Gets file modification time.
	);
	if(!is_admin()){
		wp_enqueue_script(
			'posts-masonry-block-masnory', // Handle.
			plugins_url( '/src/js/isotope.pkgd.min.js', dirname( __FILE__ ) ), // Block.build.js: We register the block here. Built with Webpack.
			array( 'jquery' ), // Dependencies, defined above.
			// filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: filemtime — Gets file modification time.
			true // Enqueue the script in the footer.
		);
		wp_enqueue_script(
			'posts-masonry-block-lazy-loaded', // Handle.
			plugins_url( '/src/js/jquery.lazy.min.js', dirname( __FILE__ ) ), // Block.build.js: We register the block here. Built with Webpack.
			array( 'wp-blocks', 'wp-i18n', 'wp-element','posts-masonry-block-masnory', 'jquery' ), // Dependencies, defined above.
			// filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: filemtime — Gets file modification time.
			true // Enqueue the script in the footer.
		);
		wp_enqueue_script(
			'posts-masonry-block-imagesloaded-load', // Handle.
			plugins_url( '/src/js/imagesloaded.pkgd.min.js', dirname( __FILE__ ) ), // Block.build.js: We register the block here. Built with Webpack.
			array( 'wp-blocks', 'wp-i18n', 'wp-element','posts-masonry-block-masnory', 'jquery' ), // Dependencies, defined above.
			// filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: filemtime — Gets file modification time.
			true // Enqueue the script in the footer.
		);
	
		wp_enqueue_script(
			'posts-masonry-block-masnory-load', // Handle.
			plugins_url( 'src/js/masnory.js', dirname( __FILE__ ) ), // Block.build.js: We register the block here. Built with Webpack.
			array( 'wp-blocks', 'wp-i18n', 'wp-element','posts-masonry-block-imagesloaded-load', 'jquery' ), // Dependencies, defined above.
			// filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: filemtime — Gets file modification time.
			true // Enqueue the script in the footer.
		);
	}
	
	
} // End function my_block_cgb_block_assets().

// Hook: Frontend assets.
add_action( 'enqueue_block_assets', 'my_block_cgb_block_assets' );

/**
 * Enqueue Gutenberg block assets for backend editor.
 *
 * `wp-blocks`: includes block type registration and related functions.
 * `wp-element`: includes the WordPress Element abstraction for describing the structure of your blocks.
 * `wp-i18n`: To internationalize the block's text.
 *
 * @since 1.0.0
 */
function my_block_cgb_editor_assets() {
	// Scripts.
	wp_enqueue_script(
		'posts-masonry-block-js', // Handle.
		plugins_url( '/dist/blocks.build.js', dirname( __FILE__ ) ), // Block.build.js: We register the block here. Built with Webpack.
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ), // Dependencies, defined above.
		// filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: filemtime — Gets file modification time.
		true // Enqueue the script in the footer.
	);

	// WP Localized globals. Use dynamic PHP stuff in JavaScript via `LoaderImg` object.
	wp_localize_script(
		'posts-masonry-block-js',
		'LoaderImg', // Array containing dynamic data for a JS Global.
		[
			'loader' => plugins_url( 'loader.png', __FILE__ ),
		]
	);


	// Styles.
	wp_enqueue_style(
		'posts-masonry-block-editor-css', // Handle.
		plugins_url( 'dist/blocks.editor.build.css', dirname( __FILE__ ) ), // Block editor CSS.
		array( 'wp-edit-blocks' ) // Dependency to include the CSS after it.
		// filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.editor.build.css' ) // Version: filemtime — Gets file modification time.
	);
} // End function my_block_cgb_editor_assets().

// Hook: Editor assets.
add_action( 'enqueue_block_editor_assets', 'my_block_cgb_editor_assets' );

//render all the posts 
function masnory_gallery_render_block_latest_post( $attributes, $content ) {
	if ( is_admin() ) {
        return false;
    }
	$categoriesButton = "";
	$categories = get_categories(array(
		'taxonomy' => 'category',
		'term_taxonomy_id'   => $attributes['categories']
	));
	if($attributes['showNavigation']){
		$categoriesButton .= "<div class='gosign_categories_filters'><a href='#' data-filter='*' class='gosign_filter gosign_sort_all_button active'><span class='inner_sort_button'>All</span></a><span class='text-sep'>/</span>";
		foreach($categories as $cat){
			$categoriesButton .= "<a href='#' data-filter='.gosign_sort_{$cat->slug}' class='gosign_filter gosign_sort_{$cat->slug}_button'><span class='inner_sort_button'>{$cat->name}</span></a><span class='text-sep'>/</span>";
		}
		$categoriesButton .= "</div>";
	}
	//for linked tags of post
	$tags = get_tags(array(
		'hide_empty' => false
	));
	
	$blockId = $attributes['blockId'];
	$postsToShow = $attributes['postsToShow'] ? $attributes['postsToShow'] : 10;
	$postsToShowStart = $attributes['postsToShowStart'] ? $attributes['postsToShowStart'] : 1;
	$gutter = $attributes['verticalSpacing'] ? $attributes['verticalSpacing'] : 0 ;
	$horizontalSpacing = $attributes['horizontalSpacing'] ? $attributes['horizontalSpacing'] : 0 ;
	$columnCount = $attributes['columnCount'] ? $attributes['columnCount'] : 3;
	$columnCountDesk = $attributes['columnCountDesk'] ? $attributes['columnCountDesk'] : 3;
	$columnCountMob = $attributes['columnCountMob'] ? $attributes['columnCountMob'] : 3;
	$columnCountTab = $attributes['columnCountTab'] ? $attributes['columnCountTab'] : 3;
	$enableEnimation = $attributes['enableAnimation'] ? "box4" : '';
	$layout = $attributes['galleryLayout'] ? $attributes['galleryLayout'] : 'masonry';
	$readMoreText = $attributes['readMoreText'] ? $attributes['readMoreText'] : "Read More";
	$responsiveSettings = $attributes['responsiveSettings'] ? $attributes['responsiveSettings'] : false ;
	$align = $attributes['align'] ? $attributes['align'] : 'full';
	$firstFullWidth = $attributes["firstFullWidth"] ? $attributes["firstFullWidth"] : false;
	$firstFullWidthLayout = $attributes["firstFullWidthLayout"] ? $attributes["firstFullWidthLayout"] : 'twoEqualBottom';
	$firstFullWidthLayoutGap = $attributes["firstFullWidthLayoutGap"] ? $attributes["firstFullWidthLayoutGap"] : 0;
	$commentCount = $attributes["displayCommentsCount"] ? $attributes["displayCommentsCount"] : false;
	$postsToShowRandom = $attributes["postsToShowRandom"] ? $attributes["postsToShowRandom"] : false;

	if($attributes['galleryLayout'] == "detail_layout_grid" || $attributes['galleryLayout'] == "detail_layout"){
		$layout = "fitRows";
	}else if ($attributes['galleryLayout'] == "detail_layout_masonry"){
		$layout = "masonry";
	} else if ($attributes['galleryLayout'] == "detail_layout"){
		$layout = "fitRows";
	}

	if($attributes["stickyPosts"] && !$postsToShowRandom) {
		$sticky = get_option( 'sticky_posts' );
	
		$normal_posts = get_posts( array(
			'post_status' => 'publish',
			'post_type' => 'post',
			'numberposts' => $postsToShow,
			'orderby' => 'post_date',
			'category' => $attributes['categories'],
			'orderby' => $attributes['orderBy'] ? $attributes['orderBy'] : '',
			'order' => $attributes['order'] ? $attributes['order'] : '',
			'post__not_in' => $sticky	
		) );

		$sticky_posts = get_posts( array(
			'post_status' => 'publish',
			'post_type' => 'post',
			'numberposts' => $postsToShow,
			'orderby' => 'post_date',
			'category' => $attributes['categories'],
			'orderby' => $attributes['orderBy'] ? $attributes['orderBy'] : '',
			'order' => $attributes['order'] ? $attributes['order'] : '',
			'post__in' => $sticky,
		) );

		$normal_posts = array_merge($sticky_posts, $normal_posts);
		$recent_posts = array_slice($normal_posts, 0, $postsToShow);

	}else {
		$recent_posts = get_posts( array(
			'post_status' => 'publish',
			'post_type' => 'post',
			'numberposts' => $postsToShow,
			'orderby' => 'post_date',
			'category' => $attributes['categories'],
			'orderby' => $attributes['orderBy'] ? $attributes['orderBy'] : '',
			'order' => $attributes['order'] ? $attributes['order'] : '',
		) );
		if($postsToShowRandom) {
			//$total_posts_in_num = $postsToShow - $postsToShowStart;
			$recent_posts = array_slice($recent_posts, $postsToShowStart - 1, $postsToShow ); 
		}
	}
	
    if ( count( $recent_posts ) === 0 ) {
        return 'No posts';
	}

	$imageGutter = $gutter*2;
	
	$post_data = "<style>";
	if($gutter >= 0){
		if($responsiveSettings){
			$imageGutter = $gutter;
			$imageGutterDesk = $gutter;
			$imageGutterTab = $gutter;
			$imageGutterMob = $gutter;
			if($columnCount > 1){
				$imageGutter = $gutter*($columnCount-1);
			}else {
				$imageGutter = 0;
			}
			if($columnCountDesk > 1){
				$imageGutterDesk = $gutter*($columnCountDesk-1);
			}else {
				$imageGutterDesk = 0;
			}
			
			if($columnCountTab > 1){
				$imageGutterTab = $gutter*($columnCountTab-1);
			}else {
				$imageGutterTab = 0;
			}
			if($columnCountMob > 1){
				$imageGutterMob = $gutter*($columnCountMob-1);
			}else {
				$imageGutterMob = 0;
			}

			$post_data .= " #{$blockId} .grid-sizer, #{$blockId} .grid-item { width: calc( (100% - {$imageGutter}px)/{$columnCount}); margin-bottom: {$horizontalSpacing}px; } @media (max-width: 1280px){ #{$blockId} .grid-sizer, #{$blockId} .grid-item { width: calc( (100% - {$imageGutterDesk}px)/{$columnCountDesk}); }} @media (max-width: 1024px){ #{$blockId} .grid-sizer, #{$blockId} .grid-item { width: calc( (100% - {$imageGutterTab}px)/{$columnCountTab}); }} @media (max-width: 767px){ #{$blockId} .grid-sizer, #{$blockId} .grid-item { width: calc( (100% - {$imageGutterMob}px)/{$columnCountMob}); }}";

		} else {
			$imageGutter = $gutter;
			if($columnCount > 1){
				$imageGutter = $gutter*($columnCount-1);
			}
			$post_data .= " #{$blockId} .grid-sizer, #{$blockId} .grid-item { width: calc( (100% - {$imageGutter}px)/{$columnCount}); margin-bottom: {$horizontalSpacing}px; } @media (max-width: 767px){ #{$blockId} .grid-sizer, #{$blockId} .grid-item { width: 100%; }}";
		}
	
	}
	if($firstFullWidth) {
		$post_data .= "@media (min-width: 767px){#{$blockId} .grid-item.grid-item--firstFullWidth{width: 100%} #{$blockId} .grid-item.grid-item--firstFullWidth img{height: 350px} #{$blockId} .grid-item.grid-item--firstFullWidth .masnory-image-container{height: 350px} #{$blockId} .grid-item.grid-item--firstFullWidth.twoEqual .masnory-image-container{margin-right: {$firstFullWidthLayoutGap}px} #{$blockId} .grid-item.grid-item--firstFullWidth.twoLeftWide .masnory-image-container{margin-right: {$firstFullWidthLayoutGap}px} #{$blockId} .grid-item.grid-item--firstFullWidth.twoRightWide .masnory-image-container{margin-right: {$firstFullWidthLayoutGap}px}}";
	}
	$post_data .= "</style>";
	$post_data .="<div id={$blockId} class='wp-block-gosign {$attributes["className"]}'>{$categoriesButton}<div data-gutter='{$gutter}' data-layout='{$layout}' data-lazyThreshold='{$attributes["lazyThreshold"]}' class='grid-parent-gosign ".$attributes['galleryLayout']." gallery-frontend {$align}'><div class='grid-sizer'></div>";
	$categoriesButton = "";

	foreach($recent_posts as  $key => $post){
		$postCategories = wp_get_post_categories($post->ID);
		$postTags = wp_get_post_tags($post->ID, array( 'fields' => 'ids' ));
		$catClasses = "";
		$firstFullWidthClass= "";
		$post_linked_category = "";
		$post_linked_tag = "";

		if($key==0 && $firstFullWidth) {
			$firstFullWidthClass = "grid-item--firstFullWidth " . $firstFullWidthLayout;
		}
		//related categories for posts
		foreach($categories as $category){
			if(in_array($category->cat_ID, $postCategories)){
				$catClasses .= " gosign_sort_".$category->slug;
				$post_linked_category .= '<a href="'.esc_url(get_category_link($category->cat_ID) ).'" title="'.esc_attr($category->name).'">'.$category->name.'</a>';
			}
		}
		//related tags for posts. $tags is define above Line:116.
		foreach($tags as $tag){
			if(in_array($tag->term_id, $postTags)){
				$post_linked_tag .= '<a href="'.esc_url(get_category_link($tag->term_id) ).'" title="'.esc_attr($tag->name).'">'.$tag->name.'</a>';
			}
		}
		
		$attachment_id = get_post_thumbnail_id($post->ID);
		$url = wp_get_attachment_full_url($attachment_id);

		$large = wp_get_attachment_image_src($attachment_id, 'large');
		$medium_large = wp_get_attachment_image_src($attachment_id, 'medium_large');
		$medium = wp_get_attachment_image_src($attachment_id, 'medium');
		$mobile = aq_resize($url, 600);
		$mobile = $mobile != NULL ? $mobile : $url;
		$placeholder = aq_resize($url, 125);
		$placeholder = $placeholder != NULL ? $placeholder : $url;

		// $url = wp_get_attachment_url( $attachment_id, 'thumbnail' );
		$link = esc_url(get_permalink($post->ID));
		$attachment_alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );
		$attachment_title = get_the_title($attachment_id);
		$key +=1;
		$lazyEnabled = ($attributes["lazyLoading"] ? "data-src" : "src");
		$lazySrcset = ($attributes["lazyLoading"] ? "data-srcset" : "srcset");
		$lazySizes = ($attributes["lazyLoading"] ? "data-sizes" : "sizes");
		$lazyBlur = ($attributes["lazyLoading"] ? "masLazy" : "");
		//$tempSrc = "src='" . get_site_url() . "/wp-content/plugins/gosign-masonry-post-block/src/loader.png'";
		$post_data .= 
		"<div class='grid-item {$catClasses} grid-item-{$key} {$firstFullWidthClass}' key={$post->ID} >";
		if(strpos($attributes['galleryLayout'],"detail_layout") !== FALSE){
			$post_data .= "<div class='gallery-image'>";
			$post_data .= "<div class='masnory-image-container'><a href={$link}><img class='masnory-image {$lazyBlur}' title='{$attachment_title}' alt='{$attachment_alt}' src='{$placeholder}' {$lazyEnabled}='{$medium[0]}' $lazySrcset='{$medium[0]} 300w, {$mobile} 600w, {$medium_large[0]} 768w, {$large[0]} 1024w' {$lazySizes}='(min-width: 1280px) 33.3vw, (min-width: 768px) 50vw, 100vw' /></a></div>";
			$post_data .= "<div class='box-content'>";
			$post_data .= "<h3 class='title'>";
			$post_data .= "<a href={$link}>{$post->post_title}</a>";
			$post_data .= "</h3>";
			
			$post_data .= "<div class='author-and-date'>";
			if($attributes['displayAuthor']){
				$userInfo = get_user_by("ID",$post->post_author);
				if($userInfo){
					$post_data .= "<a href='{$userInfo->user_url}'>";
					$post_data .= "<span>{$userInfo->display_name}</span>";
					$post_data .= "</a>";
				}
			}
			
			if($attributes['displayPostDate']){
				$post_data .=  "<span>";
				if($attributes['displayAuthor']){
					$post_data .=  " <span class='dot-before'>.</span> ";
				}
				$post_data .= sprintf(
					'<time datetime="%1$s" class="post-date">%2$s</time>',
					esc_attr( get_the_date( 'c', $post->ID ) ),
					esc_html( get_the_date( '', $post->ID ) )
				);
				$post_data .= "</span>";
			}
			if($commentCount && $post->comment_count > 0){
				$post_data .=  "<span class='comments-count'> <span class='dot-before'>.</span> ";
				$post_data .=  "<span class='dashicons dashicons-admin-comments'></span>";
				$post_data .= $post->comment_count;
				$post_data .= "</span>";
			}
			$post_data .= "</div>";
			if($attributes['displayPostExcerpt']){
				// Get the excerpt
				$excerpt = apply_filters( 'the_excerpt', get_post_field( 'post_excerpt', $post->ID, 'display' ) );

				if( empty( $excerpt ) ) {
					$excerpt = apply_filters( 'the_excerpt', wp_trim_words( $post->post_content, 55 ) );
				}

				if ( ! $excerpt ) {
					$excerpt = null;
				}
				$post_data .= "<p>".strip_tags($excerpt)."<a href={$link} class='readmore'>{$readMoreText}</a></p>";
			}

			//related categories for posts.
			if($attributes['displayLinkedCategories'] && $post_linked_category != ""){
				$post_data .="<div class='masnory-category-post categories'>". $post_linked_category ."</div>";
			}
			//related tags for posts.
			if($attributes['displayLinkedTags'] && $post_linked_tag != ""){
				$post_data .="<div class='masnory-category-post tags'>". $post_linked_tag ."</div>";
			}

			// if($attributes['displayCountReading']){
			// 	$post_data .= "<a href={$link} class='readmore'>{$readMoreText}</a>";
			// }

			$post_data .= "</div>";
			$post_data .= "</div>";
		} else {
			$lazyEnabled = ($attributes["lazyLoading"] ? "data-src" : "src");
			$tempSrc = "src='" . get_site_url() . "/wp-content/plugins/gosign-masonry-post-block/src/loader.png'";
			$post_data .= "
			<div class='gallery-image {$enableEnimation}' style='padding-top: calc( {$large[2]} / {$large[1]} * 100% )'>
			<img class='masnory-image {$lazyBlur}' title='{$attachment_title}' alt='{$attachment_alt}' src='{$placeholder}' {$lazyEnabled}='{$medium[0]}' $lazySrcset='{$medium[0]} 300w, {$mobile} 600w, {$medium_large[0]} 768w, {$large[0]} 1024w' {$lazySizes}='(min-width: 1280px) 33.3vw, (min-width: 768px) 50vw, 100vw' />
			<div class='box-content'>
			<a href={$link}>
			<h3 class='title'>
			{$post->post_title}
			</h3>
			</a>
			</div>	
			</div>
			";
		}
		$post_data .= "</div>";
		
	}
	$post_data .= "</div>";
	// $post_data .= "</div></div>";
	return $post_data;
}

function wp_get_attachment_full_url( $id )
{
    $large_array = image_downsize( $id, 'full' );
    $large_path = $large_array[0];
	if($large_path == null){
		$large_path = wp_get_attachment_url( $id, 'thumbnail' );
	}
    return $large_path;
}


/**
 * Register action after all plugins have loaded
 * 
 */
function registerBlockType(){
	if (function_exists("register_block_type")) {
		register_block_type( 'gosign/posts-masonry-block', array(
			'render_callback' => 'masnory_gallery_render_block_latest_post',
		) );
	}
}

add_action( 'plugins_loaded', 'registerBlockType' );