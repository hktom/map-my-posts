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

    function countrieShap() {
    var hoveredStateId = null;

    map.on('load', function() {
        map.addSource('states', {
            'type': 'geojson',
            'data': 'https://raw.githubusercontent.com/hktom/assets/master/africa-countries.geo.json'
        });

        // The feature-state dependent fill-opacity expression will render the hover effect
        // when a feature's hover state is set to true.
        map.addLayer({
            'id': 'state-fills',
            'type': 'fill',
            'source': 'states',
            'layout': {},
            'paint': {
                'fill-color': '#DEAB53',
                'fill-opacity': [
                    'case', ['boolean', ['feature-state', 'hover'], false],
                    1,
                    0.0
                ]
            }
        });

        map.addLayer({
            'id': 'state-borders',
            'type': 'line',
            'source': 'states',
            'layout': {},
            'paint': {
                'line-color': '#DEAB53',
                'line-width': 0.5
            }
        });

        // When the user moves their mouse over the state-fill layer, we'll update the
        // feature state for the feature under the mouse.
        map.on('mousemove', 'state-fills', function(e) {
            if (e.features.length > 0) {
                if (hoveredStateId) {
                    map.setFeatureState({ source: 'states', id: hoveredStateId }, { hover: false });
                }
                hoveredStateId = e.features[0].id;
                map.setFeatureState({ source: 'states', id: hoveredStateId }, { hover: true });
            }
        });

        // When the mouse leaves the state-fill layer, update the feature state of the
        // previously hovered feature.
        map.on('mouseleave', 'state-fills', function() {
            if (hoveredStateId) {
                map.setFeatureState({ source: 'states', id: hoveredStateId }, { hover: false });
            }
            hoveredStateId = null;
        });

    });

}

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

//shapefile african countries

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
countrieShap();
//setLocations();
//geocoder(locations);


























});
</script>
<?php
//mapBox function
}