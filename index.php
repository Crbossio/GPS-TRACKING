
<html lang="en">
 <head>
 
<meta charset="UTF-8">
<title> Coordenadas GPS</title>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="estilos.css">


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> 


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>


</head>

 
 

 
 </head>
 <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Simple Polylines</title>
    <style>
      
      #map {
        width:  100%;
        height: 400px;

      }
    </style>
  </head>
<!--  <header>
 
  <div class="container"
 <p>
<font size="10"face="arial" color="white">
    <h1 align="center">''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''</h1>
</font></p>
  </div>

</header> -->

 <body style="background-color:gray;">
<div class = "container">
   
      <div class="col-md-15">
        <font size="10"face="arial" color="black">
    <h1 align="center">'''''''''''''''''''''''</h1>
</font></p>
        
          
      </div> 

<div class = "navbar navbar-inverse navbar-fixed-top" style = "opacity: 15; color: blue">
    <div class = "container">
      <div class = "navbar-header">
        <div class = "navbar-brand">GPSviewer</div>
          <button type = "button" class = "navbar-toggle collapsed" data-toggle = "collapse" data-target = "#navigation-bar" aria-expanded = "false">
          <span class = "sr-only">Toggle navigation</span>
          <span class = "icon-bar"></span>
          <span class = "icon-bar"></span>
          <span class = "icon-bar"></span>
        </button>
      </div>
      
      <div class="collapse navbar-collapse" id="navigation-bar">
        <div class="nav navbar-nav navbar-right">
          <li class="active">
            <a href="/index.html">Tiempo Real</a> <!-- href='#' intercambio el # por la dirección a la que quiero enviarlo-->
          </li>
          <li>
            <a href="/calen.php">Históricos</a>
          </li>
          
        </div>
      </div>
    </div>
  </div>
<div id = "map" style="width: 100%; height: 500px"></div>
 <div class = "container">
    <div class="row">  

    <!--   <div class="col-md-6">
        <h2 style = "color: #ff6969">Coordenadas Geográficas</h2> <! Muestra los valores que van refrescandose desde el js en el id específico -->
       <!--  <strong><h4><div id = "Latitud"></div></h4></strong>
        <strong><h4><div id = "Longitud"></div></h4></strong>
        <strong><h4><div id = "Fecha"></div></h4></strong> 
      </div>
 --> 
      
      
    </div>
  </div>
<script src="js/jquery-3.1.0.min.js"></script> <!-- Me permite usar funciones de js, si no lo tengo guardado en la carpeta, debo incluirlo con una url o descargarlo directamente -->
  <script src="js/bootstrap.js"></script>

<script type="text/javascript">
setInterval(actualizar, 10000);
  var map;
  var marker;
  var coordenadas;
  var enn = "";
  var misaka=[];
  var mapDiv
  $(window).load(actualizar());
  function actualizar(){

var return_first = function () {
          var tmp = null;
          $.ajax({
              'async': false,
               'type': "POST",
              'global': false,
              'dataType': 'html',
              'url': "server.php",
              'success': function (data) {
                  tmp = data;
              }
          });
          return tmp;
      }();
      
var coor = return_first.split("\n");
var coor = return_first.split("\n"); // Los datos que me importan (Lat, Long, Tiem) se encuentran en el salto 9, por eso guardo en una variable esa linea y a su vez divido ese string cada que encuentre un espacio
      // var longElement = document.getElementById("Latitud"); // Voy a mostrar un texto en donde esté el id "Latitud"
      // longElement.textContent = "Latitud: " + coor[0]; // Muestro Lat + la coordenada guardada en 0 que se dividio con el split
      // var latElement = document.getElementById("Longitud");
      // latElement.textContent = "Longitud: " + coor[1];
      // var timElement = document.getElementById("Fecha");
      // timElement.textContent = "Fecha: " + coor[2];
      //console.log("holo"); Haciendo prueba de que muestra
       if (coor[0] == 0.0 && coor[1] == 0.0) {
        refrescar_marcador(11.018055555556, -74.851111111111)
      }
      else {

      refrescar_marcador(coor[0], coor[1]); // latitude, longitude
       console.log(coor[0])}
      //alert(coor)
}
function initMap() { // Inicio el mapa con los recursos que me da api
      mapDiv = document.getElementById('map');
      map = new google.maps.Map(mapDiv, {
        center: new google.maps.LatLng(11.018055555556, -74.851111111111), // Establezco el centro en las coordenadas de la u, que obtuve de internet, puedo poner la que me da la syrus, pero de igual forma cuando actualice el valor de coor me va a mover el mapa a donde sea que se encuentre
        zoom: 15, // hacemos zoom para acercar mapa
        mapTypeId: google.maps.MapTypeId.ROADMAP//'terrain' // Bla, tipo id? sugerido por google maps api
      });
    }
    function refrescar_marcador(latitude, longitude) // creamos el marcador y lo vamos refrescando en la función "holo" cuando la llamamos con coor[0] y coor[1], ya que establecimos que los  parametros fueran latitude, longitude.
    {

      misaka.push(new google.maps.LatLng(latitude, longitude));
      polilinea();
      var marker = new google.maps.Marker({  // función de api para crear marcador
        position: new google.maps.LatLng(latitude, longitude), // posición con coor[0] y coor[1]
        map: map,
         // Titulo para el marcador, es opcional.. no es necesario.. bla bla bla
       });
      map.setCenter(new google.maps.LatLng(latitude, longitude)); // Movemos el centro hacia donde se encuentren los nuevos valores de coor[0] y coor[1]
    }

    function polilinea() {
      var flightPath = new google.maps.Polyline({
        path:misaka,
        strokeColor:"#0000FF",
        strokeOpacity:0.8,
        strokeWeight:2
      });
      flightPath.setMap(map);
    }


</script>










 
 
   
   <!-- <script>
      function auto_load(){
        $.ajax({
          url: "pagina.php",
          cache: false,
          success: function(otro){
             $("#auto_load_div").html(otro);

          } 
        });
      }
 
      $(document).ready(function(){
 
        auto_load(); //Call auto_load() function when DOM is Ready
 
      });
 
      //Refresh auto_load() function after 10000 milliseconds
      setInterval(auto_load,1000000);
   </script> -->
    <script async defer
   src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCREYEOrU09R-W-A0ByBlymc-pZWFuwLec&callback=initMap"> // Nos permite crear conexión con google api con la llave que no es necesaria de tenerla 
  </script>

 </body>
</html>

