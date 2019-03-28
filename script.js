function copyToClip (str,element) {

	// Check if lastclippy exists
	if (typeof lastclippy !== 'undefined' && lastclippy) {
		// Check if the icon needs to be changed
		if (lastclippy.style.backgroundImage.localeCompare("url(lib/plugins/clippy/svg/clicked.svg)")) {
			// Change icon and tooltiptext
			lastclippy.style.backgroundImage = "url(lib/plugins/clippy/svg/link.svg)";
			lastclippy.firstElementChild.innerHTML = "Copy to Clipboard<span class=\"arrow\"></span>";
		}
	}
	
	// Create Dummy Elemnt (for copy to clipboard)
	var dummy = document.createElement("textarea");
	// Set value (string to be copied)
	dummy.value = str;
	// Set non-editable to avoid focus and move outside of view
	dummy.setAttribute("readonly", "");
	dummy.style = {position: "absolute", left: "-9999px"};
	document.body.appendChild(dummy);
	// Select text inside element
	dummy.select();
	// Copy text to clipboard
	document.execCommand("copy");
	// Remove temporary element
	document.body.removeChild(dummy);

	// Set clicked icon
	element.style.backgroundImage = "url(lib/plugins/clippy/svg/clicked.svg)";
	// Set text Copied
	element.firstElementChild.innerHTML = "Copied<span class=\"arrow\"></span>";

	// Define last-clicked clippy
	lastclippy = element;
};
