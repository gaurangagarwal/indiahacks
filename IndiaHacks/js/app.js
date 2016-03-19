
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
/*****************************************/

var dString = "", dLat, dLon, iString;
var dist;
var flag = true;
function calc()
{
	var R = 6371000;
	var latDiff = dLat - iLat;
	var lonDiff = dLon - iLon;
	var a  = (Math.sin(latDiff*Math.PI/360))*(Math.sin(latDiff*Math.PI/360)) + Math.cos(iLat*Math.PI/180)*Math.cos(dLat*Math.PI/180)*Math.sin(lonDiff*Math.PI/360)*Math.sin(lonDiff*Math.PI/360);
	var c = 2*Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
	dist = R*c;
	console.log("DISTANCE -- ", dist);
};
var iLat, iLon;
var kk, miles;
function showPosition(position) {
	iLat = position.coords.latitude; 
	iLon = position.coords.longitude;
	console.log(iLat);
	console.log(iLon);
	calc();
	miles = Math.round(dist*0.621371);
	miles = miles/1000;
	kk = Math.round(dist);
	kk = kk/1000;
	document.getElementById("city").innerHTML = "&nbsp;" + dString;
	document.getElementById("desc").innerHTML = kk + " Kilometers<br/>&nbsp;" + miles + " Miles<br/>&nbsp;" + "Your Alarm Has Been Set. So ..<br/>" + "<br/><center><h2 style = 'color:#FFCC66'>SLEEP</h2>&nbsp;I'll Wake You Up!</center>";
	if(dist>2000)
		flag = true;
	else
		flag = false;
		
}
var stop = 1;
function Cancel()
{
	document.getElementById("descp").style.zIndex = "-1";
	document.getElementById("geocomplete").value = "";
	dString = "";
	document.getElementById("descp").style.opacity = "0";
	document.getElementById("descp").style.left = "-100%";
	document.getElementById("descp").style.transform = "scale(0.5)";
	document.getElementById("box").style.left = "0%";
	document.getElementById("enter").style.left = "0%";
	flag==true;
	stop = 3;
	document.getElementById("cancel").style.zIndex = "-1";
	document.getElementById("cancel").style.opacity = "0";
	document.getElementById("cancel").style.left = "100%";
	
}
function Stop()
{
	document.getElementById("myalarm").pause();
	flag==true;
	stop = 3;
	document.getElementById("stop_alarm").style.transition = "opacity 1s";
	document.getElementById("stop_alarm").style.opacity = 0;
	document.getElementById("stop_alarm").style.zIndex = -1;
	document.getElementById("stop_alarm").style.opacity = "0";
	document.getElementById("stop_alarm").style.zIndex = "-1";
	document.getElementById("stop_alarm").style.transform = "scale(0.8)";
}
function Alarm()
{
	document.getElementById("cancel").style.zIndex = "-1";
	document.getElementById("cancel").style.opacity = "0";
	document.getElementById("cancel").style.left = "100%";
	document.getElementById("myalarm").play();
	document.getElementById("stop_alarm").style.transition = "opacity 1s";
	document.getElementById("stop_alarm").style.opacity = 1;
	document.getElementById("stop_alarm").style.zIndex = 0;
	document.getElementById("stop_alarm").style.left = "0%";
	document.getElementById("stop_alarm").style.transform = "scale(1)";
};

function ui()
{
	if(dString == "")
		return;
	document.getElementById("descp").style.zIndex = "0";
	document.getElementById("descp").style.opacity = "1";
	document.getElementById("descp").style.left = "0%";
	document.getElementById("descp").style.transform = "scale(1)";
	document.getElementById("box").style.left = "200%";
	document.getElementById("enter").style.left = "200%";
	document.getElementById("cancel").style.zIndex = "0";
	document.getElementById("cancel").style.opacity = "1";
	document.getElementById("cancel").style.left = "0%";
}
function uiA()
{
	document.getElementById("descp").style.zIndex = "-1";
	document.getElementById("geocomplete").value = "";
	dString = "";
	document.getElementById("descp").style.opacity = "0";
	document.getElementById("descp").style.left = "-100%";
	document.getElementById("descp").style.transform = "scale(0.5)";
	document.getElementById("box").style.left = "0%";
	document.getElementById("enter").style.left = "0%";
}
var disttt;
function Algo()
{
			ui();
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(showPosition);
			} else { 
				console.log("Geolocation is not supported by this browser.");
			}
			if(flag)
			{
				setTimeout(function(){ Algo(); }, 3000);
				return;
			}
			else
			{
				if(stop == 3)
				{
					stop = 1;
					return;
				}
				stop = 2;
				uiA();
				Alarm();
				return;
			}
};