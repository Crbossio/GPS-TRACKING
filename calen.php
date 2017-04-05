<html>

<!-- Latest compiled and minified CSS -->




 
<meta charset="UTF-8">
<title> Coordenadas GPS</title>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="estilos.css">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />



<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

 
 
<style>
    #auto_load_div>div{width:100%;width:400px;}
  </style>
 

 <body>

 

 <header>
  <div class="container">   
    <h1 align="rigth"> Seguimiento historico de ruta</h1>
  </div>

</header>

<div>
<div class="container">
    <div class='col-md-3'>
        <div class="form-group">
            
             <strong><h5 style = "color: #110111">Fecha inicio:</h5></strong> 
            <div class='input-group date' id='datetimepicker6'>
                <input type='text' name="date1" id="date1" class="form-control" />
                
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
   <!--  <input type='text' name="id1" id="id1" value="id1" />
    <input type='text' name="id2" id="id2" value="id2" /> -->
    <div class='col-md-3'>
        <div class="form-group">    
             <strong><h5 style = "color: #110111">Fecha fin:</h5></strong> 
            <div class='input-group date' id='datetimepicker7'>
                <input type='text' name="date2" id= "date2" class="form-control" />
                
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
    <div class='col-md-3'>
        <div class="form-group">    
             <strong><h5 style = "color: #110111">localización:</h5></strong> 
            <div>
                 <script src ="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVXy7pfMRC6riCAKkvQWhWMTfn9QGR3jE&signed_in=true&libraries=places"></script>   
                 <script src="consulta.js"></script>
                <input type="text" id="txtautocomplete" style="width:400px" placeholder="enter the adress"/>
                <label id="lblresult"></label>
            </div>
        </div>
    </div>
</div>


<div class="container"
<h1 align="rigth">
<input type="submit" name="enviar" value="Enviar" id="enviar" class="btn btn-info" > 
<input type="button" onclick="location='/index.php'" class="btn btn-info" value="Inicio">


</h1>
<div id="resultado"></div>
</div>


<!-- 
<input type="button" href="javascript:;" onclick="realizaProceso($('#id1').val(), $('#id2').val());return false;" value="Calcula"/>
 -->

 
<script type="text/javascript">
//console.log(porcionlat);

$(document).ready(function() {
        $(function () {
            $('#datetimepicker6').datetimepicker({
                useCurrent: false, //Important! See issue #1075
                format: 'YYYY-MM-DD HH:mm:ss'
            });
            $('#datetimepicker7').datetimepicker({
                useCurrent: false, //Important! See issue #1075
                format: 'YYYY-MM-DD HH:mm:ss'
            });

            $("#datetimepicker6").on("dp.change", function (e) {
                $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
            });

            $("#datetimepicker7").on("dp.change", function (e) {
                $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
            });
        });
    });

</script>

<script>


$(document).ready(function(){
    $("#enviar").click(function(){
        var date1 = $("#date1").val();
        var date2 = $("#date2").val();
       // var porcionlat =lati.substring(0,6);
        //var porcionlong =longi.substring(0,7);
       // var porcionlat =lati.substring(0,8);
        //var porcionlong = $("#porcionlong").val();
        //var porcionlat = $("#porcionlat").val();

        $.post("pagina2.php", {date1:date1, date2:date2}, function(datos){
            $("#resultado").html(datos);
        });
    });
});
$(document).ready(function(){
    $("#posi").click(function(){
        var date1 = $("#date1").val();
        var date2 = $("#date2").val();
       // var porcionlat =lati.substring(0,6);
        //var porcionlong =longi.substring(0,7);
       // var porcionlat =lati.substring(0,8);
        //var porcionlong = $("#porcionlong").val();
        //var porcionlat = $("#porcionlat").val();

        $.post("pagina2.php", {date1:date1, date2:date2}, function(datos){
            $("#resultado").html(datos);
        });
    });
});
//----------------------------------------------
/*$conn = new mysqli("gpstraking.cvsno6ctfz1z.us-west-2.rds.amazonaws.com", "admin", "admin123", "GPSDB");  
$color_row=array('#cccccc', 'lightblue');
$ind_color=0;

$busqueda = "SELECT latitud, longitud FROM historial WHERE fecha BETWEEN '$date1' AND '$date2' ORDER BY fecha DESC"; 
$resultado2 = mysqli_query($conn, $busqueda) or die("Consulta fallida: " . mysqli_error());
  while( $zeile = mysqli_fetch_array($resultado2, MYSQLI_NUM ) ) {
$json[] = $zeile;
                        
 var polyline_data = <?php echo json_encode( $json ); ?>

//---------------------------------------------
// ###############################

var val_act_slider;
 var marcador2 = null;
 var limsup= polyline_data.length-1;
    limsup = .length - 1;
     $('#ex6')
          .slider('setAttribute', 'enabled', true)
          .slider('refresh');
          $('#ex6')
          .slider('setAttribute', 'max', limsup)
          .slider('refresh');

   // With JQuery
    $("#ex6").slider({
      formatter: function(value) {
      return value;
      }
    });
    $("#ex6").on("slide", function(slideEvt) {
      $("#ex6SliderVal").text(slideEvt.value);
      val_act_slider = slideEvt.value;
      mostrarFecha(val_act_slider);
    });
    function mostrarFecha(valslid) {
      if (valslid != 0) {
        posAct = polyline_data[valslid - 1];
        //coorhist1 = posAct.split(" ");
        fechaAct = coorhist1[1][3]
        if (marcador2 != null) {
          marcador2.setMap(null);
        }
        marcador2 = new google.maps.Marker({  // función de api para crear marcador
        position: new google.maps.LatLng(coorhist1[1][0], coorhist1[1][1]), // posición con coor[0] y coor[1]
        map: map,
        title: fechAct, // Titulo para el marcador, es opcional.. no es necesario.. bla bla bla
        icon: "style/mark2.png"
       });
        var longElement = document.getElementById("fechAct"); 
        longElement.textContent = "Fecha: " + fechaAct;
      }
    }*/

  //#################################333
//     function realizaProceso(valorCaja1, valorCaja2){
//         var parametros = {
//                 "valorCaja1" : valorCaja1,
//                 "valorCaja2" : valorCaja2
//         };
//         $.ajax({
//                 data:  parametros,
//                 url:   'balbuceo.php',
//                 type:  'post',
//                 // beforeSend: function () {
//                 //         $("#resultado1").html("Procesando, espere por favor...");
//                 // },
//                 // success:  function (response) {
//                 //         $("#resultado1").html(response);
//                 //         $("#resultado2").html(response);
//                 // }
//         });
// }

</script>
 <!-- Resultado1: <span id="resultado1">0</span>
 Resultado2: <span id="resultado2">0</span>  -->


 </body>
 
</html>


