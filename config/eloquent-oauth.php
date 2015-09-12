<?php

return [
	'table' => 'oauth_identities',
	'providers' => [
		'facebook' => [
			'client_id' => '1622724964643631',
			'client_secret' => '2ec737cc1fdeba6d041116fea0ba28db',
			'redirect_uri' => 'http://localhost:8000/facebook/login',
			'scope' => [],
		],
		'google' => [
			'client_id' => '902183693011-p9g2ts19avpff46cdjpgt62b3hs90fqm.apps.googleusercontent.com',
			'client_secret' => 'SCRr_-VHXusoqE6-0yw4D8c9',
			'redirect_uri' => 'http://localhost:8000/google/redirect',
			'scope' => [],
		],
		'github' => [
			'client_id' => 'f193147b1039de16095c',
			'client_secret' => 'c8e1c2d3021d0ae7c1ad53aa809346fcd7a76632',
			'redirect_uri' => 'http://localhost:8000/github/login',
			'scope' => [],
		],
	],	
];
