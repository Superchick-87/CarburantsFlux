// /*----------  Constructeur  ----------*/
// function Distance(mylat,mylong,lat,long){
//             this.mylati = mylat;
//             this.mylongi = mylong;
//             this.lati = lat;
//             this.longi = long;

// 	/*----------  Prototype  ----------*/
// 	this.Distance = function() {
	       
// 	    }
//   }3456426
navigator.geolocation.getCurrentPosition(coordonnees);
function coordonnees(position) {
  	latitude = position.coords.latitude;
  	longitude = position.coords.longitude;
  	document.getElementById("p1").value = latitude;
  	document.getElementById("p2").value = longitude; 
	// console.log("dis. "+distance(latitude,longitude,48.856614,1.3522219, 'K').toFixed(2)+" km");
};

// console.log("dis. "+distance(toto,1.3522219,48.856614,1.3522219, 'K').toFixed(2)+" km");
// alert(latitude)
// var id, target, options;

// function success(pos) {
//   var crd = pos.coords;

//   if (target.latitude === crd.latitude && target.longitude === crd.longitude) {
//     alert('Congratulations, you reached the target');
//     navigator.geolocation.clearWatch(id);
//   }
// }

// function error(err) {
//   console.warn('ERROR(' + err.code + '): ' + err.message);
// }

// target = {
//   latitude : 0,
//   longitude: 0
// };

// options = {
//   enableHighAccuracy: false,
//   timeout: 5000,
//   maximumAge: 0
// };

// id = navigator.geolocation.watchPosition(success, error, options);
// alert(id)

	function distance(lat1, lon1, lat2, lon2, unit) {
		if ((lat1 == lat2) && (lon1 == lon2)) {
			return 0;
		}
		else {
			var radlat1 = Math.PI * lat1/180;
			var radlat2 = Math.PI * lat2/180;
			var theta = lon1-lon2;
			var radtheta = Math.PI * theta/180;
			var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
			if (dist > 1) {
				dist = 1;
			}
			dist = Math.acos(dist);
			dist = dist * 180/Math.PI;
			dist = dist * 60 * 1.1515;
			if (unit=="K") { dist = dist * 1.609344 }
			if (unit=="N") { dist = dist * 0.8684 }
			return dist;
		}
	}

// console.log(document.getElementById('p1').value)


// console.log("dis. "+distance(latitude,1.3522219,48.856614,2.3522219, 'K').toFixed(2)+" km");
// }
// navigator.geolocation.getCurrentPosition(coordonnees);


function prix (a){
	if (a === undefined) {
		return a = '-';
		// return this.parentNode.set = '-';
	}
	return a + "  €/l";
};

function majdate(a){
	 a = a.replace('il y a',"");
	 // a = a.replace('un',"hier");
	 a = a.replace('jours',"j");
	 a = a.replace('jour',"j");
	 a = a.replace('heures',"h");
	 a = a.replace('heure',"h");
	 a = a.replace('une',"1");
	  // a = a.replace('un',"1");
	 a = a.replace('un j',"hier");
	 return a
};

function marque(a){
	if (a.length>0) {
		 a = a.replace('Intermarché Contact',"Intermarché");
		 a = a.replace('Carrefour Market',"Carrefour");
		 a = a.replace('Système U',"U");
		 a = a.replace('Station U',"U");
		 a = a.replace('BP Express',"BP");
		 a = a.replace('INDEPENDANT',"Vide");
		 a = a.replace('Indépendant sans enseigne',"Vide");	 
	 return a;
	}
	if (a === false || a == '') {
		a = "Vide";
	 return a;
	}
};



function cp(a){
	 a = a.replace('(',"");
	 a = a.replace(')',"");
	 return a
};

var url2= './datas/communes.json';
var ff = $.getJSON(url2, function() {});
// console.log(ff)


var gg = $.getJSON(url2, function(json) {
    // console.log(json); // this will show the info it in firebug console
	// json.sort(function (a, b) {
	//    return a.commune - b.commune;
	// });
	// json.forEach(function(v) {
	//    console.log("  "+v.commune);    
	// });

	json.sort(function (a, b) {
		 if (a.commune > b.commune) {
		   return -1;
		 } else {
		   return 1;
		 };
		});
		json.forEach(function(v) {
		   // console.log("  "+v.commune);    
		});
});

