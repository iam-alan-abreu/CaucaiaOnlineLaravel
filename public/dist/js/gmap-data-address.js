
        
// <reference path="../jquery.min.js" />

//Useful links:
// http://code.google.com/apis/maps/documentation/javascript/reference.html#Marker
// http://code.google.com/apis/maps/documentation/javascript/services.html#Geocoding
// http://jqueryui.com/demos/autocomplete/#remote-with-cache

var geocoder;
var map;
var marker;

function initialize() {
//MAP
var latlng = new google.maps.LatLng(-3.7166638 , -38.6499974);
var options = {
zoom: 12,
center: latlng,
mapTypeId: google.maps.MapTypeId.ROADMAP
};

map = new google.maps.Map(document.getElementById("mapaAddress"), options);

//GEOCODER
geocoder = new google.maps.Geocoder();

marker = new google.maps.Marker({
map: map,
draggable: true,
});

marker.setPosition(latlng);
}

$(document).ready(function () {

initialize();

$(function () {


$("#endereco").blur(
	function() {
		if($(this).val() != "")
		{
			carregarNoMapa();
		}                
	}
)

$("#btnEndereco").click(
	function() {
		carregarNoMapa();
	}
)

function carregarNoMapa() {
	geocoder.geocode({ 'address': $("#endereco").val() + ', Caucaia', 'region': 'BR' }, function (results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
			if (results[0]) {  
				var latitude = results[0].geometry.location.lat();
				var longitude = results[0].geometry.location.lng();

				$('#endereco').val(results[0].formatted_address);
				$('#latitude').val(latitude);
				$('#longitude').val(longitude);

				var location = new google.maps.LatLng(latitude, longitude);
				marker.setPosition(location);
				map.setCenter(location);
				map.setZoom(16);
			}
		}
	})
}

$("#endereco").autocomplete({
	//This bit uses the geocoder to fetch address values
	source: function (request, response) {
		geocoder.geocode({ 'address': request.term + ', Caucaia', 'region': 'BR' }, function (results, status) {
			response($.map(results, function (item) {
				return {
					label: item.formatted_address,
					value: item.formatted_address,
					latitude: item.geometry.location.lat(),
					longitude: item.geometry.location.lng()
				}
			}));
		})
	},
	//This bit is executed upon selection of an address
	select: function (event, ui) {
		$("#latitude").val(ui.item.latitude);
		$("#longitude").val(ui.item.longitude);
		var location = new google.maps.LatLng(ui.item.latitude, ui.item.longitude);
		marker.setPosition(location);
		map.setCenter(location);
		map.setZoom(16);
	}
});
});

//Add listener to marker for reverse geocoding
google.maps.event.addListener(marker, 'drag', function () {
geocoder.geocode({ 'latLng': marker.getPosition() }, function (results, status) {
	if (status == google.maps.GeocoderStatus.OK) {
		if (results[0]) {  
			$('#endereco').val(results[0].formatted_address);
			$('#latitude').val(marker.getPosition().lat());
			$('#longitude').val(marker.getPosition().lng());
		}
	}
});
});

//$("#endereco").focus();


});
