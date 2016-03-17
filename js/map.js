//GOOGLE Карта==================================




		var map;
        var image = 'img/sign2.png'; //Изображение маркера
        var image2 = 'img/sign1.png'; //Изображение маркера

        //Функция отрисовки карты
        function initMap(town,town2) {
          var geocoder = new google.maps.Geocoder();
            map = new google.maps.Map(document.getElementById('map'), {
              zoom: 13, //Масштаб карты
              scrollwheel: false, //Отключение скролла мыши над картой
              disableDefaultUI: true, //Отключение элементов управления
              mapTypeId:google.maps.MapTypeId.ROADMAP, //Отображение карты дорог
			  center: {lat: 43.23878795830911, lng: 76.9883967239258}
            });
            
              geocodeAddress(geocoder, map, town);
              geocodeAddress2(geocoder, map, town2);
        }

        //Определение адреса и установка туда маркера
        function geocodeAddress(geocoder, resultsMap, address) {
          geocoder.geocode({'address': address}, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
             // resultsMap.setCenter(results[0].geometry.location);
              marker = new google.maps.Marker({
                animation: google.maps.Animation.DROP, //Красивая анимация установки маркера
                map: resultsMap,
                position: results[0].geometry.location,
                icon: image //Ставим нашу картинку
              });
            } else {
              alert('Geocode was not successful for the following reason: ' + status);
            }
          });
        }
        function geocodeAddress2(geocoder, resultsMap, address) {
          geocoder.geocode({'address': address}, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
              //resultsMap.setCenter(results[0].geometry.location);
              marker = new google.maps.Marker({
                animation: google.maps.Animation.DROP, //Красивая анимация установки маркера
                map: resultsMap,
                position: results[0].geometry.location,
                icon: image2 //Ставим нашу картинку
              });
            } else {
              alert('Geocode was not successful for the following reason: ' + status);
            }
          });
        }		
	