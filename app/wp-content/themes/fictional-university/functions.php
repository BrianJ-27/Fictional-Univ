<?php
// This require command is a way of keeping your code organized. You can place code into different files for readability Similiar to the "import" keyword in Sass
require get_theme_file_path('/inc/like-route.php');
require get_theme_file_path('/inc/search-route.php');




// customize the existing rest API
// We can modify existing worpress rest API
function university_custom_rest(){
    // 1) 1st argument is the post type you want to customize
    // 2) 2nd argument is whatever name you want to call it
    // 3) 3rd is an associative array that only needs one item
    register_rest_field('post','authorName', array(
        'get_callback' => function(){
           return  get_the_author(); 
        }
    ));
    register_rest_field('note','userNoteCount', array(
        'get_callback' => function(){
           return  count_user_posts(get_current_user_id(), 'note'); 
        }
    ));
    // can create as many of these as i want
}

add_action('rest_api_init', 'university_custom_rest');

// Create a reusable function for the page banner across all pages
function pagesBanner($args = null)
{
    //php logic will live here
    if(!$args['title']){
        $args['title'] = get_the_title();
    }
    if(!$args['subtitle']){
        $args['subtitle'] = get_field('page_banner_subtitle');
    }
    if(!$args['photo']){
       if(get_field('page_banner_background_image')){
        $args['photo'] = get_field('page_banner_background_image') ['sizes']['pageBanner'];
       } else{
        $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
       }
    }

    ?>
     <!--HTML Code lives here-->
    <div class="page-banner">
        <div class="page-banner__bg-image"
        style="background-image: url(<?php echo $args['photo']?>);">
        </div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"><?php echo $args['title']?></h1>
            <div class="page-banner__intro">
                <p><?php echo $args['subtitle']?></p>
            </div>
        </div>
    </div>
    <?php
}
// end of reusable function....


/*this is how to add style.css stylesheet and we can also add javascript files inside this function
First we create a function and name it whatever we want but its relevant to the website we are making
secondly inside the function, we call a wordpress function that points to the css file we want to load
Third, we use the wordpress add_action function to call the function i created.
The add_action() function accepts 2 arguments (1st argument 'wp_enqueue_scripts', 2nd argument 'function right above it')
 */
function abjFiles()
{
    wp_enqueue_script('googleMap', '//maps.googleapis.com/maps/api/js?key=AIzaSyB-QY2pMeo0pRejSb1lMPwy6WyCpj4Jkcc', null, microtime(), true);
    //avoiding caching in css & js in the first statement
    wp_enqueue_script('main-univ-js', get_theme_file_uri('/js/scripts-bundled.js'), null, microtime(), true);
    wp_enqueue_style('google-font', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('site_main_styles', get_stylesheet_uri());
    
    // by using the 2nd argument of "univData" can be used in the search.js -> getResults ()
    //To make url more flexible and relative
    wp_localize_script('main-univ-js', 'univData', array(
        'root_url' => get_site_url(),
        'nonce' => wp_create_nonce('wp_rest')
      ));


}
//This function tells wordpress to add all additional stylesheets and scripts to my website
add_action('wp_enqueue_scripts', 'abjFiles');

function university_features()
{
    //This WP function allows us to add dynamic navigational menus through WP admin menu panel
    // register_nav_menu('headerMenuLocation', 'Header Menu Location');
    // register_nav_menu('footerLocationOne', 'Footer Location One');
    // register_nav_menu('footerLocationTwo', 'Footer Location Two');
    add_theme_support('title-tag');
    //this function will enable featured images for blog posts
    add_theme_support('post-thumbnails');
    //this function will add a custom landscape image size to uploads /image folder
    add_image_size('professorLandscape', 400, 260, true);
    //this function will add a custom portrait image size to uploads /image folder
    add_image_size('professorPortrait', 480, 650, true);
    //this function will add a custom page banner image size to uploads /image folder
    add_image_size('pageBanner', 1500, 350, true);
}

//This function tells Wordpress to add dynamic menus and menu locations
add_action('after_setup_theme', 'university_features');

//Wordpress will call this function and will pass the query object into this function so we can manipulate it
//This function is designed to manipulate a particualr default query in our site
function university_adjust_queries($query)
{
    if (!is_admin() and is_post_type_archive('campus') and $query->is_main_query()) {
        $query->set('posts_per_page', -1);
    }
    if (!is_admin() and is_post_type_archive('program') and $query->is_main_query()) {
        $query->set('posts_per_page', -1);
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
    }

    if (!is_admin() and is_post_type_archive('event') and $query->is_main_query()) {
        $today = date('Ymd');
        $query->set('meta_key', 'event_date');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        $query->set('meta_query', array(
            array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' => $today,
                'type' => 'numeric',
            ),
        )
        );
    }
}

