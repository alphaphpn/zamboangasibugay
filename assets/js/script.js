// When the user scrolls down 80px from the top of the document, resize the navbar's padding and the logo's font size
window.onscroll = function() {scrollFunction()};

/** No remove 1st 3 char **/
$(document).ready(function() {
	$(".notrem3char").on("keyup", function() {
		var value = $(this).val();
		$(this).val($(this).data("initial") + value.substring(3));
	});

	$('#signout').on('click', function(event) {
		x = gapi.auth2.getAuthInstance().disconnect();
		console.log(x);
		location.reload();
	});

	$('#therefresh').on('click', function(event) {
		x = gapi.auth2.getAuthInstance().disconnect();
		console.log(x);
		location.reload();
	});

	// avoid zero value
	$('#ghqty, .none-zero-input').on('keyup', function(event) {
		let v = parseInt(this.value);
		if (v < this.min) this.value = this.min;
		if (v > this.max) this.value = this.max;
	});
});

/** Disable form submissions if there are invalid fields **/
(function() {
	'use strict';
	window.addEventListener('load', function() {
		// Get the forms we want to add validation styles to
		var forms = document.getElementsByClassName('needs-validation');
		// Loop over them and prevent submission
		var validation = Array.prototype.filter.call(forms, function(form) {
			form.addEventListener('submit', function(event) {
				if (form.checkValidity() === false) {
					event.preventDefault();
					event.stopPropagation();
				}
				form.classList.add('was-validated');
			}, false);
		});
	}, false);
})();

/** Auto Current Date on Input **/
let today = new Date().toISOString().substr(0, 10);
$('input[type=date]').val(today);

/** Filter/Search Data/Info on Table Tag AJAX **/
$(document).ready(function(){
	$(".xfilterData").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$(".xdispDataOnList tbody tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});
});

/** Back button **/
function goBack() {
	window.history.back();
}

/** Password **/
function PwHideShow() {
	var x = document.getElementById("passcode");
	if (x.type === "password") {
		x.type = "text";
		$('#show_hide_password i').removeClass( "fa-eye-slash" );
		$('#show_hide_password i').addClass( "fa-eye" );
	} else {
		x.type = "password";
		$('#show_hide_password i').addClass( "fa-eye-slash" );
		$('#show_hide_password i').removeClass( "fa-eye" );
	}
}

function PwHideShow1() {
	var x = document.getElementById("passcode1");
	if (x.type === "password") {
		x.type = "text";
		$('#show_hide_password1 i').removeClass( "fa-eye-slash" );
		$('#show_hide_password1 i').addClass( "fa-eye" );
	} else {
		x.type = "password";
		$('#show_hide_password1 i').addClass( "fa-eye-slash" );
		$('#show_hide_password1 i').removeClass( "fa-eye" );
	}
}

function PwHideShow2() {
	var x = document.getElementById("passcode2");
	if (x.type === "password") {
		x.type = "text";
		$('#show_hide_password2 i').removeClass( "fa-eye-slash" );
		$('#show_hide_password2 i').addClass( "fa-eye" );
	} else {
		x.type = "password";
		$('#show_hide_password2 i').addClass( "fa-eye-slash" );
		$('#show_hide_password2 i').removeClass( "fa-eye" );
	}
}

function PwHideShow3() {
	var x = document.getElementById("psecans");
	if (x.type === "password") {
		x.type = "text";
		$('#show_hide_password3 i').removeClass( "fa-eye-slash" );
		$('#show_hide_password3 i').addClass( "fa-eye" );
	} else {
		x.type = "password";
		$('#show_hide_password3 i').addClass( "fa-eye-slash" );
		$('#show_hide_password3 i').removeClass( "fa-eye" );
	}
}

/** Mobile link target **/
function FnPhoneURLTarget(elem) {
	var phoneurl;
	var value = elem.title;
	var chooseTarget = prompt("Type 'p' for phone; 'w' for whatsapp; 't' for telegram", "p");
	switch(chooseTarget) {
		case "p":
			phoneurl = "tel:" + value;
			break;
		case "w":
			phoneurl = "//web.whatsapp.com/send?phone=%2B" + value + "&text=Hello&app_absent=0";
			break;
		case "t":
			phoneurl = "https://telegram.me/" + value;
			break;
		default:
		phoneurl = "#";
	}

	elem.target = '_blank';
	elem.href = phoneurl;
}

/** Forgot Password: Empty Username not proceed **/
function fnforgotpw(usemail) {
	const input_unamez = document.querySelector("#username");
	let name = input_unamez.value;
	if (name==null || name.length==0) {
		alert("Enter Username.");
	} else {
		window.open("../../routes/forgotpw?usemail="+usemail, "_self");
	}
};

/** disable/remove only first space on input field **/
$(function() {
	$('body').on('keydown', 'input', function(e) {
		// console.log(this.value);
		if (e.which === 32 &&  e.target.selectionStart === 0) {
			return false;
		}  
	});
});

function onSignIn(googleUser) {
	// Useful data for your client-side scripts:
	var profile = googleUser.getBasicProfile();
	var g_id = profile.getId();
	var g_fullname = profile.getName();
	var g_fname = profile.getGivenName();
	var g_surname = profile.getFamilyName();
	var g_img_url = profile.getImageUrl();
	var g_email = profile.getEmail();
	var g_username = g_email.substring(0, g_email.lastIndexOf("@"));
	var id_token = googleUser.getAuthResponse().id_token;

	$('#imgogsrc2').attr("src",g_img_url);
	$('#imgurl2').val(g_img_url);
	$('#gogid').val(g_id);
	$('#username2').val(g_username);
	$('#email2').val(g_email);
	$('#fullname2').val(g_fullname);
	$('#lastname2').val(g_surname);
	$('#firstname2').val(g_fname);
	$('#tokenidz2').html(id_token);
	$('#gmailz').html(g_email);
	$('#yrfullnem').html(g_fullname);

	console.log(id_token);

	$('.g-signin2').hide();
	$('#loggdas').html("Logged in as");
	$('#therefresh').html("Cancel");
	$('#loginpost').hide();
	$('#loginbkhome').hide();
	$('#signincurr').show();
	$('#loginpost').attr("method","");
	$('#loginpost').remove();

	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'https://oauth2.googleapis.com/tokeninfo?');
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.onload = function() {
		const myObj = JSON.parse(xhr.responseText);
		console.log(myObj.sub);
	};
	xhr.send('id_token=' + id_token);

	x = gapi.auth2.getAuthInstance().disconnect();
	console.log(x);
}

