<?php

function university_post_types()
{
    
    //Program Post Type
    register_post_type('program', array(
        'supports' => array('title'),
        'public' => true,
        'labels' => array(
            'name' => 'Programs',
            'add_new_item' => 'Add New Program',
            'edit_item' => 'Edit Programs',
            'all-items' => 'All Programs',
            'singular_name' => 'Program',
        ),
        'menu_icon' => 'dashicons-awards',
        'has_archive' => true,
        'rewrite' => array('slug' => 'programs'),
    ));

    //Event Post Type
    register_post_type('event', array(
        // use this key value pair in conjuction with the User Role Editor by Members plugin
        'capability_type' => 'event',
        // this key value pair is essential to make the user permission active
        'map_meta_cap' => true,
        'supports' => array('title', 'editor', 'except'),
        'public' => true,
        'labels' => array(
            'name' => 'Events',
            'add_new_item' => 'Add New Event',
            'edit_item' => 'Edit Events',
            'all-items' => 'All Events',
            'singular_name' => 'Event',
        ),
        'menu_icon' => 'dashicons-calendar-alt',
        'has_archive' => true,
        'rewrite' => array('slug' => 'events'),
    ));

    //Professor Post Type
    register_post_type('professor', array(
        //the show_in_rest key needs to be set to the value of true in order to have this JSON data show up in the wordpress Rest API
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'public' => true,
        'labels' => array(
            'name' => 'Professors',
            'add_new_item' => 'Add New Professor',
            'edit_item' => 'Edit Professors',
            'all-items' => 'All Professors',
            'singular_name' => 'Professor',
        ),
        'menu_icon' => 'dashicons-welcome-learn-more',
    ));

    //Campus Post Type
    register_post_type('campus', array(
        // use this key value pair in conjuction with the User Role Editor by Members plugin
        'capability_type' => 'campus',
        // this key value pair is essential to make the user permission active
        'map_meta_cap' => true,
        'supports' => array('title', 'editor', 'excerpt'),
        'public' => true,
        'labels' => array(
            'name' => 'Campuses',
            'add_new_item' => 'Add New Campus',
            'edit_item' => 'Edit Campus',
            'all-items' => 'All Campuses',
            'singular_name' => 'Campus',
        ),
        'menu_icon' => 'dashicons-location-alt',
        'has_archive' => true,
        'rewrite' => array('slug' => 'campuses'),
    ));

    //Note Post Type
    register_post_type('note', array(
        //the show_in_rest key needs to be set to the value of true in order to have this JSON data show up in the wordpress Rest API
        'show_in_rest' => true,
        'capability_type' => 'note',
        'map_meta_cap' => true,
        'supports' => array('title', 'editor'),
        // set to false when user is logged in
        'public' => false,
        // show in the admin dash ui
        'show_ui' => true,
        'labels' => array(
            'name' => 'Notes',
            'add_new_item' => 'Add New Note',
            'edit_item' => 'Edit Note',
            'all-items' => 'All Notes',
            'singular_name' => 'Note',
        ),
        'menu_icon' => 'dashicons-welcome-write-blog',
    ));
    //Like Heart Post Type
    register_post_type('like', array(
        //the show_in_rest key needs to be set to the value of true in order to have this JSON data show up in the wordpress Rest API
        'supports' => array('title'),
        // set to false when user is logged in
        'public' => false,
        // show in the admin dash ui
        'show_ui' => true,
        'labels' => array(
            'name' => 'Likes',
            'add_new_item' => 'Add New Like',
            'edit_item' => 'Edit Like',
            'all-items' => 'All Likes',
            'singular_name' => 'Like',
        ),
        'menu_icon' => 'dashicons-heart',
    ));
}

add_action('init', 'university_post_types');
