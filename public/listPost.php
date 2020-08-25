<?php
// List Post Query
function listPost(){
    // The Query
$the_query = new WP_Query( array( 'post_type' => 'createur' ) );
 
// The Loop
if ( $the_query->have_posts() ) {
    $i=0;
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        echo "<input type='hidden' id='location_$i' name='location_$i'
        post_id='".get_the_ID()."' 
        value='".get_post_meta(get_the_ID(), 'pays', true)."'
        title='".get_the_title()."'
        excerpt='".get_the_excerpt()."' 
        url='".get_permalink( get_the_ID())."'

        >";
        $i++;
    }
    echo "<input type='hidden' id='total_locations' name='total_location' value='".$i."'>";
    
} else {
    // no posts found
}
/* Restore original Post Data */
wp_reset_postdata();
}