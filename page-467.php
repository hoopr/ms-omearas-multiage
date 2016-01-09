<?php

/**
 * The template for displaying the blog page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package msomearasmultiage
 */



/* =========================================================================
   Header
   ========================================================================= */
get_header(); 

?>

<!-- Output blog section and inner container -->
<section class="grid-container blog">
  <div class="inner-container">

<?php

/* =========================================================================
   The Blog Loop
   ========================================================================= */

// Get all posts under category 'Blog' (id = 23)
$args = array('category' => 23, 'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => 10 );
$posts_array = get_posts($args); 

// For each blog post, get the date, title, content, and url filtered
foreach ($posts_array as $blog_post) {
  $blog_post_date = strtotime(apply_filters('the_date', $blog_post->post_date));
  $blog_post_day = date('j', $blog_post_date);
  $blog_post_month = date('M', $blog_post_date);
  $blog_post_year = date('Y', $blog_post_date);
  $blog_post_title = apply_filters('the_title', $blog_post->post_title);
  $blog_post_content = wp_trim_words(apply_filters('the_content', $blog_post->post_content), 50);
  $blog_post_url = apply_filters('the_permalink', $blog_post->guid);

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

  <!-- Output each blog post with the date, title, and content -->
    <div class="blog__post clearfix">
      <div class="blog__post__date--container">
        <div class="blog__post__date">

        <?php 

        echo '<span class="blog__post__day">' . $blog_post_day . '</span>';
        echo '<span class="blog__post__month">' . $blog_post_month . '</span>';
        echo '<span class="blog__post__year">' . $blog_post_year . '</span></div></div>';
        echo '<h2><a href="' . $blog_post_url . '">' . $blog_post_section . '</a></h2>';
        echo $blog_post_content; 

        ?>

    </div>

<?php
    
// Close the foreach loop
}

?>

  </div>
</section>

<?php



/* =========================================================================
   Footer
   ========================================================================= */
get_footer();