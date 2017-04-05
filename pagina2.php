<!DOCTYPE html>
<html lang="en">
<link rel = "stylesheet" href = "bootstrap-slider.min.css" />
<link rel = "stylesheet" href = "bootstrap.css" />
 
  <script src ="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVXy7pfMRC6riCAKkvQWhWMTfn9QGR3jE&signed_in=true&libraries=places"></script>   
                    

                    
<!-- $conn = new mysqli("gpstraking.cvsno6ctfz1z.us-west-2.rds.amazonaws.com", "admin", "admin123", "GPSDB");  
$color_row=array('#cccccc', 'lightblue');
$ind_color=0; -->
<!-- 
//SELECT `latitud`, `longitud` FROM coordenadas where latitud LIKE "10.99%" AND longitud LIKE "-74.80%"
                            
 // $busqueda33 = "SELECT latitud, longitud FROM historial WHERE latitud LIKE '$porcionlat%' AND longitud='$porcionlong%';"; 
 // $resultado33 = mysqli_query($conn, $busqueda33);
 //   while( $zeile33 = mysqli_fetch_array($resultado33, MYSQLI_NUM ) ) {
 // $json33[] = $zeile33;

 //                                   } -->


  


    

  <?php
  
  $date1 = $_POST['date1']; 
  $date2 = $_POST['date2']; 
  





$conn = new mysqli("gpstraking.cvsno6ctfz1z.us-west-2.rds.amazonaws.com", "admin", "admin123", "GPSDB");  
$color_row=array('#cccccc', 'lightblue');
$ind_color=0;
#############################3
######################33
//SELECT `latitud`, `longitud` FROM coordenadas where latitud LIKE "10.99%" AND longitud LIKE "-74.80%"
 ##########################3                              
 // $busquedam = "SELECT latitud, longitud FROM historial WHERE latitud LIKE '$porcionlat%' AND longitud='$porcionlong%';"; 
 // $resultadom = mysqli_query($conn, $busquedam) or die("Consulta fallida: " . mysqli_error());
 //   while( $zeilem = mysqli_fetch_array($resultadom, MYSQLI_NUM ) ) {
 // $json3[] = $zeilem;

 //                                   }

#########################
        
       
 $busqueda = "SELECT latitud, longitud FROM historial WHERE fecha BETWEEN '$date1' AND '$date2' ORDER BY fecha DESC"; 
$resultado2 = mysqli_query($conn, $busqueda) or die("Consulta fallida: " . mysqli_error());
  while( $zeile = mysqli_fetch_array($resultado2, MYSQLI_NUM ) ) {
$json[] = $zeile;
                                                                  }

 ////////////////////////////////////////
     $busqueda22 = "SELECT longitud, fecha FROM historial WHERE fecha BETWEEN '$date1' AND '$date2' ORDER BY fecha DESC"; 
$resultado22 = mysqli_query($conn, $busqueda22) or die("Consulta fallida: " . mysqli_error());
  #####




  while( $zeile2 = mysqli_fetch_array($resultado22, MYSQLI_NUM ) ) {
$json2[] = $zeile2;
                                                                  }                                                             
 /////////////////////////////////////////                                                                 


 //console.log(cons)

