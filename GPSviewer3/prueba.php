   <!DOCTYPE html>
   <html>
   <body>
   
    <script src ="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVXy7pfMRC6riCAKkvQWhWMTfn9QGR3jE&signed_in=true&libraries=places"></script>  
    <script src="http://code.jquery.com/jquery-latest.js"></script> 
    <script type="text/javascript">
    var porcionlong;
    var porcionlat;
    </script>
    <script type="text/javascript">
    
    google.maps.event.addDomListener(window, 'load', intilize);
    function intilize() {
        var autocomplete = new google.maps.places.Autocomplete(document.getElementById("txtautocomplete"));

        google.maps.event.addListener(autocomplete, 'place_changed', function () {

        var place = autocomplete.getPlace();
        var location = "Address: " + place.formatted_address + "<br/>";
        location += "Latitude: " + place.geometry.location.lat() + "<br/>";
        location += "Longitude: " + place.geometry.location.lng();
        var longitu= place.geometry.location.lng();
        var latitu= place.geometry.location.lat();

        document.getElementById('lblresult').innerHTML = location
        var longi = longitu.toString()
                       var lati =latitu.toString()
 
                       var numeroLetras = longi.length;
                       $porcionlat =lati.substring(0,6);
                       $porcionlong =longi.substring(0,7);
         
          //console.log(latitud);
          //console.log(longitud);



        });
       
  

console.log(porcionlong);
    };

    
    
    //coor= location.split(lng());
     //console.log(coor);
  

    </script>
              <?php

$conn = new mysqli("gpstraking.cvsno6ctfz1z.us-west-2.rds.amazonaws.com", "admin", "admin123", "GPSDB");  
$color_row=array('#cccccc', 'lightblue');
$ind_color=0;

//SELECT `latitud`, `longitud` FROM coordenadas where latitud LIKE "10.99%" AND longitud LIKE "-74.80%"
                            
 $busqueda = "SELECT latitud, longitud FROM historial WHERE latitud LIKE 'porcionlat%' or longitud='porcionlong%';"; 
 $resultado = mysqli_query($conn, $busqueda) or die("Consulta fallida: " . mysqli_error());;
$fila = mysqli_fetch_row($resultado); 
$var = $fila[0]."\n".$fila[1];

echo $var;



   while( $zeile = mysqli_fetch_array($resultado, MYSQLI_NUM ) ) {
    //print $zeile33
 $json[] = $zeile;

 

                                   }
while ($row = mysqli_fetch_assoc($resultado)) {
echo $row['latitud'];
echo $row['longitud'];
}

                                   
                                   ?>

  

       


 

    <span>location:</span><input type="text" id="txtautocomplete" style="width:200px" placeholder="enter the adress"/>
    <label id="lblresult"></label>
     <script src="http://code.jquery.com/jquery-latest.js"></script>
</body>
</html>