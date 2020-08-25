<?php
function mapBox(){
    ?>
        
<div id='map' style='width: 100%; height: 450px;'></div>
<script>
mapboxgl.accessToken = 'pk.eyJ1IjoidG9taGsiLCJhIjoiY2szZ3R2eG1rMDU2azNobXR5dXUzODRieiJ9.3AcxoJrp5yJtZTxPdqmDzw';
var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v11', // stylesheet location
    center: [21.634121, -2.380922], // starting position [lng, lat]
    zoom: 2 // starting zoom
});
map.addControl(new mapboxgl.NavigationControl());
</script>
<?php
}