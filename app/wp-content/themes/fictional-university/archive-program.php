<?php

get_header();
pagesBanner(array(
  'title' => 'All Programs',
  'subtitle' => 'There is something for everyone. Have a look around.',
  'photo' => get_theme_file_uri('/images/programs-banner.jpg')
));?>

  <div class="container container--narrow page-section">
   <ul class="link-list min-list">
        <?php
        while(have_posts()){
        the_post(); ?>
        <li> <a href="<?php the_permalink();?>"><?php the_title();?></a></li>   
        <?php }
        echo paginate_links();
        ?>
    </ul>
     
  </div>

<?php get_footer();

?>