?>
   

    </script>
    <div id="map" style="width: 100%; height: 450px"></div>

 
    <div class="col-md-4">
        <h2 style = "color: #110111">Fecha por donde pasó el camión</h2> 
        <input id="ex6" type="text" data-slider-min="0" data-slider-max="4000" data-slider-step="1" data-slider-value="0" data-slider-tooltip="hide"/ data-slider-enabled="true">
        
       
        <br>
        <strong><h4><div id = "fechAct"></div></h4></strong>
      </div>
     <br>  

     <script src="js/jquery-3.1.0.min.js"></script> <!-- Me permite usar funciones de js, si no lo tengo guardado en la carpeta, debo incluirlo con una url o descargarlo directamente -->
  <script src="js/bootstrap.js"></script>
  <script src="js/bootstrap-slider.min.js"></script> 
 <script type="text/javascript">
 var polyline_data = <?php echo json_encode( $json ); ?>;
 var polyline_data2 = <?php echo json_encode( $json2 ); ?>;
 var limsup2= polyline_data.length;
 console.log(limsup2)
 console.log(polyline_data)
 ////////////////////77
 var limsup;
 var val_act_slider;
 var map
 var marcador2 = null;
 var limsup= polyline_data.length;
    limsup = polyline_data.length - 1;
    
     
  

   // With JQuery
    $("#ex6").slider({
      formatter: function(value) {
      return value;
      }
    });
    $("#ex6").on("slide", function(slideEvt) {
      
      val_act_slider = slideEvt.value;
      mostrarFecha(val_act_slider);
    });
    
    function mostrarFecha(valslid) {
      for ( var i=0; i<  val_act_slider; i++ ){
      if (valslid != 0) {
        fechaAct = polyline_data2[i][1]
         if (marcador2 != null) {
             marcador2.setMap(null);
         }
    ///
        
        marcador2 = new google.maps.Marker({  

        position: new google.maps.LatLng({lat: parseFloat(polyline_data[i][0]), lng: parseFloat(polyline_data[i][1])}), 
        map: map,
      
       
        icon: "mark2.png"
       });
        var longElement = document.getElementById("fechAct"); 
        longElement.textContent = "Fecha: " + fechaAct;
      }
    }
  }
 /////////////////
  
function initMap() {
   map = new google.maps.Map(document.getElementById('map'), {
   center: {lat: parseFloat(polyline_data[0][0]), lng: parseFloat(polyline_data[0][1])},
    zoom: 15,
    mapTypeId: google.maps.MapTypeId.TERRAIN
  });
    map.addListener('click', function(e) {
    placeMarkerAndPanTo(e.latLng, map);
    console.log(e.latLng);
  });

 var polylinePlanCoordinates  = [];


 for ( var i=0; i< polyline_data.length; i++ ){

  polylinePlanCoordinates.push(  {lat: parseFloat(polyline_data[i][0]) , lng: parseFloat(polyline_data[i][1]) }) 

}
  

     $lati = polyline_data[1][0];

    $longi =  polyline_data[1][1];
 
  var flightPath = new google.maps.Polyline({
    path: polylinePlanCoordinates,
    geodesic: true,
    strokeColor: '#FF0000',
    strokeOpacity: 1.0,
    strokeWeight: 2
  });
  var myLatLng = {lat: parseFloat(polyline_data[0][0]), lng: parseFloat(polyline_data[0][1])};
  var marker = new google.maps.Marker({
    position: myLatLng,
    map: map,
    //icon: "style/mark2.png"
     
    // title: 'Latidud: ' + polyline_data[0][0] + ' Longitud: ' +  polyline_data[0][1]
  });

  flightPath.setMap(map);
  <?php
$url1=$_SERVER['REQUEST_URI'];
;
?> 

};
function placeMarkerAndPanTo(latLng, map) {
  var marker = new google.maps.Marker({
    position: latLng,
    map: map

  });

  map.panTo(latLng);

    // google.maps.event.addDomListener(window, 'load', intilize);
    // function intilize() {
    //     var autocomplete = new google.maps.places.Autocomplete(document.getElementById("txtautocomplete"));

    //     google.maps.event.addListener(autocomplete, 'place_changed', function () {

    //     var place = autocomplete.getPlace();
    //     var location = "Address: " + place.formatted_address + "<br/>";
    //     location += "Latitude: " + place.geometry.location.lat() + "<br/>";
    //     location += "Longitude: " + place.geometry.location.lng();
    //     document.getElementById('lblresult').innerHTML = location
    //     });

    // };

}



    </script>

   <!--  <span>location:</span><input type="text" id="txtautocomplete" style="width:200px" placeholder="enter the adress"/>
    <label id="lblresult"></label> -->
</body>








    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVXy7pfMRC6riCAKkvQWhWMTfn9QGR3jE&signed_in=true&callback=initMap"></script>

     <script src="http://code.jquery.com/jquery-latest.js"></script>
    

    
  
  </body>
</html>
   
