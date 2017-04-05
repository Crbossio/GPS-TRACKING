<!DOCTYPE html>
<html >

  <?php
  


$conn = new mysqli("gpstraking.cvsno6ctfz1z.us-west-2.rds.amazonaws.com", "admin", "admin123", "GPSDB");  
$color_row=array('#cccccc', 'lightblue');
$ind_color=0;

$query = "SELECT  * FROM historial ORDER BY numero DESC LIMIT 400"; 
$resultado = mysqli_query($conn, $query) or die("Consulta fallida: " . mysqli_error()); 

     
       
 $busqueda = "SELECT latitud, longitud FROM historial  ORDER BY numero DESC LIMIT 400";; 
$resultado2 = mysqli_query($conn, $busqueda) or die("Consulta fallida: " . mysqli_error());
  while( $zeile = mysqli_fetch_array($resultado2, MYSQLI_NUM ) ) {
$json[] = $zeile;
                                                                  }



?>
    <div id="map" style="width: 100%; height: 500px"></div>

  
 <script type="text/javascript">
function initMap() {
  var polylinePlanCoordinates  = [];
  var polyline_data = <?php echo json_encode( $json ); ?>;
  var myLatLng = {lat: parseFloat(polyline_data[0][0]), lng: parseFloat(polyline_data[0][1])};
  
  var map = new google.maps.Map(document.getElementById('map'), {
   center: {lat: parseFloat(polyline_data[0][0]), lng: parseFloat(polyline_data[0][1])},
    zoom: 14,
    mapTypeId: google.maps.MapTypeId.TERRAIN
  });

 

 for ( var i=0; i< polyline_data.length; i++ ){

  
  polylinePlanCoordinates.push(  {lat: parseFloat(polyline_data[i][0]) , lng: parseFloat(polyline_data[i][1]) }) 

}
  console.log(polylinePlanCoordinates)


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
   
     title: 'Latidud: ' + polyline_data[0][0] + ' Longitud: ' +  polyline_data[0][1]
  });

  flightPath.setMap(map);
  <?php
$url1=$_SERVER['REQUEST_URI'];

?> 

}





    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVXy7pfMRC6riCAKkvQWhWMTfn9QGR3jE&signed_in=true&callback=initMap"></script>

     <script src="http://code.jquery.com/jquery-latest.js"></script>  
     
  
  </body>
</html>
   
