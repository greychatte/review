<?php

return [
	// MainController
	'' => [
		'controller' => 'main',
		'action' => 'review',
	],
	// AdminController
	'admin' => [
		'controller' => 'admin',
		'action' => 'login',
	],
    'admin/review' => [
        'controller' => 'admin',
        'action' => 'review',
    ],
	'admin/logout' => [
		'controller' => 'admin',
		'action' => 'logout',
	],
];