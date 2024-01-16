<x-app-layout>
  <x-slot name="title">周辺情報</x-slot>
  <div class="title">
    <h1>周辺情報</h1>
  </div>
  
  <div id="map" style="width:800px; height:400px"></div>
  
  <div class="blue-pin">
    <img src='http://maps.google.com/mapfiles/ms/icons/blue-dot.png' alt="青ピン">フィットネス施設
  </div>
  
  <div class="green-pin">
    <img src='http://maps.google.com/mapfiles/ms/icons/green-dot.png' alt="緑ピン">温泉施設
  </div>
  
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
