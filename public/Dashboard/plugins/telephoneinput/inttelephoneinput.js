$(function() {

	// International Telephone Input
	var input = document.querySelector("#phone");
    window.intlTelInput(input, {
      utilsScript: "Dashboard/plugins/telephoneinput/utils.js",
    });
});

