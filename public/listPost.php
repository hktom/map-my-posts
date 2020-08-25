<?php
// List Post Query
function listPost(){
    // The Query
$the_query = new WP_Query( array( 'post_type' => 'createur' ) );
 
// The Loop
if ( $the_query->have_posts() ) {
    echo '<ul>';
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        echo '<li>' . get_the_title() . '</li>';
        echo '<li>' . get_post_meta(get_the_ID(), '_adresse', true) . '</li>';
    }
    echo '</ul>';
} else {
    // no posts found
}
/* Restore original Post Data */
wp_reset_postdata();
}