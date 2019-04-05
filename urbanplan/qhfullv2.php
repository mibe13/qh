<?php
$path ='/gmaps/';
$pack = '_packed.js';
//$pack = '.js';
?>

<html>

<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />

    <style type="text/css">
        html{height: 100%;}
        	body{
        	height: 100%;
        	margin: 0;
        	padding: 0;
        	}
         	#map_canvas	{width: 100%; height: 100%;}
        	<!--#infor {
        		border: 1px solid #a1a1a1;
        		padding: 1px 1px; 
        		background: #dddddd;		
        		border-radius: 15px;
        	} -->
    </style>
    <title>Thông tin Quy hoạch</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
	<script src="../gmaps/geolocation/geolocationmarker-compiled.js"></script>
	<script src="optionplan.js"></script>
	<script src="getmaptile.js"></script>
	
    <script src="webtool_v2<?php echo $pack ?>"></script>	
	<script src="<?php echo $path ?>gmaps<?php echo $pack ?>"></script>
    <script src="<?php echo $path ?>ruler<?php echo $pack ?>"></script>
    <script src="<?php echo $path ?>labels<?php echo $pack ?>"></script>

    <script type="text/javascript">
		var gmap;

		$(document).ready(function() {
		    drawmap();
		    viewQH('hn203020050_01');
			
			google.maps.event.addListener(gmap.map, 'dragend', changelabel);
			google.maps.event.addListener(gmap.map, 'zoom_changed', changelabel);
		});
		//auto fit gmap with browser windows
		$(window).resize(function() {
		    $('#map_canvas').css("height", $(window).height());
		    $('#map_canvas').css("width", $(window).width());
		});
		//window.setInterval(function(){alert("Hey");}, 10000);

		function drawmap() {
		    gmap = new GMaps({
		        el: 'map_canvas',
		        lat: 21.043288,
		        lng: 105.820312,
		        zoom: 13,
		        zoomControl: true,
		        zoomControlOpt: {
		            style: 'DEFAULT', //'SMALL',
		            position: 'TOP_LEFT'
		        },
		        panControl: false,
		        mapTypeControl: true,
		        streetViewControl: false,
		        overviewMapControl: false,
				mapTypeControlOptions: {
					style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
					position: google.maps.ControlPosition.TOP_right,
					mapTypeIds : ["roadmap", "satellite", "osm", "hn2k"]
				}
		    });
			//"hybrid","terrain", 
			
			addMapType();
			addControl();
			
/* 			//set dropdown menu for maptype control
		    gmap.map.set('mapTypeControlOptions', {
		        style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
		        position: google.maps.ControlPosition.TOP_right
		    });	 */		
		}
		
		function addControl(){
		    // add control get current location
		    gmap.addControl({
		        position: 'top_right',
		        content: 'MyLocation',
		        style: {
		            margin: '5px',
		            padding: '1px 6px',
		            border: 'solid 1px #717B87',
		            background: '#fff'
		        },
		        events: {
		            click: function() {
		                // Define user location
		                //mylocation();
		                mylocation2(gmap.map);
		                //console.log(this);
		            }
		        }
		    });

		    // add control Ruler
		    gmap.addControl({
		        position: 'top_right',
		        content: 'Ruler',
		        style: {
		            margin: '5px',
		            padding: '1px 6px',
		            border: 'solid 1px #717B87',
		            background: '#fff'
		        },
		        events: {
		            click: function() {
		                addruler(gmap.map);
		            }
		        }
		    });

		    //add select plan option
		    gmap.addControl({
		        position: 'right_top',
		        content: content,
		        style: {
		            margin: '5px',
		            padding: '1px 1px',
		            border: 'solid 1px #717B87',
		            background: '#fff'
		        },
		        events: {
		            click: function() {
		                console.log(this);
		            }
		        }
		    });

		    //add label address
		    gmap.addControl({
		        position: 'top_right',
		        content: '<input type="text" id="add" name="address"  value=""/>',
		        style: {
		            margin: '4px',
		            padding: '0px 0px',
		            border: 'solid 0px #717B87',
		            background: '#fff'
		        },
		        events: {
		            click: function() {
		                console.log(this);
		            }
		        }
		    });

		    //add search address
		    gmap.addControl({
		        position: 'top_right',
		        content: 'Search',
		        style: {
		            margin: '5px',
		            padding: '1px 6px',
		            border: 'solid 1px #717B87',
		            background: '#fff'
		        },
		        events: {
		            click: function() {
		                findlocation();
		                console.log(this);
		            }
		        }
		    });
		    gmap.addControl({
		        position: 'top_right',
		        content: "read me first",
		        style: {
		            margin: '5px',
		            padding: '1px 1px',
		            border: 'solid 1px #FE2E2E',
		            background: 'white'
		        },
		        events: {
		            click: function() {
						showabout();
		                console.log(this);
		            }
		        }
		    });
		    //add logo
		    gmap.addControl({
		        position: 'bottom_center',
		        content: '<img src="../logo02.png"/>',
		        style: {
		            margin: '5px',
		            padding: '',
		            border: '',
		            background: ''
		        },
		        events: {
		            click: function() {
		                console.log(this);
		            }
		        }
		    });	
		    //add label to displayinfor zoom anh center
		    gmap.addControl({
		        position: 'right_bottom',
		        content: '<label id="informap"></label><div align="right">©Copyright 2013. dangthanhhai@gmail.com</div>',
		        style: {
		            margin: '5px',
		            padding: '',
		            border: '',
		            background: ''
		        },
		        events: {
		            click: function() {
		                console.log(this);
		            }
		        }
		    });		
		}
		
		function addMapType(){

			gmap.addMapType("osm", {
				getTileUrl: function(coord, zoom) {		
				  return "http://tile.openstreetmap.org/" + zoom + "/" + coord.x + "/" + coord.y + ".png";
				},
				tileSize: new google.maps.Size(256, 256),
				name: "OSM",
				alt: "OpenStreetMap",
				maxZoom: 18
			});
	
			//https://7fe8f47ae718897de837cb2193c50f6707b3b25b.googledrive.com/host/0B923x-TdOy0DMDFNekdYSGJKdE0/hanoi/bandac/2k/
			gmap.addMapType("hn2k", {
				getTileUrl: function(coord, zoom) {
					var nCoord = getNormalizedCoord(coord, zoom);
					var url = 'https://googledrive.com/host/0B923x-TdOy0DMDFNekdYSGJKdE0/hanoi/bandac/2k/';
					return url + "Z" + zoom + "/" + nCoord.y + "/" +nCoord.x + ".png"; 
				},
				tileSize: new google.maps.Size(256, 256),
				name: "hn2k",
				alt: "Ban dac hanoi",
				maxZoom: 18
			});
		}
		
		function changelabel(){
			ele = document.getElementById('informap');
			ele.innerHTML = 'Zoom= ' + gmap.map.getZoom() 
							+ ' | Center= ' + gmap.map.getCenter();
							//+ ' | Bound = ' + gmap.map.getBounds();
		}
    </script>

</head>

<body>
    <div id="map_canvas" style="width: 100%; height: 100%"></div>
</body>

</html>
