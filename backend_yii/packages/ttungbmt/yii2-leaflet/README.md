LeafLet Extension for Yii2
==========================
Extension library to display interactive maps with [LeafletJs](http://leafletjs.com/)

Installation
------------
The preferred way to install this extension is through
[composer](http://getcomposer.org/download/).  This requires the
[`composer-asset-plugin`](https://github.com/francoispluchino/composer-asset-plugin),
which is also a dependency for yii2 – so if you have yii2 installed, you are
most likely already set.

Either run

```
composer require ttungbmt/yii2-leaflet "@dev"
```
or add

```
"ttungbmt/yii2-leaflet" : "@dev"
```

to the require section of your application's `composer.json` file.

Usage
-----
Khởi tạo bản đồ
```
$leaflet = new LeafLet([
    'name'   => 'map', // optional: Đặt tên cho biến bản đồ L.map(options)
    'center' => new LatLng(['lat' => 10.804476, 'lng' => 106.639384])
]);

// Thiết lập thêm cho bản đồ ở đây
....

// Render widget bản đồ
echo Map::widget(['leafLet' => $leaflet]);
```

Thêm danh sách lớp mặc định và tạo LayerControl

```
$leaflet->addDefaultBaseLayers();
```

Thêm 1 lớp mới
```
// Method 1
$leaflet->addLayer([
    'name'    => 'TileLayer', 
    'options' => [
        'url'         => 'https://api.tiles.mapbox.com/v4/{map}/{z}/{x}/{y}.png?access_token={accessToken}',
        'map'         => 'mapbox.streets',
        'accessToken' => 'pk.eyJ1IjoidHR1bmdibXQiLCJhIjoiY2EzNDFhZjU4ZThkNzY5NTU3M2U1YWFiNmY4OTE3OWQifQ.Bo1ss5J4UjPPOjmq9S3VQw',
        'attribution' => 'Map data &copy; <a href=\'http://mapbox.com\'>Mapbox</a>',
    ]
]);

// Method 2
$tileLayer = new TileLayer([
    'urlTemplate' => 'https://api.tiles.mapbox.com/v4/{map}/{z}/{x}/{y}.png?access_token={accessToken}',
    'clientOptions' => [
        'map'         => 'mapbox.streets',
        'accessToken' => 'pk.eyJ1IjoidHR1bmdibXQiLCJhIjoiY2EzNDFhZjU4ZThkNzY5NTU3M2U1YWFiNmY4OTE3OWQifQ.Bo1ss5J4UjPPOjmq9S3VQw',
        'attribution' => 'Map data &copy; <a href=\'http://mapbox.com\'>Mapbox</a>',
    ]
])

$leaflet->addLayer($tileLayer);
```