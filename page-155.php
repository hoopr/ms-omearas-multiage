<?php

/**
 * The template for displaying the Kids top-level page.
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



<!-- ======================================================================
     The Kids Loop
     ====================================================================== -->

<!-- Output the kids section container -->
<section class="kids grid-container">
  <div class="inner-container inner-container--kids">

<?php 

// Get all pages withs 'Kids' as a parent page (id = 155)
$args = array('parent' => 155, 'sort_column' => 'menu_order', 'order' => 'ASC' );
$pages_array = get_pages($args); 

// For each page in the array, get the title and url filtered
foreach ($pages_array as $kids_page) {
  $kids_page_title = apply_filters('the_title', $kids_page->post_title);
  $kids_page_url = apply_filters('the_permalink', $kids_page->guid);

  // Split the title at the pipe character
  $kids_page_title_parsed = explode('|', $kids_page_title);

  // Set the name of a subject to first element in array without whitespace
  $kids_page_subject = trim($kids_page_title_parsed[0]);

  // If split produced an array longer than 1 item, set name of the subject
  // to the second item
  if (count($kids_page_title_parsed) > 1) {
    $kids_page_subject = trim($kids_page_title_parsed[1]);
  }

  // Convert the name to lowercase and replace whitespace with a hyphen
  $kids_page_subject_lowercase = str_replace(' ', '-', strtolower($kids_page_subject));

?>

    <!-- For each subject, output a button with the permalink, title, -->
    <!-- appropriate subject as a class and subject name as the header -->
    <div class="button subject subject--<?php echo $kids_page_subject_lowercase ?> grid-50 tablet-grid-50 mobile-grid-100">
      <a href="<?php echo $kids_page_url ?>" title="<?php echo $kids_page_subject ?>">

        <?php 

        echo '<span><h2>' . $kids_page_subject . '</h2></span>';

        ?>

      </a>
    </div>

<?php

// Close the foreach loop
}

?>

  <!-- Close the inner container -->
  </div>

<!-- Close the section -->
</section>

<?php



/* =========================================================================
   Footer
   ========================================================================= */
get_footer();