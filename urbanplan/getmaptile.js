//data like :
//path=hanoi\2030to2050\roadincenter\;zmax=16;zmin=12;cenlat=21.0358789992891;cenlng=105.82889603173825;
var maptiledata ='';

//format value: code=value
function readdata(vlue) {

    maptiledata = '';
    if (vlue.length == 0) {
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
                maptiledata = xmlhttp.responseText;
            }
        }
    }
    xmlhttp.open("GET", "getmaptile.php?code=" + vlue, false);
    xmlhttp.send();
}

//get
function data(){

	var pat = '';
	var temp = '';
	
	// regex ?<= is not working
	pat = 'path=[^;]+'; 
	temp = maptiledata.toString().match(pat,'i');
	var pth = temp.toString().replace('path=', '');

	temp ='';
	pat = 'zmax=[^;]+'; 
	temp = maptiledata.toString().match(pat,'i');
	var zmax = temp.toString().replace("zmax=", "");
	
	temp ='';	
	pat = 'zmin=[^;]+'; 
	temp = maptiledata.toString().match(pat,'i');
	var zmin = temp.toString().replace("zmin=", "");
	
	temp ='';
	pat = 'cenlat=[^;]+'; 
	temp = maptiledata.toString().match(pat,'i');
	var cenlat = temp.toString().replace("cenlat=", "");
	
	temp ='';
	pat = 'cenlng=[^;]+'; 
	temp = maptiledata.toString().match(pat,'i');
	var cenlng = temp.toString().replace("cenlng=", "");

	return {
		path: pth,
		lat: cenlat,
		lng: cenlng,
        zoomax: zmax,
        zoomin: zmin
    };
	
}