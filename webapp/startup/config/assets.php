<?php
use ArmoredCore\WebObjects\Asset;

$assetBundles = [
    'base' => [
        'http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js',
        'http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js',
        Asset::js ( 'headroom.min.js' ),
        Asset::js ( 'jQuery.headroom.min.js' ),
        Asset::js ( 'template.js' ),
        Asset::js ( 'highlight.pack.js' ),
        Asset::css ( 'bootstrap.min.css' ) ,
        Asset::css ( 'font-awesome.min.css' ),
        Asset::css ( 'hlstyles/default.css' ),
        Asset::css ( 'main.css' ),
        Asset::css ( 'bootstrap.icon-large.min.css' )
    ],
    'form-controls'	=> Asset::css('form.css'),
];