/** Slide Top Animate **/
$(document).ready(function(){
	// Add smooth scrolling to all links in navbar + footer link
	$(".navbar a, footer a[href='#myHome']").on('click', function(event) {
		// Make sure this.hash has a value before overriding default behavior
		if (this.hash !== "") {
			// Prevent default anchor click behavior
			event.preventDefault();

			// Store hash
			var hash = this.hash;

			// Using jQuery's animate() method to add smooth page scroll
			// The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
			$('html, body').animate({
				scrollTop: $(hash).offset().top
			}, 900, function(){
				// Add hash (#) to URL when done scrolling (default click behavior)
				window.location.hash = hash;
			});
		} // End if
	});

	$(window).scroll(function() {
		$(".slideanim").each(function(){
			var pos = $(this).offset().top;

			var winTop = $(window).scrollTop();
			if (pos < winTop + 600) {
				$(this).addClass("slide");
			}
		});
	});

	$(window).on("load", function () {
		var urlHash = window.location.href.split("#")[1];
		if (urlHash &&  $('#' + urlHash).length )
		$('html,body').animate({
			scrollTop: $('#' + urlHash).offset().top-200
		}, 1000);
	});
});

function VerifyUploadSizeIsOK() {
	/* Attached file size check. Will Bontrager Software LLC, https://www.willmaster.com */
	var UploadFieldID = "itemfilenem";
	var MaxSizeInBytes = 500000;
	var fld = document.getElementById(UploadFieldID);
	if( fld.files && fld.files.length == 1 && fld.files[0].size > MaxSizeInBytes )
	{
		alert("The file size must be no more than 500kb");
		return false;
	}
	return true;
}

function incrementValue(e) {
	e.preventDefault();
	var fieldName = $(e.target).data('field');
	var parent = $(e.target).closest('div');
	var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);
	let maxNumb = parseInt(document.getElementById("ghqty").max);

	if (!isNaN(currentVal)) {
		if (currentVal > (maxNumb-1)) {
			parent.find('input[name=' + fieldName + ']').val(maxNumb);
		} else {
			parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
		}
	} else {
		parent.find('input[name=' + fieldName + ']').val(0);
	}
}

function decrementValue(e) {
	e.preventDefault();
	var fieldName = $(e.target).data('field');
	var parent = $(e.target).closest('div');
	var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);
	let minNumb = parseInt(document.getElementById("ghqty").min);

	if (!isNaN(currentVal) && currentVal > 0) {
		if (currentVal < (minNumb+1)) {
			parent.find('input[name=' + fieldName + ']').val(minNumb);
		} else {
			parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
		}
	} else {
		parent.find('input[name=' + fieldName + ']').val(0);
	}
}

$('.input-group').on('click', '.button-plus', function(e) {
	incrementValue(e);
});

$('.input-group').on('click', '.button-minus', function(e) {
	decrementValue(e);
});

$(document).ready(function(){
	$('.slick-frontbanner').slick({
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		autoplay: true,
		autoplaySpeed: 5000,
		arrows: true,
		dots: true
	});

	$('.slick-products').slick({
		infinite: false,
		slidesToShow: 5,
		slidesToScroll: 1,
		autoplay: false,
		autoplaySpeed: 10000,
		arrows: false,
		responsive: [
			{
				breakpoint: 992,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 1
				}
			},
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1
				}
			},
			{
				breakpoint: 599,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
				}
			}
		]
	});
});