
// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
var exampleApp = angular.module('starter', ['ionic'])

.run(function($ionicPlatform) {
  $ionicPlatform.ready(function() {
    // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
    // for form inputs)
    if(window.cordova && window.cordova.plugins.Keyboard) {
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
    }
    if(window.StatusBar) {
      StatusBar.styleDefault();
    }
  });
})

var dString, dLat, dLon, iString, iLat, iLon;

var dist;

function calc()
{
	var R = 6371000;
	var latDiff = dLat - iLat;
	var lonDiff = dLon - iLon;
	var a  = (Math.sin(latDiff*Math.PI/360))*(Math.sin(latDiff*Math.PI/360)) + Math.cos(iLat*Math.PI/180)*Math.cos(dLat*Math.PI/180)*Math.sin(lonDiff*Math.PI/360)*Math.sin(lonDiff*Math.PI/360);
	var c = 2*Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
	dist = R*c;
	console.log("DISTANCE -- ", dist);
}

var options = {
	enableHighAccuracy: true,
	timeout: 0,
	maximumAge: 0
}
var flag = true;
function getLocation() {
	console.log("getLocation");
    if (navigator.geolocation) {
	console.log("if of get location");
        navigator.geolocation.getCurrentPosition(showPosition, error, options);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}
function showPosition(position) {
	console.log("IN position");
	console.log(position);
    iLat = position.coords.latitude;
	iLon = position.coords.longitude;	
	console.log("Current Lat -- ", iLat);
	console.log("Current Lon -- ", iLon);
	calc();
	if(dist>2000)
		flag = true;
	else flag = false;
	
}
function error()
{
	console.log("error in get location");
}
function getI() {
	console.log("getI");
			getLocation();
}
function Algo() {
	console.log("algo");
	getI();
	console.log("algo2");
	do
	{
		getI();
		//console.log(dist);
	}while(dist>2000);
	console.log("THIS SHOULD NOT BE PRINTED");
}