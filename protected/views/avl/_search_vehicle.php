<section class="page container cont">
    
        <div class="row">
            <div >
                <div class="box">                 
                    <div id='map' style="height: 600px"></div>  
                </div>
            </div>
        </div>
 </section>  
<script src="https://npmcdn.com/leaflet@1.0.0-rc.2/dist/leaflet.js"></script>
<?php echo $localization->latitude?>
<script>
var map = L.map('map').setView([<?php echo $localization->latitude?>,<?php echo $localization->longitude?>], 15);
L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFva25veCIsImEiOiJmcGJNR09jIn0.d8dHV-Ucm_dxJRbt50d1wA', {
        maxZoom:20,
        attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
                '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="http://mapbox.com">Mapbox</a>',
        id: 'mapbox.streets'
}).addTo(map);
var puntoUbic=L.marker([<?php echo $localization->latitude?>,<?php echo $localization->longitude?>]);
puntoUbic.addTo(map).bindPopup("<b><?php echo $localization->localization_time;?></b><br />Posición actual.").openPopup();
function onMapClick(e) {
    popup = L.popup();
    popup.setLatLng(e.latlng)
    .setContent("Latitud y longitud en la cual hizo click " + e.latlng.toString())
    .openOn(map);
}
map.on('click', onMapClick);
function creaPunto(){			
    $.ajax({
            url: "muestrapunto",
            dataType:'json',
            type:'post',
            data: 'idVehiculo=1',
       success: function(data) {
             punto=[data.latitud, data.longitud];
             //$("#velocidad").html(data.velocidad);
             //alert(punto);
             map.removeLayer(puntoUbic);	
             puntoUbic=L.marker(punto);             
             puntoUbic.addTo(map).bindPopup("<b>"+data.time+"</b><br />Posición actual.").openPopup();//.openPopup();	
       },
        error: function(xhr, ajaxOptions, thrownError) {
              console.debug(xhr.responseText);
       },
    });    	
}
setInterval('creaPunto()',5000);
</script>