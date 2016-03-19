<html>
<head>
	<title></title>
</head>
<body>
	<div>
		<a id="notificationBtn" style="left:100px; position:absolute">Notifications</a>
	</div><br>
	<div id="notificationItems" style="position:absolute">
		<a>hellow</a><br>
		<a>World</a><br>
		<a>asd</a>
	</div>
</body>
<script type="text/javascript">
	var notificationBtn = document.getElementById("notificationBtn");
	var notificationItems = document.getElementById("notificationItems");
	notificationItems.style.display = "none";
	var showNoti =  false;
	notificationBtn.onclick = function () {
		if(showNoti == false) {
			notificationItems.style.display = "block";
			notificationItems.style.left = notificationBtn.style.left;
			notificationItems.style.marginLeft = notificationItems.style.marginLeft;
			showNoti = true;
		} else {
			notificationItems.style.display = "none";
			showNoti = false;
		}
	}
</script>	
</html>