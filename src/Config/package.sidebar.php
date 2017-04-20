<?php

return [
    'calendar' => [
        'name'          => 'explorer',
        'label'         => 'explorer::meta.plugin_name',
        'icon'          => 'fa-globe',
        'route_segment' => 'explorer',
		'permission' => 'explorer.view',
        'entries' => [
        	[
        		'name'	=> 'Maps',
        		'icon'	=> 'fa-map-o',
        		'route'	=> 'explorer.maps.index',
        		'permission'	=> 'explorer.view'
        	],
        	[
        		'name'	=> 'Settings',
        		'icon'	=> 'fa-cog',
        		'route' => 'explorer.settings.index',
        		'permission'	=> 'explorer.setup',
        	]
        ]
    ]
];
