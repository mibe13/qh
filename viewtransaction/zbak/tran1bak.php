<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>

    </title>
    <style type="text/css">
        html {
            height: 100%;
        }
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        .listview_image {
            width: 25%;
            height: 50px;
            float: left;
            border-top: 1px solid #598857;
        }
        .listview_text {
            width: 75%;
            height: 50px;
            float: left;
            cursor: pointer;
            font-size: 13px;
            border-top: 1px solid #598857;
        }
    </style>
        <script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

        <script src="../Googlemap/js/global.js"></script>
        <script src="../Googlemap/js/gmap.js"></script>
        <script src="../Googlemap/js/getdata.js"></script>
        <script src="../Googlemap/js/inforwindow.js"></script>

        <script type="text/javascript">
            var ipage;
            var ipagemax;
            var totalitem;

            //google.maps.event.addDomListener(window, 'load', load1);
            //window.onload = initialize;

            function load1() {
/*                 initialize();        

                //Fisrt time Load Googlemap must have
                //http://stackoverflow.com/questions/832692/how-to-check-if-google-maps-is-fully-loaded
                google.maps.event.addListenerOnce(map, 'idle', function() {
                    $(document).ready(function() {
                        doScreen();
                    });
                }); */

            }

            function doScreen() {
                closeBubble();
                ipage = 1;
                Bound2Label();
                addmarker();
                updateviewlist();
            }

            var bound; // boundary of view

            function Bound2Label() {
                if (map.getBounds()) {
                    bound = map.getBounds();
                }

                if (bound) {
                    var script = document.getElementById('Label1');
                    script.innerHTML = 'Center: ' + getCenter() + ' | Zoom:' + map.getZoom() + ' | Bound: ' + bound;
                }
            }


            //Add marker into gmap control
            function addmarker() {

                //Get cordlist
                //get1("getcord.aspx?bound=" + bound.toString());

                if (markerClusterer) {
                    markerClusterer.clearMarkers();
                }
				
                //var markerImage = new google.maps.MarkerImage(imageUrl, new google.maps.Size(24, 32));
                DeleteAllMarkers();

                var arr = [];
                var arrCord = [];
                var i;

                arr = html.split(";");

                html = null; //reset html to null

                //i = 0; i < arr.length; i++
                for (i in arr) {
                    arrCord = arr[i].split(",");

                    var MarkerOption = {
                        position: new google.maps.LatLng(parseFloat(arrCord[1]), parseFloat(arrCord[2])),
                        //draggable: false,
                        title: arrCord[0].toString(),
                        icon: 'Googlemap/icon/cir16.png',
                        //clickable: true,
                        //html: '' ,
                        //id: arrCord[0].toString(),                
                        map: map
                    };

                    var marker = new google.maps.Marker(MarkerOption);
                    google.maps.event.addListener(marker, 'click', function(event) {
                        //add inforBubble or inforwindow
                        inforBubblev3(this, this.title);
                        //inforwindowv3(this, this.title);
                    })

                    Markers.push(marker); // store markers	              
                    marker = null;

                } //end for

                ipagemax = Math.ceil(i / 25);
                totalitem = i.toString();

                // add MarkerClusterer
                doMarkerClusterer();

                arr.length = 0;
                arrCord.length = 0;
                map.setCenter(map.getCenter());

                html = null; //reset html to null
            }


            function updateviewlist() {

                var ele = document.getElementById('totalitem');

                //alert('Page ' + ipage.toString() + '/' + ipagemax.toString() + ' (Total ' + totalitem.toString() + ') ');
                ele.innerHTML = 'Page ' + ipage.toString() + '/' + ipagemax.toString() + ' (Total ' + totalitem.toString() + ') ';

                //Get cordlist
                //alert("getcord.aspx?listview=" + bound.toString() + '&ipage=' + ipage.toString());
                //get1("getcord.aspx?listview=" + bound.toString() + '&ipage=' + ipage.toString());

                ele = document.getElementById('ListviewDetail');
                ele.innerHTML = html;

                //bound = null;
                html = null; //reset html to null

            }

            function setpage(a) {

                if (a == true) {
                    if (ipage < ipagemax) {
                        ipage += 1;
                        updateviewlist();
                    }
                } else {
                    if (ipage > 1) {
                        ipage -= 1;
                        updateviewlist();
                    }
                }

            }
        </script>

</head>

<body>
<div style="width: 100%; height: 6%;">
	<div id="" style="background-color: #F2F2F2;">
		<div style="width: 25%; height: 100%;">
			<img src="logo/logo01.png" alt="Pulpit rock" style="width: 100%; height: 100%;">
		</div>
	</div>
</div>

<div id="view1" style="width: 100%; height: 94%;">
	<div id="gmaplistview1_viewmapall" style="width: 100%; height: 100%;">
		<div id="Listview" class="Listview" style="width: 25%; height: 100%; float: left;">
			<form method="post" action="viewTransaction.aspx" id="form1">
				<div id="Div4" style="width: 100%; height: 3.5%; background-color: #00FFFF; text-align:center;">
					<div id="gmaplistview1_UpdatePanel1" style="background-color: #00FFFF;">
						<button type="button" onclick="setpage(false)" style="font-size: 12px; float: left;">Previous</button>
						<button type="button" onclick="setpage(true)" style="font-size: 12px; float: left;">Next</button>
						<div id="totalitem" style="float: right;"></div>
					</div>
				</div>
			</form>
			<div id="ListviewDetail" style="Width: 100%; Height: 95%; overflow: auto;background: darkgrey;"></div>
		</div>
		<div id="Mapview" style="width: 75%; height: 100%; float: left;">
			<div id="gmaplistview1_Panel1" style="height:96%;width:100%;">

				<div id="googlemap" style="width: 100%; height: 98%;background: aquamarine;"></div>
				<div id="Label1" style="width: 100%; height: 2%; font-size:10px;background-color: #D8D8D8;">gfgfdgdfgdf</div>
			</div>
		</div>
	</div>
</div>
</body>

</html>