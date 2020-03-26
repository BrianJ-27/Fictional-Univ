<?php

get_header();
pagesBanner(array(
  'title' => 'Our Campuses',
  'subtitle' => 'We have several conveniently located campuses.',
  'photo' => get_theme_file_uri('/images/campus-banner.jpg')
));?>

  <div class="container container--narrow page-section">

   <div class="acf-map"> 
        <?php
        while(have_posts()){
        the_post();
        $mapLocation = get_field('map_location'); ?>
        <div class="marker" data-lat="<?php echo $mapLocation['lat']?>" data-lng="<?php echo $mapLocation['lng'] ?>">
        <h3> <a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
        <?php echo $mapLocation['address'];?> 
        </div>  
        <?php } ?>
    </div>

    <div>
      <?php
        echo '<hr class="section-break">';
        echo '<h2 class="headline headline--medium">All Available Campuses to Attend</h2>';
        echo '<ul class="link-list min-list">';
         while(have_posts()){
          the_post(); 
          ?>
          <li>
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </li>
        <?php }
        echo '</ul>';
      ?>
    </div>

  </div>

<?php get_footer();

?>