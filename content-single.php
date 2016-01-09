<?php
/**
 * @package msomearasmultiage
 */
?>

<article id="post-<?php the_ID(); ?>" class="grid-container blog blog__post--full" <?php post_class(); ?>>
	<div class="inner-container">

<?php 
	$blog_post_date = strtotime(get_the_date());
  $blog_post_day = date('j', $blog_post_date);
  $blog_post_month = date('M', $blog_post_date);
  $blog_post_year = date('Y', $blog_post_date);

	$blog_post_title = get_the_title();
	
	// Split the post title at the pipe character
  $blog_post_title_parsed = explode('|', $blog_post_title);

  // Get the name of a blog post section and trim off whitespace
  $blog_post_section = trim($blog_post_title_parsed[0]);

  // If the split produced an array of more than 1 item, set the second to 
  // the name of the blog post section
  if (count($blog_post_title_parsed) > 1) {
    $blog_post_section = trim($blog_post_title_parsed[1]);
  }



?>

    <div class="blog__post clearfix">
      <div class="blog__post__date--container">
        <div class="blog__post__date">

	        <?php 

	        echo '<span class="blog__post__day">' . $blog_post_day . '</span>';
	        echo '<span class="blog__post__month">' . $blog_post_month . '</span>';
	        echo '<span class="blog__post__year">' . $blog_post_year . '</span></div></div>';
	        echo '<h1 class="entry-title">' . $blog_post_section . '</h1>';

					the_content();

					wp_link_pages( array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'msomearasmultiage' ),
						'after'  => '</div>',
					) );

					?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">

			<?php 

			edit_post_link( __( 'Edit', 'msomearasmultiage' ), '<span class="edit-link">', '</span>' ); 

			?>

		</footer><!-- .entry-footer -->
	</div>
</article><!-- #post-## -->
