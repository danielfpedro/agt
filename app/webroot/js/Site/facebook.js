// This is called with the results from from FB.getLoginStatus().
function statusChangeCallback(response) {
	console.log('statusChangeCallback');
	console.log(response);
	
	// The response object is returned with a status field that lets the
	// app know the current login status of the person.
	// Full docs on the response object can be found in the documentation
	// for FB.getLoginStatus().
	if (response.status === 'connected') {
		// Logged into your app and Facebook.
		loginFacebook();
	} else if (response.status === 'not_authorized') {
		// The person is logged into Facebook, but not your app.
		console.log('nao logada no app');
		loginFacebook();
	} else {
		// The person is not logged into Facebook, so we're not sure if
		// they are logged into this app or not.
		console.log('The person is not logged into Facebook, so were not sure if they are logged into this app or not.');
		loginFacebook();
	}
}

// This function is called when someone finishes with the Login
// Button.  See the onlogin handler attached to it in the sample
// code below.
function checkLoginState() {
	FB.getLoginStatus(function(response) {
		statusChangeCallback(response);
	});
}

function loginFacebook() {
	FB.login(function(response) {
		if (response.authResponse) {
			console.log('logou joia');
			testAPI();
		} else {
			console.log('User cancelled login or did not fully authorize.');
		}
	}, {scope: 'email', return_scopes: true});
}

window.fbAsyncInit = function() {
	FB.init({
		appId      : '515451498581874',
		cookie     : true,  // enable cookies to allow the server to access 
		// the session
		xfbml      : true,  // parse social plugins on this page
		version    : 'v2.0' // use version 2.0
	});
// Now that we've initialized the JavaScript SDK, we call 
// FB.getLoginStatus().  This function gets the state of the
// person visiting this page and can return one of three states to
// the callback you provide.  They can be:
//
// 1. Logged into your app ('connected')
// 2. Logged into Facebook, but not your app ('not_authorized')
// 3. Not logged into Facebook and can't tell if they are logged into
//    your app or not.
//
// These three cases are handled in the callback function.

	// FB.getLoginStatus(function(response) {
	// 	statusChangeCallback(response);
	// });
};

// Load the SDK asynchronously
(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));

	// Here we run a very simple test of the Graph API after login is
	// successful.  See statusChangeCallback() for when this call is made.
function testAPI() {
	FB.api('/me', function(response) {
		console.log('infos abaixo');
		console.log(response);
		$('#UsuarioFacebookId').val(response.id);
		$('#imagem-facebook').attr({src: 'https://graph.facebook.com/' +response.id+ '/picture?type=normal'});
		$('#cont-facebook-img').fadeIn();
		$('#PerfilName').val(response.name);
		$('#UsuarioEmail').val(response.email);
		$('#PerfilApelido').focus();
	});
}