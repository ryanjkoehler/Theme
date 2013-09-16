/**
 * 
 */

var $input = $('.mu_register #user_name'),
	output = document.getElementById('output'),
	$message = $input.after(''),
	msg = document.getElementById('message');

$input.on('paste', content);
$input.on('keyup', content);


function status(str) {
	var arr = [],
		innerHTML = message.innerHTML.toString();

	if ( -1 === innerHTML.indexOf('Username should')) {
		innerHTML += 'Username should';
	}

	for (var i = 0; i < str.length; i++) {
		var output = str[i];

		if ( -1 == innerHTML.indexOf( output ) ) {
			arr.push( '<span class="errors">' + output + '</span>' );
		}
	}

	message.innerHTML = innerHTML + arr.join('');
}

function content(e) {
	var $this = $(this),
		value = $this.val(),
		new_value;

	new_value = sluggable(value);
	if ( new_value !== value ) {
		$this.val(new_value);
	}
}

function sluggable(str) {
	var errors = [];

	// Check for uppercase
	if (str.match(/[A-Z]/)) {
		errors.push("be lowercase.");
	}

	if ( str.match(/[^A-z0-9\-]/g) ) {
		errors.push("only container alphanumeric characters(a-z 0-9).");
	}

	// Make sure it doesn't start with a number
	if (str.match(/^\d/)) {
		errors.push("not start with a number.");
	}

	if ( str.length <= 3 ) {
		errors.push("be longer than 4 characters.");
	}

	return str.replace(/^\d+|^\s+|^-+|[^A-Za-z0-9\-\s]/g, '').replace(/[\s\n-]+/g, '').toLowerCase();
}

function tidy_sluggable(str) {
	return sluggable(str).replace(/-+$/,'');
}