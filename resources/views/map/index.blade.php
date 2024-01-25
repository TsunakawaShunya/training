<x-app-layout>
  <x-slot name="title">周辺情報</x-slot>
  <x-slot name="header">周辺情報</x-slot>
  
  <div class="flex justify-center">
    <div class="m-3 border-4 border-solid border-gray-800" id="map" style="width:1200px; height:600px">map</div>
  </div>
  
  <ul class="mx-3">
    <li class="flex justify-end">
      <img src='http://maps.google.com/mapfiles/ms/icons/blue-dot.png' alt="青ピン">フィットネス施設
    </li>
    
    <li class="flex justify-end">
      <img src='http://maps.google.com/mapfiles/ms/icons/green-dot.png' alt="緑ピン">温泉施設
    </li>
  </ul>
  
  <script src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_key') }}&libraries=places" defer></script>
  <script>
    let map;
    let service;
    let infowindow;
    
    // ページが読み込まれた後に実行
    document.addEventListener("DOMContentLoaded", () => {
    // 位置情報の取得
      navigator.geolocation.getCurrentPosition(
        (position) => {
          // 位置情報が取得できたらinitMapを呼び出す
          initMap(position);
        },
        (error) => {
          console.error("Error getting geolocation:", error);
        }
      );
    });
    
    function initMap(position) {
      // 現在地
      const currentLat = position.coords.latitude;
      const currentLng = position.coords.longitude;
      const currentLocation = new google.maps.LatLng(currentLat, currentLng);
      
      infowindow = new google.maps.InfoWindow();
      map = new google.maps.Map(document.getElementById("map"), {
        center: currentLocation,
        zoom: 13,
        style: [
          {
            "elementType": "geometry",
            "stylers": [
              {
                "color": "#ebe3cd"
              }
            ]
          },
          {
            "elementType": "labels.text.fill",
            "stylers": [
              {
                "color": "#523735"
              }
            ]
          },
          {
            "elementType": "labels.text.stroke",
            "stylers": [
              {
                "color": "#f5f1e6"
              }
            ]
          },
          {
            "featureType": "administrative",
            "elementType": "geometry.stroke",
            "stylers": [
              {
                "color": "#c9b2a6"
              }
            ]
          },
          {
            "featureType": "administrative.land_parcel",
            "elementType": "geometry.stroke",
            "stylers": [
              {
                "color": "#dcd2be"
              }
            ]
          },
          {
            "featureType": "administrative.land_parcel",
            "elementType": "labels.text.fill",
            "stylers": [
              {
                "color": "#ae9e90"
              }
            ]
          },
          {
            "featureType": "landscape.natural",
            "elementType": "geometry",
            "stylers": [
              {
                "color": "#dfd2ae"
              }
            ]
          },
          {
            "featureType": "poi",
            "elementType": "geometry",
            "stylers": [
              {
                "color": "#dfd2ae"
              }
            ]
          },
          {
            "featureType": "poi",
            "elementType": "labels.text.fill",
            "stylers": [
              {
                "color": "#93817c"
              }
            ]
          },
          {
            "featureType": "poi.park",
            "elementType": "geometry.fill",
            "stylers": [
              {
                "color": "#a5b076"
              }
            ]
          },
          {
            "featureType": "poi.park",
            "elementType": "labels.text.fill",
            "stylers": [
              {
                "color": "#447530"
              }
            ]
          },
          {
            "featureType": "road",
            "elementType": "geometry",
            "stylers": [
              {
                "color": "#f5f1e6"
              }
            ]
          },
          {
            "featureType": "road.arterial",
            "elementType": "geometry",
            "stylers": [
              {
                "color": "#fdfcf8"
              }
            ]
          },
          {
            "featureType": "road.highway",
            "elementType": "geometry",
            "stylers": [
              {
                "color": "#f8c967"
              }
            ]
          },
          {
            "featureType": "road.highway",
            "elementType": "geometry.stroke",
            "stylers": [
              {
                "color": "#e9bc62"
              }
            ]
          },
          {
            "featureType": "road.highway.controlled_access",
            "elementType": "geometry",
            "stylers": [
              {
                "color": "#e98d58"
              }
            ]
          },
          {
            "featureType": "road.highway.controlled_access",
            "elementType": "geometry.stroke",
            "stylers": [
              {
                "color": "#db8555"
              }
            ]
          },
          {
            "featureType": "road.local",
            "elementType": "labels.text.fill",
            "stylers": [
              {
                "color": "#806b63"
              }
            ]
          },
          {
            "featureType": "transit.line",
            "elementType": "geometry",
            "stylers": [
              {
                "color": "#dfd2ae"
              }
            ]
          },
          {
            "featureType": "transit.line",
            "elementType": "labels.text.fill",
            "stylers": [
              {
                "color": "#8f7d77"
              }
            ]
          },
          {
            "featureType": "transit.line",
            "elementType": "labels.text.stroke",
            "stylers": [
              {
                "color": "#ebe3cd"
              }
            ]
          },
          {
            "featureType": "transit.station",
            "elementType": "geometry",
            "stylers": [
              {
                "color": "#dfd2ae"
              }
            ]
          },
          {
            "featureType": "water",
            "elementType": "geometry.fill",
            "stylers": [
              {
                "color": "#b9d3c2"
              }
            ]
          },
          {
            "featureType": "water",
            "elementType": "labels.text.fill",
            "stylers": [
              {
                "color": "#92998d"
              }
            ]
          }
        ],
      });
      
      const currentLocationMarker = new google.maps.Marker({
        position: currentLocation,
        title: "現在地",
      });
      
      currentLocationMarker.setMap(map);
      
      // ジムの探索用リクエスト
      const gymRequest = {
        location: currentLocation,
        radius: 3000, // 探索範囲
        type: ['gym'],
      }
      const blue_pin = 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png';    // 青ピン
      
      // 温泉の探索用リクエスト
      const spaRequest = {
        location: currentLocation,
        radius: 3000, // 探索範囲
        type: ['spa'],
      }
      // ピンのURLを設定
      const bluePinUrl = 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png';
      const greenPinUrl = 'http://maps.google.com/mapfiles/ms/icons/green-dot.png';
  
      service = new google.maps.places.PlacesService(map);
      service.nearbySearch(gymRequest, (results, status) => callback(results, status, bluePinUrl));
      service.nearbySearch(spaRequest, (results, status) => callback(results, status, greenPinUrl));
    }
    
    // ジム用コールバック関数
    function callback(results, status, pinUrl) {
      if (status === google.maps.places.PlacesServiceStatus.OK) {
        // 3つまで
        const placesToShow = results.slice(0, 3);
        // ジム用マーカー
        placesToShow.forEach(place => {
          const marker = new google.maps.Marker({
            position: place.geometry.location,
            map: map,
            title: place.name,
            icon: pinUrl,
          });
  
          // マーカーがクリックされた時
          marker.addListener('click', () => {
            // infowindowにタイトルと住所を表示
            infowindow.setContent(`<strong>${place.name}</strong><br>${place.vicinity}<br><a href="https://www.google.com/search?q=${encodeURIComponent(place.name)}" target="_blank">Googleで検索</a>`);
            infowindow.open(map, marker);
          });
        });
      }
    }          
  </script>
</x-app-layout>
