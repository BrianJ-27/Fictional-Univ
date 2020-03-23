<?php
/**
 * This file is the for the main default search PAGE. 
 */

get_header();
pagesBanner(array(
  'title' => 'Search Results',
   // the php deals with malicious content being inputted 
  'subtitle' => 'You searched for &ldquo; ' . esc_html(get_search_query(false)) . ' &rdquo;'
));?>

  <div class="container container--narrow page-section">
    <?php
    if(have_posts()){
      while(have_posts()){
        the_post(); 
        get_template_part('template-parts/content', get_post_type());
       }
        echo paginate_links();
    } else {
      echo '<h2 class="headline headline--small-plus">No results match that search</h2>';
    }
   
    get_search_form();
    ?>

  </div>

<?php get_footer();

?>