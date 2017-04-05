                     var porcionlat;
                     var porcionlong;
                    
                     google.maps.event.addDomListener(window, 'load', intilize);
                     function intilize() {
                      var autocomplete = new google.maps.places.Autocomplete(document.getElementById("txtautocomplete"));

                       google.maps.event.addListener(autocomplete, 'place_changed', function () {
 
                       var place = autocomplete.getPlace();
                       var location = "Address: " + place.formatted_address + "<br/>";
                       location += "Latitude: " + place.geometry.location.lat() + "<br/>";
                       location += "Longitude: " + place.geometry.location.lng();
                       var longitud= place.geometry.location.lng();
                       var latitud= place.geometry.location.lat();

                       document.getElementById('lblresult').innerHTML = location
                     
                       var longi = longitud.toString()
                       var lati =latitud.toString()
 
                       var numeroLetras = longi.length;
                       porcionlat =lati.substring(0,6);
                       porcionlong =longi.substring(0,7);
                        //console.log(latitud);
                        //console.log(longitud);
                        //console.log(longi);
                        //console.log(numeroLetras);
                        //console.log(porcionlong);
                       // console.log(porcionlat);


                    $.post('pagina2.php',{porcionlat:porcionlat, porcionlong:porcionlong});


                       


        });
                      // console.log(porcionlong);
                        //console.log(porcionlat);

    };
    

   
