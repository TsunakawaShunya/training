<x-app-layout>
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
      <head>
        <meta charset="utf-8">
        <title>Training</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyBIyzlHbzqoKyv74IPQ6Ihad8Y6oT4kCfM&callback=initMap" async defer>
        </script>
      </head>
      <body>
        <div class='greeting'>
          <h1>map</h1>
        </div>
        
        <div id="map" style="height:500px">
        </div>
         
        <script>
        function initMap() {
          // ページ読み込み時に地図を初期化
          navigator.geolocation.getCurrentPosition(success, error);
        }
      
        function success(position) {
          // 現在位置の緯度・経度を取得
          let currentLat = position.coords.latitude;
          let currentLng = position.coords.longitude;
      
          // 現在位置を地図の中心に設定
          let currentLocation = { lat: currentLat, lng: currentLng };
      
          // オプションを設定
          let mapOptions = {
            zoom: 13,
            center: currentLocation,
          };
      
          // 地図のインスタンスを作成
          let map = new google.maps.Map(document.getElementById("map"), mapOptions);
      
          // 現在位置に青いマーカーを追加
          new google.maps.Marker({
            position: currentLocation,
            map: map,
            icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png', // 青いアイコン
            title: 'Your Location'
          });
      
          // ジムの位置（ダミーデータ）
          let gymLocations = [
            { lat: currentLat + 0.01, lng: currentLng + 0.01, name: 'Gym 1' },
            { lat: currentLat - 0.02, lng: currentLng + 0.02, name: 'Gym 2' },
            { lat: currentLat + 0.03, lng: currentLng - 0.01, name: 'Gym 3' }
          ];
      
          // ジムのマーカーを追加
          for (let gym of gymLocations) {
            new google.maps.Marker({
              position: { lat: gym.lat, lng: gym.lng },
              map: map,
              icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png', // 赤色のアイコン
              title: gym.name
            });
          }
      
          // 温泉施設の位置（ダミーデータ）
          let onsenLocations = [
            { lat: currentLat + 0.02, lng: currentLng - 0.02, name: 'Onsen 1' },
            { lat: currentLat - 0.03, lng: currentLng - 0.01, name: 'Onsen 2' },
            { lat: currentLat + 0.01, lng: currentLng + 0.03, name: 'Onsen 3' }
          ];
      
          // 温泉施設のマーカーを追加（茶色のアイコン）
          for (let onsen of onsenLocations) {
            new google.maps.Marker({
              position: { lat: onsen.lat, lng: onsen.lng },
              map: map,
              icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png', // 緑色のアイコン
              title: onsen.name
            });
          }
        }
      
        function error() {
          // 現在位置取得エラー時の処理
          alert("Unable to retrieve your location");
        }
      </script>
 
      </body>
    </html>
</x-app-layout>