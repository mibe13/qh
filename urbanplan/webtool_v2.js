// public/core.js
// Creating map
// use with gmaps.js
//$("head").append('<script type="text/javascript" src="/gmaps/getcordfile.js"></script>');

var markers = [];
var customMapType;

function findlocation() {
    var a = document.getElementById('add').value;
    GMaps.geocode({
        address: a,
        callback: function(results, status) {
            if (status == 'OK') {
                var latlng = results[0].geometry.location;
                gmap.map.setZoom(15);
                gmap.setCenter(latlng.lat(), latlng.lng());
                gmap.addMarker({
                    lat: latlng.lat(),
                    lng: latlng.lng()
                });
            }
        }
    });

}

//search for mobile with showbox
function findlocation2() {
    var a = '';
	
	var a = prompt("Please enter address", ",hanoi,vietnam");

	if (a == null) {
		return '';
	}
	
    GMaps.geocode({
        address: a,
        callback: function(results, status) {
            if (status == 'OK') {
                var latlng = results[0].geometry.location;
                gmap.map.setZoom(15);
                gmap.setCenter(latlng.lat(), latlng.lng());
                gmap.addMarker({
                    lat: latlng.lat(),
                    lng: latlng.lng()
                });
            }
        }
    });

}

//require http://google-maps-utility-library-v3.googlecode.com/svn/trunk/geolocationmarker/src/geolocationmarker-compiled.js
function mylocation2(map) {

	var GeoMarker;

	GeoMarker = new GeolocationMarker();
	GeoMarker.setCircleOptions({fillColor: '#808080'});

	google.maps.event.addListenerOnce(GeoMarker, 'position_changed', function() {
	  map.setCenter(this.getPosition());
	  map.fitBounds(this.getBounds());
	});

	google.maps.event.addListener(GeoMarker, 'geolocation_error', function(e) {
	  alert('There was an error obtaining your position. Message: ' + e.message);
	});

	if(!navigator.geolocation) {
		alert('Your browser does not support geolocation');
	}
	GeoMarker.setMap(map);
}

function deleteMarkers() {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(null);
    }
    markers = [];
}

function viewQH(code) {

	setMapType(code);

	//remove maptype
	try {
		gmap.map.overlayMapTypes.setAt(0, null);
		gmap.map.overlayMapTypes.removeAt(0);
		gmap.map.overlayMapTypes.setAt(0, null);
		//mapOnOff = false;		
	} catch (ex) {
		alert(ex.message)
	}	

	customMapType = new google.maps.ImageMapType(options);
	gmap.map.overlayMapTypes.insertAt(0, customMapType);

	gmap.map.setZoom(parseInt(options.minZoom));
	gmap.setCenter(options.lat, options.lng);
	
	//set control opcity overlay. rewuire klokantech.js
	//var opacitycontrol = new klokantech.OpacityControl(gmap.map, customMapType);

}

//********************************************************************
//Ghi chu quan trong this.loadMapType = loadMapType;
//khong co ky hieu ham () giong nhu this.loadMapType = loadMapType();
//Chi co ten ham trong phuong thuc
//********************************************************************
var options = [];

function setMapType(code) {

	//lay du lieu	
	readdata(code);
	
	var da = new data();
	var pth = da.path;

	//var getCord = new getCordfile();
    options = {
        getTileUrl: function(coord, zoom) {

            var nCoord = getNormalizedCoord(coord, zoom);
			
/* 			//phuong an 1 : tinh toan min max cord
			//Lay toa do minmax tuong ung voi zoom hien hanh			
            var meCord = getCord.getminmaxcord(zoom);
			
			if (!nCoord) {
			 return null;
			}
			if (!meCord.minX || !meCord.maxX || !meCord.minY || !meCord.maxY) {
			 return null;
			} 
			if (nCoord.x >= meCord.minX && nCoord.x <= meCord.maxX && nCoord.y >= meCord.minY && nCoord.y <= meCord.maxY) {
			return pth + 'Z' + zoom + "/" + nCoord.y + "/" + nCoord.x + ".png"; // replace that with a "real" URL 				 
			} 
			return null; */
			
			//phuong an 2 : khong can tinh toan min max cord
 			if (!nCoord) {
				return null;
			}
			return pth + "Z" + zoom + "/" + nCoord.y + "/" +nCoord.x + ".png"; 
        },
        alt: "Ban do Quy hoach",
        tileSize: new google.maps.Size(256, 256),
        isPng: true,
        maxZoom: da.zoomax,
        minZoom: da.zoomin,
        opacity: 1,
        lat: da.lat,
        lng: da.lng,
        name: "My Map Set Name"
    };

}

function getNormalizedCoord(coord, zoom) {
    var y = coord.y;
    var x = coord.x;

    var tileRange = 1 << zoom;

    if (y < 0 || y >= tileRange) {
        return null;
    }
    if (x < 0 || x >= tileRange) {
        x = (x % tileRange + tileRange) % tileRange;
    }

    return {
        x: x,
        y: y
    };
}

function showabout(){
var a = '-Thông tin Quy hoạch trên trang này chỉ có tính chất tham khảo. \n -Mục đích để định hướng cho các bạn về một đường giao thông có thể có tại khu vực. \n -Các thông tin chính xác chỉ có được khi bạn liên hệ với cơ quan có thẩm quyền xác nhận và cung cấp thông tin quy hoạch. \n -Thông tin có sai số nhất định so với bản nền của Googlemap. \n -Thông tin này chưa phải là mới nhất, có thể đã bị sửa đổi bởi nhà nước.'
alert(a);
}

