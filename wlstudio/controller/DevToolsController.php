<?php
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\View;
use ArmoredCore\MVCReflexion\MVCInspector;
use ArmoredCore\WebKernel\ArmoredCore;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\CodeBuilders\ResourceControllerBuilder;
use Nette\PhpGenerator\Printer;


/**
 * Created by PhpStorm.
 * User: smendes
 * Date: 06-04-2017
 * Time: 20:31
 */
class DevToolsController extends BaseController
{

    public function index(){
        $mvci = new MVCInspector();
        $serverModules = $mvci->getServerModules();
        View::attachSubView('titlecontainer', 'layout.pagetitle', ['title' => 'Resource Controller Builder']);
        View::make('devtools.controllerBuilderModuleSelector', ['serverModules' => $serverModules]);
    }

    public function ControllerModelSelector(){

        $serverModuleName = Post::get('servermodulename');

        $mvci = new MVCInspector();

        $modelNames = $mvci->getModels($serverModuleName);
        $controllerNames = $mvci->getTaggedControllers($serverModuleName);

        View::attachSubView('titlecontainer', 'layout.pagetitle', ['title' => 'Resource Controller Builder']);
        View::make('devtools.controllerBuilderModelSelector', ['modelnames' => $modelNames, 'controllernames' => $controllerNames, 'servermodulename' => $serverModuleName]);
    }

    public function ControllerGenerator(){
        if (Post::has('modelname')){
            $modelName = Post::get('modelname');
        } else {
            Redirect::toRoute('devtools/index');
        }
        $serverModuleName = Post::get('servermodulename');

        $classBuilder = new ResourceControllerBuilder($serverModuleName, $modelName);
        $code = $classBuilder->buildClass();

        View::attachSubView('titlecontainer', 'layout.pagetitle', ['title' => 'Class ' . $modelName . 'Controller']);
        View::make('devtools.GeneratedClassCode', ['code' => $code]);

    }

    public function accomponents(){
        $components = ArmoredCore::getComponents();
        View::attachSubView('titlecontainer', 'layout.pagetitle', ['title' => 'Armored Core']);
        View::Make('devtools.accomponents', ['components' => $components]);
    }

    public function inspect($iid){
        $instance = ArmoredCore::get($iid);

        View::attachSubView('titlecontainer', 'layout.pagetitle', ['title' => 'Armored Core Inspection']);
        View::Make('devtools.inspect', ['instance' => $instance]);
    }

}