var callBackSuccess = function(data) {
	var maLatitude = document.getElementById("p1").value;
	var maLongitude = document.getElementById("p2").value;
	// alert(maLatitude + "</br>" + maLongitude);
	var element = document.getElementById('done');
	var locB = document.getElementById('loc').value;
	console.log("Choix ville : "+locB);
	var locBok = locB.substr(0,(locB.length-7));
	var locBokcp = locB.substr(-4);
	
	pp = '86150';
	console.log(pp.substr(0,(pp.length-3)));



	console.log("Choix ville : "+locBok+"CP:"+cp(locBokcp)+"dxxxx");
	console.log(data.length)
	console.log(data[0].ville)
	console.log(ff)
	//console.log(data)
	
	element.innerHTML="";
	element.innerHTML = "<b><div class='flex espacebottom'><div id='nbre' class='compteur'></div><h3 class='justifleft'>"+locBok+"</h3></div></b>"
	var codehtml = "";
	
	//console.log(data)
	for (var i = 0 ; i < data.length; i++) {
	// console.log(locBokcp == data[i].ville.dept data[i].ville.station.marque.length > 0)
	if ((locBok === data[i].ville.nom) && (cp(locBokcp) == data[i].ville.dept)) {
		// if (locBokcp = data[i].ville.cp.substr(0,(data[i].ville.cp.length-3))) {
			console.log(distance(maLatitude,maLongitude,44.6333,-0.3333, 'K'));
			codehtml +=
				"<div class='xx flex justifbet'>"+
					"<div class='flex'>"+
						"<img class='marque' src='./images/logos/"+camelize(marque(data[i].ville.station.marque))+".png' >"+
						"<div class='justifleft filet'>"+
							"<div class='flex'>"+
								"<h4 class='justifleft'>"+data[i].ville.station.marque+"</h4>"+
							"</div>"+	
							// NE PAS JETER SERT À AFFICHER LA DISTANCE VI A COORDONNÉES GPS
							// "<p>"+data[i].ville.station.adresse+" - "+data[i].ville.cp+" | dis. " + distance(maLatitude,maLongitude,(data[i].ville.station.latitude/100000).toFixed(5),(data[i].ville.station.longitude*0.00001).toFixed(5), 'K').toFixed(2) + " km</p>"+
							"<p>"+data[i].ville.station.adresse+" - "+data[i].ville.cp+"</p>"+
						"</div>"+
					"</div>"+
					"<a target='_blank' href=' https://www.google.fr/maps/dir//"+(data[i].ville.station.latitude/100000)+","+(data[i].ville.station.longitude*0.00001)+"'>"+
						"<div class='itiMob'></div>"+
					"</a>"+
				"</div>"+
				"<table style='width:100%'>"+
					 //  "<tr class='lignepicto'>"+
						// "<th><img src='./images/Gazole.png'><p>Gazole</p></th>"+
						// "<th><img src='./images/price_sp98.png'><p>Sp98</p></th>"+
						// "<th><img src='./images/price_e10.png'><p>SP95-E10</p></th>"+
						// "<th><img src='./images/price_sp95.png'><p>Sp95</p></th>"+
						// "<th><img src='./images/price_gplc.png'><p>GPLc</p></th>"+
						// "<th><img src='./images/price_e85.png'><p>E85</p></th>"+
					 //  "</tr>"+
					  "<tr class='lignepicto'>"+
						"<th><p>Gazole</p></th>"+
						"<th><p>Sp98</p></th>"+
						"<th><p>SP95-E10</p></th>"+
						"<th><p>Sp95</p></th>"+
						"<th><p>GPLc</p></th>"+
						"<th><p>E85</p></th>"+
					  "</tr>"+
					  "<tr>";
			var tabcarburant = Array();
			if(data[i].ville.station.pompes.id > 0) {
				tabcarburant[data[i].ville.station.pompes.id] = data[i].ville.station.pompes.valeur;
			} else {
				for (var c = 0 ; c < data[i].ville.station.pompes.length; c++){
					tabcarburant[data[i].ville.station.pompes[c].id] = data[i].ville.station.pompes[c].valeur;
				}
			}

			var tabmaj = Array();
			if(data[i].ville.station.pompes.id > 0) {
					tabmaj[data[i].ville.station.pompes.id] = majdate(moment(data[i].ville.station.pompes.maj).startOf('day'-1).fromNow());
			} else {
				for (var r = 0 ; r < data[i].ville.station.pompes.length; r++){
					tabmaj[data[i].ville.station.pompes[r].id] = majdate(moment(data[i].ville.station.pompes[r].maj).startOf('day'-1).fromNow());
				}
			}

			if (tabcarburant[1]) codehtml += "<td class='price_gazole'>"+tabcarburant[1]+"<p class='infomaj'>Maj : "+tabmaj[1]+"</p></td>";
			else codehtml += "<td class='price_gazole'>-</td>"
			if (tabcarburant[6]) codehtml += "<td class='price_sp98'>"+tabcarburant[6]+"<p class='infomaj'>Maj : "+tabmaj[6]+"</p></td>";
			else codehtml += "<td class='price_sp98'>-</td>"
			if (tabcarburant[5]) codehtml += "<td class='price_e10'>"+tabcarburant[5]+"<p class='infomaj'>Maj : "+tabmaj[5]+"</p></td>";
			else codehtml += "<td class='price_e10'>-</td>"
			if (tabcarburant[2]) codehtml += "<td class='price_sp95'>"+tabcarburant[2]+"<p class='infomaj'>Maj : "+tabmaj[2]+"</p></td>";
			else codehtml += "<td class='price_sp98'>-</td>"
			if (tabcarburant[4]) codehtml += "<td class='price_gplc'>"+tabcarburant[4]+"<p class='infomaj'>Maj : "+tabmaj[4]+"</p></td>";
			else codehtml += "<td class='price_gplc'>-</td>"
			if (tabcarburant[3]) codehtml += "<td class='price_e85'>"+tabcarburant[3]+"<p class='infomaj'>Maj : "+tabmaj[3]+"</p></td>";
			else codehtml += "<td class='price_e85'>-</td>"
			
			codehtml += "</tr>"+
				"</table>"+
				"</div><hr>";
		}
	}
	element.innerHTML += codehtml;
	var compteur = document.getElementsByClassName('xx');
	var nbretotal = document.getElementById('nbre');
		nbretotal.innerHTML = compteur.length; 

// ERREURS

// var newDiv = document.createElement("p");
//     newDiv.setAttribute('class','erreur');
//     newDiv.setAttribute('id','erreur1');
//     var newContent = document.createTextNode ('Vous devez rentrer les premières lettres d\'une commune');
//     newDiv.appendChild(newContent);
// 	    document.body.insertBefore(newDiv, element);


    if (locB != '') {
    	document.getElementById('erreur1').style.display = 'none';
    	document.getElementById('erreur2').style.display = 'none';
    	element.style.display = "block";
    }
	if (locB == '') {
		document.getElementById('erreur1').style.display = 'block';
		document.getElementById('erreur2').style.display = 'none';
	    element.style.display = "none";
	}
	if (nbretotal.innerHTML == 0 && locB != '') {
		document.getElementById('erreur1').style.display = 'none';
    	document.getElementById('erreur2').style.display = 'block';
    	element.style.display = "none";
    }

// FIN ERREURS

	var donejs = document.getElementById("done");
	var legende = document.getElementById("legende");

	if (donejs.innerHTML == '') {
	    legende.style.display = "none";
	}
	if (donejs.innerHTML != '')
	{
	    legende.style.display = "block";
	}
};



function buttonClickGET(){
	var loc = document.getElementById('loc').value;
	var locosscp = loc.substr(0,(loc.length-7));
	var url = "./datas/prixcarburants.json";

	$.getJSON(url, callBackSuccess).done(function() {
		
		})
		.fail(function() {
			alert ("erreur");
		})
		.always(function () {
		});
}





