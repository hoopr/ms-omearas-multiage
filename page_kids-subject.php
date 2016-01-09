<?php

/*
Template Name: Kids Subject
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
   Current Post Information
   ========================================================================= */

// Get the post title for the current page
$post_title = $post->post_title;

// Split the current post title at the pipe character
$post_title_parsed = explode('|', $post_title);

// Set the current title to the first element in the split array
$this_title = trim($post_title_parsed[0]);

// If the split array is more than 1 item, set the current title
// to the second item
if (count($post_title_parsed) > 1) {
  $this_title = trim($post_title_parsed[1]);
}

// Convert the current title to lowercase and whitespaces to hyphens
$this_title_lowercase = str_replace(' ', '-', strtolower($this_title));

?>



<!-- ======================================================================
     The Kids Navigation Loop
     ====================================================================== -->
     
<!-- Output the kids subject section container with the appropriate -->
<!-- subject as a class -->
<section class="kids kids--<?php echo $this_title_lowercase ?> grid-container">
  <div class="inner-container">
    <nav class="kids__nav">

<?php

// Get all pages with the 'Kids' page as a parent (id = 155)
$args = array('parent' => 155, 'orderby' => 'menu_order', 'order' => 'ASC' );
$pages_array = get_pages($args); 

// For each page in the array, get  title and url filtered
foreach ($pages_array as $kids_page) {
  $kids_page_title = apply_filters('the_title', $kids_page->post_title);
  $kids_page_url = apply_filters('the_permalink', $kids_page->guid);

  // Split the page title at the pipe character
  $kids_page_title_parsed = explode('|', $kids_page_title);

  // Set the subject name to the first item in the array without whitespace
  $kids_page_subject = trim($kids_page_title_parsed[0]);

  // If the array is longer than 1 item, set the subject name to the second
  if (count($kids_page_title_parsed) > 1) {
    $kids_page_subject = trim($kids_page_title_parsed[1]);
  }

  // Make the subject name lowercase and replace whitespace with hyphens
  $kids_page_subject_lowercase = str_replace(' ', '-', strtolower($kids_page_subject));

?>

      <!-- Output the Kids navigation button for each subject with the -->
      <!-- appropriate subject name as a class and the permalink -->
      <div class="button subject subject--<?php echo $kids_page_subject_lowercase ?>">
        <a href="<?php echo $kids_page_url ?>" title="<?php echo $kids_page_subject ?>"><span><h2></h2></span></a>
      </div>

<?php 

  // Close the foreach loop
  }

?>
    
    <!-- Close the kids nav -->
    </nav>



<!-- ======================================================================
     The Kids Subject Loop
     ====================================================================== -->

    <?php 

    echo '<h1>' . $this_title . '</h1>';

    ?>

    <!-- Open an accordion div for this page -->
    <div class="accordion">

<?php

// Set the default ID to -1
$category_id = -1;

// Do a switch for the ID of the post
switch($post->ID) {

  // If the page is science (ID = 264), set category id to 13
  case 264: 
    $category_id = 13;
    break;

  // If the page is social studies (ID = 279), set the category id to 15
  case 279:
    $category_id = 15;
    break;

  // If the page is math (ID = 281), set the category id to 17
  case 281: 
    $category_id = 17;
    break;

  // If the page is language arts (ID = 283), set the category id to 16
  case 283: 
    $category_id = 16;
    break;
}

// Get all posts for the appropriate category set above in the switch
$params = array('category' => $category_id, 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1 );
$posts_array = get_posts($params);

// For each post, get the title and content filtered
foreach ($posts_array as $kids_post) {
  $kids_post_title = apply_filters('the_title', $kids_post->post_title);
  $kids_post_content = apply_filters('the_content', $kids_post->post_content);

  // Split the title at the pipe character
  $kids_post_title_parsed = explode('|', $kids_post_title);

  // Set the subject to the first element of the split array
  $kids_post_subject = trim($kids_post_title_parsed[0]);

  // If the array is longer than 2 elements, make the subject to the third
  if (count($kids_post_title_parsed) > 2) {
    $kids_post_subject = trim($kids_post_title_parsed[2]);
  } 

      // Set the header of the accordion section as the subject
      echo '<h2>' . $kids_post_subject . '</h2>';

      // Set the accordion content as the post contet
      echo '<div>' . $kids_post_content . '</div>';

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
   Header
   ========================================================================= */
get_footer();