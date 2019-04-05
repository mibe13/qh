//user open inforwindow
var openbubbles = [];
var script;
script = '<script src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox.js"></script>';
document.write(script);
script = '<script src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobubble/src/infobubble.js"></script>';
document.write(script);

// This function picks up the click and opens the corresponding info window
////V2 version is: GEvent.trigger(markers[i], 'click');
////V3 version is: google.maps.event.trigger(markers[i], 'click');
function Linkclicked(i) {
    google.maps.event.trigger(Markers[i], "click");
}

function InfoWindow(marker, item) {
    closeBubble();

    var infowindow = new google.maps.InfoWindow({
        content: "",
		maxHeight: 250,
		maxWidth: 200,
		padding: 15,
		borderColor: "white",
		disableAutoPan: true,
		bachground: "#fffff"	
    });

	ajaxMarkerdetail(item);

    //alert('Ban vua Click vao marker ' + event.latLng); 
    infowindow.setContent(content);
    //infowindow.setContent(this.html);                                              
    infowindow.open(map, marker);
    //infowindow.open(map, marker);
    openbubbles.push(infowindow);
            
}

function infobox(marker, item){

    closeBubble();
	var myOptions = {
		content: "",
		isableAutoPan: false,
		//maxWidth: 0,
		pixelOffset: new google.maps.Size(-180, 75),
		//zIndex: null,
		boxStyle: { 
			background: "#BDBDBD",
			opacity: .9,
			width: "280px"
		},
		//closeBoxMargin: "2px 2px 2px 2px",
		closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif", //"http://www.google.com/intl/en_us/mapfiles/close.gif",
		//infoBoxClearance: new google.maps.Size(1, 1),
		//isHidden: false,
		alignBottom: true,
		pane: "floatPane",
		enableEventPropagation: false
	};

    var ib = new InfoBox(myOptions);

	ajaxMarkerdetail(item);
    ib.setContent('<div style="margin: 10px 10px 10px 10px;">' + content + '</div>');                                           
    ib.open(map, marker);
    openbubbles.push(ib);

}

function inforBubblev3(marker, item) {
    
    closeBubble(); 

    var infoBubble = new InfoBubble({
		content:'',
		maxHeight: 250,
		maxWidth: 200,
		padding: 15,
		borderColor: "white",
		bachground: "#fffff",
		disableAutoPan: true,
		borderRadius: 13
		//pixelOffset: new google.maps.Size(-140, -110),
    });
      
	ajaxMarkerdetail(item);
    infoBubble.setContent(content); 

    if (!infoBubble.isOpen()) {
        infoBubble.open(map, marker);
        openbubbles.push(infoBubble);
    }

}

function closeBubble(){

    //close all bubbles is openning
    if (openbubbles){
		//for (i in Markers){
		for (var i = 0; i < openbubbles.length; i++){
			openbubbles[i].close();			   
			openbubbles[i] = null;
		}
		openbubbles.length = 0;
	}

}
