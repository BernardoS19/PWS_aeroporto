<?php
/**
 * Created by PhpStorm.
 * User: smendes
 * Date: 11-04-2017
 * Time: 11:31
 */

use ArmoredCore\WebKernel\Services;

$config = [
    'collections' => $assetBundles,
    'autoload' => ['base'],
    'pipeline' => false,
    'public_dir' => WL_PUBLIC_FOLDER_URL
];

$assetManager = new Stolz\Assets\Manager($config);

/**
 * Debugger configuration and loading
 */

Services::set('Assetmanager', $assetManager);
Services::set('ErrorManager', 'ArmoredCore\ErrorManager');

Services::run();




