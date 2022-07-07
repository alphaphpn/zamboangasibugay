var xmlhttp_homedomain = new XMLHttpRequest();
xmlhttp_homedomain.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		var myObj_homedomain = JSON.parse(this.responseText);

		document.getElementById("HomeDomain").href = myObj_homedomain.xHomeDomain;
	}
};
xmlhttp_homedomain.open("GET", "inc/webconfig", true);
xmlhttp_homedomain.send();