add_action('pre_get_posts', 'university_adjust_queries');

function universityMapKey($api){
    $api['key'] = 'AIzaSyB-QY2pMeo0pRejSb1lMPwy6WyCpj4Jkcc';
    return $api;
}

add_filter('acf/fields/google_map/api', 'universityMapKey');

// Redirect subscriber account out of admin and onto homepage
add_action('admin_init', 'redirectSubsToFrontend');

function redirectSubsToFrontend () {
    
    $ourCurrentUser = wp_get_current_user();
    // looks inside the roles array which is why we need the count method for arrays
    // checks if user is a subscriber
    if(count($ourCurrentUser->roles) ==1 AND $ourCurrentUser->roles[0] == 'subscriber' ){
        wp_redirect(site_url('/'));
        // exit keyword tells Wordpress to stop spinning its gears and end execution 
        exit;
    }
}

// Remove admin bar so subscribers don't see it
add_action('wp_loaded', 'noSubsAdminBar');

function noSubsAdminBar () {
    
    $ourCurrentUser = wp_get_current_user();
    // looks inside the roles array which is why we need the count method for arrays
    // checks if user is a subscriber
    if(count($ourCurrentUser->roles) ==1 AND $ourCurrentUser->roles[0] == 'subscriber' ){
        show_admin_bar(false);
    }
}

// Customize Login Screen
add_filter('login_headerurl', 'ourHeaderUrl');

function ourHeaderUrl(){
    // on the login/logout screen the wordpress icon will direct us to our site
    return esc_url(site_url('/'));
}

// This will allow us to customize the login screen 
add_action('login_head', 'ourLoginCSS');

function ourLoginCSS() {
   echo '<style>
    body {
        background-image: url("./wp-content/uploads/2020/03/login-stack-of-books-1-scaled.jpg");
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        font-family: Verdana, Arial;
    }

    .login h1 a{
        display: none;
    }

    .login form{
         box-shadow: 1px 1px 20px 3px rgba(0,0,0,0.75);
    }

     .login form,
     .login .message{
        background: rgba( 255,255,255, 0.15 );
    }

    .login form .input, .login input[type=password], .login input[type=text], .login .forgetmenot input[type=checkbox]{
        background: rgba(0,0,0,0);
    }
   </style>';
}

// change the title info in our login/ logout
add_filter('login_headertitle', 'ourLoginTitle');
function ourLoginTitle(){
    return get_bloginfo('name');
}

// Force created note posts to be private on the backend
// This filter intercepts data before going into the wordpress database
// The 3rd parameter is to assign a priority number
// The 4th parameter is to give the makeNotePrivate  function the ability to accept 2 parameters because functions only accept 1 parameter by default
add_filter('wp_insert_post_data', 'makeNotePrivate', 10, 2);

function makeNotePrivate ($data, $postarr) {
    // Additional security for title and content field areas.
    if( $data['post_type'] =='note') {
        // will return a number of how many note post they already created 
        if (count_user_posts(get_current_user_id(), 'note') > 4 AND !$postarr['ID'] ) {
            // completely exits or cancels requests
            die('You have reached your note limit.');
        }
        $data['post_content'] = sanitize_textarea_field($data['post_content']);
        $data['post_title'] = sanitize_text_field($data['post_title']);
    }

    if($data['post_type'] == 'note' AND $data['post_status'] != 'trash'){
        $data['post_status'] = 'private';  
    }
    return $data;
}
