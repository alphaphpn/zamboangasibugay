var xmlhttp_sysconfig = new XMLHttpRequest();
xmlhttp_sysconfig.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		var myObj_sysconfig = JSON.parse(this.responseText);

		document.getElementById("AppTitle").innerHTML = myObj_sysconfig.AppTitle;
		document.getElementById("freshre").content = myObj_sysconfig.IdleTime+";";
		document.getElementById("xfavicon").href = "storage/img/"+myObj_sysconfig.AppIcon;
		document.getElementById("themestyle").href = myObj_sysconfig.ThemeName+"/assets/css/style.css";
		document.getElementById("themeScript").src = myObj_sysconfig.ThemeName+"/assets/js/script.js";
	}
};
xmlhttp_sysconfig.open("GET", "inc/webconfig/index.php", true);
xmlhttp_sysconfig.send();