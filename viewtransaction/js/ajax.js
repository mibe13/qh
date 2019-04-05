//Ajax
var content = '';

var result = '';
function point2marker() {

	result = '';
	var parameter = bound2parameter();
	
	if (bound.length == 0) {
		return;
	}
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else { // code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {

		if (xmlhttp.readyState === 4) {
			// Makes sure the document is ready to parse.
			if (xmlhttp.status === 200) {
				// Makes sure it's found the file.
				result = xmlhttp.responseText;
			}
		}
	}
	xmlhttp.open("GET", "getlatlngpoints.php?" + parameter, false);
	xmlhttp.send();
}

var pt2list = '';
function poin2list() {

	pt2list = '';
	var parameter = bound2parameter();
	
	if (bound.length == 0) {
		return;
	}
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else { // code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {

		if (xmlhttp.readyState === 4) {
			// Makes sure the document is ready to parse.
			if (xmlhttp.status === 200) {
				// Makes sure it's found the file.
				pt2list = xmlhttp.responseText;
			}
		}
	}
	xmlhttp.open("GET", "getpointlist.php?" + parameter, false);
	xmlhttp.send();
}

function ajaxMarkerdetail(item) {

	content = '';
	
	if (bound.length == 0) {
		return;
	}
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else { // code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {

		if (xmlhttp.readyState === 4) {
			// Makes sure the document is ready to parse.
			if (xmlhttp.status === 200) {
				// Makes sure it's found the file.
				content = xmlhttp.responseText;
			}
		}
	}
	xmlhttp.open("GET", "getmarkerdetail.php?item=" + item, false);
	xmlhttp.send();
}

function bound2parameter(){
	var pat = /[0-9.]+/g;
	var ar = bound.toString().match(pat);
	var text = "x1=" + ar[0].toString() + "&y1=" + ar[1].toString() + 
				"&x2=" + ar[2].toString() + "&y2=" + ar[3].toString();
	return text; 
}