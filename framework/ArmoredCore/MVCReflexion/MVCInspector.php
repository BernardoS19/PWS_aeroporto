<?php

namespace ArmoredCore\MVCReflexion;

use ArmoredCore\FileReader;
use function Symfony\Component\String\u;

/**
 * Created by PhpStorm.
 * User: smendes
 * Date: 06-04-2017
 * Time: 21:49
 */
class MVCInspector
{
    private $_fr;


    public function __construct()
    {
        $this->_fr = new FileReader();
    }

    public function getServerModules(): array
    {
        $moduleNames = array();
        $fr = new FileReader();
        $entries = $fr->getFilesFromDir(WL_SERVER_DIR);

        foreach ($entries as $entry) {

            if ( (!strpos($entry, '.') && (!u($entry)->startsWith('.')) )){

                switch ($entry){
                    case 'cache':
                    case 'database':
                    case 'docs':
                    case 'framework':
                    case 'lang':
                    case 'middleware':
                    case 'public':
                    case 'vendor':
                        break;
                    default:
                        array_push($moduleNames, $entry);
                }
            }
        }

        return $moduleNames;

    }

    public function getModels($serverModuleName): array
    {
        $modelNames = array();

        $fr = new FileReader();
        $files = $fr->getFilesFromDir(WL_SERVER_DIR . DIRECTORY_SEPARATOR . $serverModuleName . DIRECTORY_SEPARATOR . 'model');

        foreach ($files as $file) {
            $tokens = explode('.', $file);

            if (!trim($tokens[0]) == '') {
                array_push($modelNames, $tokens[0]);
            }
        }

        return $modelNames;

    }


    public function getControllers($serverModuleName): array
    {

        $controllerNames = array();

        $fr = new FileReader();
        $files = $fr->getFilesFromDir(WL_SERVER_DIR . DIRECTORY_SEPARATOR . $serverModuleName . DIRECTORY_SEPARATOR . 'controller');

        foreach ($files as $file) {
            $tokens = explode('.', $file);

            if (!trim($tokens[0]) == '') {
                array_push($controllerNames, $tokens[0]);
            }
        }

        return $controllerNames;

    }


    public function getTaggedControllers($serverModuleName)
    {

        $controllers = $this->getControllers($serverModuleName);

        return $this->tagControllers($controllers);

    }

    private function tagControllers($controllers)
    {

        $taggedControllers = array();

        foreach ($controllers as $controller) {

            switch ($controller) {

                case 'ArmoredCore\Controllers\BaseController' :
                    $tag = ' (Weblogic MVC class)';
                    break;

                case 'DevToolsController' :
                    $tag = ' (Weblogic MVC Dev support Controller)';
                    break;

                case 'HomeController' :
                    $tag = ' (App Root Controller)';
                    break;

                default :

                    $classInterfaces = class_implements($controller);

                    if (array_key_exists('ArmoredCore\Interfaces\ResourceControllerInterface', $classInterfaces)) {
                        $tag = '(User defined Controller [Resource Controller type])';
                    } else {
                        $tag = '(User defined Controller)';
                    }

                    break;
            }

            array_push($taggedControllers, ($controller . $tag));

        }

        return $taggedControllers;

    }

}