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
			
/* 		    //set dropdown menu for maptype control
		    gmap.map.set('mapTypeControlOptions', {
		        style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
		        position: google.maps.ControlPosition.TOP_right
		    }); */
			
			//only for deskop view
/* 			google.maps.event.addListener(gmap.map, 'dragend', changelabel);
			google.maps.event.addListener(gmap.map, 'zoom_changed', changelabel); */
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
				mapTypeControlOptions: {
					style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
					position: google.maps.ControlPosition.TOP_right,
					mapTypeIds : ["roadmap", "satellite", "terrain"]
				},
		        streetViewControl: false,
		        overviewMapControl: false
		    });

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

		    gmap.addControl({
		        position: 'right_top',
		        content: "read me first",
		        style: {
		            margin: '5px',
		            padding: '1px 1px',
		            border: 'solid 1px #FE2E2E', //#717B87
		            background: '#fff'
		        },
		        events: {
		            click: function() {
						showabout();
		                console.log(this);
		            }
		        }
		    });
		    //add label address
			//only show on web in desktop
/* 		    gmap.addControl({
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
		    }); */

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
		                findlocation2(); //for mobile
		                console.log(this);
		            }
		        }
		    });

		    //add logo fro mobile
		    gmap.addControl({
		        position: 'right_bottom',
		        content: '<img style="width: 150px; height: 25px; align: right;" src="../logo02.png"/><div>©Copyright 2013. dangthanhhai@gmail.com</div>',
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
		    //add label to displayinfor zoom anh center --> only for desktop
/* 		    gmap.addControl({
		        position: 'right_bottom',
		        content: '<label id="informap">Infor: </label>',
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
		    });	 */			
			
		}
		
/* 		function changelabel(){
			ele = document.getElementById('informap');
			ele.innerHTML = 'Zoom= ' + gmap.map.getZoom() 
							+ ' | Center= ' + gmap.map.getCenter();
							//+ ' | Bound = ' + gmap.map.getBounds();
		} */
    </script>

</head>

<body>
    <div id="map_canvas" style="width: 100%; height: 100%"></div>
</body>

</html>
