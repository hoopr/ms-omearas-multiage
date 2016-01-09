<?php

/*
Template Name: Parents Section
*/

/**
 * The template for displaying sub-level Kids subject pages.
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



/* =========================================================================
   The Parents Hero and Navigation
   ========================================================================= */

// Get Parent Hero first
$parent_hero_post = get_post(351);
$parent_hero_post_title = apply_filters('the_title', $parent_hero_post->post_title);
$parent_hero_post_content = apply_filters('the_content', $parent_hero_post->post_content);

// Split the hero post title at the pipe character
$parent_hero_post_title_parsed = explode('|', $parent_hero_post_title);

// Get the name of the hero post section and trim off whitespace
$parent_hero_post_section = trim($parent_hero_post_title_parsed[0]);

// If the split produced an array of more than 1 item, set the second to 
// the name of the parent hero post section
if (count($parent_hero_post_title_parsed) > 1) {
  $parent_hero_post_section = trim($parent_hero_post_title_parsed[1]);
}

?>

<!-- Output hero section with heading and content from post -->
<section class="hero hero--parents">
  <div class="hero__background" data-anchor-target=".hero" data-top="opacity: 1" data--400-top="opacity: 0">
    <div class="hero__text" data-anchor-target=".hero" data-top="opacity: 1" data--300-top="opacity: 0">

      <?php 

      echo '<h2>' . $parent_hero_post_section . '</h2>';
      echo '<br><br>';
      echo $parent_hero_post_content; 

      ?>
      
    </div>
  </div>
</section> 

<!-- Output parents navigation -->
<section class="parents grid-container">
  <div class="inner-container">
    <nav class="nav parents__nav">

      <?php
      
      wp_nav_menu( array('menu' => 'Parents Navigation' ));

      ?>

    </nav>
    <div class="accordion">

<?php



/* =========================================================================
   The Parents Section Loop
   ========================================================================= */

// Set the default ID to -1
$category_id = -1;

// Do a switch for the ID of the post
switch($post->ID) {

  // If the page is science (ID = 264), set category id to 13
  case 338: 
    $category_id = 19;
    break;

  // If the page is social studies (ID = 279), set the category id to 15
  case 362:
    $category_id = 20;
    break;

  // If the page is math (ID = 281), set the category id to 17
  case 342: 
    $category_id = 21;
    break;
}

// Get all posts under category correct 'Parents' category from switch
$args = array('category' => $category_id, 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1 );
$posts_array = get_posts($args); 

// For each parent post, get the title and content filtered
foreach ($posts_array as $parent_post) {
  $parent_post_title = apply_filters('the_title', $parent_post->post_title);
  $parent_post_content = apply_filters('the_content', $parent_post->post_content);

  // Split the post title at the pipe character
  $parent_post_title_parsed = explode('|', $parent_post_title);

  // Get the name of a parent post section and trim off whitespace
  $parent_post_section = trim($parent_post_title_parsed[0]);

  // If the split produced an array of more than 1 item, set the second to 
  // the name of the parent post section. If more than 2, 3rd item.
  if (count($parent_post_title_parsed) > 2) {
    $parent_post_section = trim($parent_post_title_parsed[2]);
  }
  else if (count($parent_post_title_parsed) > 1) {
    $parent_post_section = trim($parent_post_title_parsed[1]);
  }

      // Set the header of the accordion section as the subject
      echo '<h2>' . $parent_post_section . '</h2>';

      // Set the accordion content as the post contet
      echo '<div>' . $parent_post_content . '</div>';

// Close the foreach loop
}

?>

    <!-- Close the accordion -->
    </div>

  <!-- Close the inner container -->
  </div>

<!-- Close the section -->
</section>

<?php



/* =========================================================================
   Footer
   ========================================================================= */
get_footer();