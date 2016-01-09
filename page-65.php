<?php

/**
 * The template for displaying the home page.
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
   The Home Hero
   ========================================================================= */

// Get Parent Hero first
$home_hero_post = get_post(68);
$home_hero_post_title = apply_filters('the_title', $home_hero_post->post_title);
$home_hero_post_content = apply_filters('the_content', $home_hero_post->post_content);

// Split the hero post title at the pipe character
$home_hero_post_title_parsed = explode('|', $home_hero_post_title);

// Get the name of the hero post section and trim off whitespace
$home_hero_post_section = trim($home_hero_post_title_parsed[0]);

// If the split produced an array of more than 1 item, set the second to 
// the name of the parent hero post section
if (count($home_hero_post_title_parsed) > 1) {
  $home_hero_post_section = trim($home_hero_post_title_parsed[1]);
}

?>

<section class="hero hero--home">
  <div class="hero__background" data-anchor-target=".hero" data-top="opacity: 1" data--400-top="opacity: 0">
    <div class="hero__text" data-anchor-target=".hero" data-top="opacity: 1" data--300-top="opacity: 0">

      <?php 

      echo '<h2>' . $home_hero_post_section . '</h2>';
      echo '<br><br>';
      echo $home_hero_post_content; 

      ?>
      
    </div>
  </div>
</section> 

<?php

/* =========================================================================
   The Home Loop
   ========================================================================= */

// Get all posts under category 'Home' (id = 2)
$args = array('category' => 2, 'orderby' => 'date', 'order' => 'ASC', 'posts_per_page' => -1 );
$posts_array = get_posts($args); 

// For each home post, get the title and content filtered
foreach ($posts_array as $home_post) {
  $home_post_title = apply_filters('the_title', $home_post->post_title);
  $home_post_content = apply_filters('the_content', $home_post->post_content);

  // Split the post title at the pipe character
  $home_post_title_parsed = explode('|', $home_post_title);

  // Get the name of a home post section and trim off whitespace
  $home_post_section = trim($home_post_title_parsed[0]);

  // If the split produced an array of more than 1 item, set the second to 
  // the name of the home post section
  if (count($home_post_title_parsed) > 1) {
    $home_post_section = trim($home_post_title_parsed[1]);
  }

  // Make the name of the section lowercase and replace all spaces with
  // hyphens
  $home_post_section_lowercase = str_replace(' ', '-', strtolower($home_post_section));

?>

  <!-- Output each home section with class name of the lowercase, -->
  <!-- hyphenated section name, the title as header, and the content -->
  <section class="grid-container about about--<?php echo $home_post_section_lowercase ?>">
    <div class="inner-container">

      <?php 

      echo '<h2>' . $home_post_section . '</h2>';
      echo $home_post_content; 

      ?>

    </div>
  </section>

<?php
    
// Close the foreach loop
}


/* =========================================================================
   Footer
   ========================================================================= */
get_footer();