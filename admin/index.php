<?php
function addMenu(){
    add_menu_page("Post Listing Map", "Post Listing Map", 4, "post-listing-map", "postListingMap");
}

function postListingMap(){
    echo "Post Listing Map";
}