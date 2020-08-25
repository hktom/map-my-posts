<?php
function mapBox(){
    ?>

<style>
.mapboxgl-popup {
max-width: 400px !important;
}
</style>
        
<div id='map' style='width: 100%; height: 450px;'></div>
<script>
$(function(){

//Set Locations from posts
function setLocations(){
    var i=0;
    var totalPost=parseInt($(`#total_locations`).val());
    if(totalPost > 0){
        while(i < totalPost ){
            posts.push({
                'location':$(`#location_${i}`).val(),
                'title':$(`#location_${i}`).attr('title'),
                'excerpt':$(`#location_${i}`).attr('excerpt'),
                'url':$(`#location_${i}`).attr('url'),
                'id':$(`#location_${i}`).attr('post_id'),
            });
           i++;
       }
    }    
}


//markers 
function setMarkers(post){
    mapboxClient.geocoding
    .forwardGeocode({
    query: post.location,
    autocomplete: false,
    limit: 1
    }).send().then(function(res){
        if(res && res.body && res.body.features && res.body.features.length){
            var feature = res.body.features[0];
            
            // create the popup
            var popup = new mapboxgl.Popup({ offset: 25 }).setHTML(
                `<h3>${post.title}</h3> 
                <p> ${post.excerpt}</p> 
                <a href="${post.url}"> Voir ce créateur</a>`
            );

            // create DOM element for the marker
            var el = document.createElement('div');
            el.id = `marker_${post.id}`;

            new mapboxgl.Marker().
            setLngLat(feature.center).
            setPopup(popup).
            addTo(map);
        }
    })
}

//geocoder
function geocoder(){
    posts.forEach(post => {
        setMarkers(post);
    });
}
    var posts=[];
    var locations=[];
    mapboxgl.accessToken = 'pk.eyJ1IjoidG9taGsiLCJhIjoiY2szZ3R2eG1rMDU2azNobXR5dXUzODRieiJ9.3AcxoJrp5yJtZTxPdqmDzw';
var mapboxClient = mapboxSdk({ accessToken: mapboxgl.accessToken });

var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/tomhk/ckea7kbu400u619qvq715xfkm',
     // stylesheet location
    center: [21.634121, -2.380922], // starting position [lng, lat]
    zoom: 2 // starting zoom
});

map.addControl(new mapboxgl.NavigationControl());
setLocations();
geocoder(locations);


























});
</script>
<?php
}