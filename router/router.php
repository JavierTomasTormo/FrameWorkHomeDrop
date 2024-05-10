<?php
    /*=======================================================================*/
        require 'autoload.php';
    /*=======================================================================*/
        // $path = $_SERVER['DOCUMENT_ROOT'] . '/FrameWorkHomeDrop/'; //Ruta del root
    
        // include($path . "utils/common.inc.php");
        // include($path . "utils/mail.inc.php");
        // include($path . "paths.php");//Paths constantes
    /*=======================================================================*/ 
        ob_start();
        session_start();
    /*=======================================================================*/
        class router {
        /*=======================================================================*/
            private $uriModule;
            private $uriFunction;
            private $nameModule;
            static $_instance;
        /*=======================================================================*/ 
            public static function getInstance() {
                if (!(self::$_instance instanceof self)) {
                    self::$_instance = new self();
                }
                return self::$_instance;
            }
        /*=======================================================================*/
            function __construct() {   

                //echo $_GET['module'],"    ", $_GET['op'], "\n";

                if (isset($_GET['module'])) {
                    $this->uriModule = $_GET['module'];
                } else {
                    $this->uriModule = 'home';
                }
                if (isset($_GET['op'])) {
                    $this->uriFunction = ($_GET['op'] === "") ? 'view' : $_GET['op'];
                } else {
                    $this->uriFunction = 'view';
                }
            }
        /*=======================================================================*/
            function routingStart() {
                try {
                    $moduleInstance = $this->loadModule();
                    $functionName = $this->loadFunction();
                    call_user_func(array($moduleInstance, $functionName));

                } catch (Exception $e) {
                    echo $e->getMessage();
                    common::load_error();
                }
            }
        /*=======================================================================*/    
            private function loadModule() {
                if (file_exists('resources/modules.xml')) {
                    $modules = simplexml_load_file('resources/modules.xml');
                    //var_dump($modules);
                    foreach ($modules as $row) {
                        //var_dump($row);
                        if (in_array($this->uriModule, (array)$row->uri)) {
                            $path = MODULES_PATH . $row->name . '/controller/controller_' . (string)$row->name . '.class.php';
                            //var_dump( "$path");
                            if (file_exists($path)) {
                                require_once($path);
                                $controllerName = 'controller_' . (string)$row->name;
                                $this->nameModule = (string)$row->name;
                                //
                                //var_dump($this->nameModule = (string)$row->name , "Linea 67");
                                //
                                return new $controllerName;
                            } else { 
                                // // Si la función no se encuentra en el archivo XML
                                throw new Exception('no se ha encontrado el modulo.');
                            }
                        }
                    }
                    

                } else {
                    throw new Exception('Module configuration file not found.');
                }
            }
        /*=======================================================================*/    
            private function loadFunction() {

                $moduleName = $this->nameModule;

                // $path = MODULES_PATH . $this -> nameModule . '/resources/function.xml';
                $path = MODULES_PATH . $moduleName . '/resources/function.xml';

                // echo $_GET['module'], "\n";

                // echo $_GET['op'], "\n";

                // echo ("$moduleName". "\n");

                 //var_dump("$path         " . $this -> nameModule);
                //  $mensaje = "$path      " . $this -> nameModule;
                //  echo "<script>console.log('" . $mensaje . "');</script>";

                if (file_exists($path)) {

                    //throw new Exception("El archivo si exxiste  ");
                    // echo "$path  ";
                    $functions = simplexml_load_file($path);
                    foreach ($functions as $row) {
                        if (in_array($this->uriFunction, (array)$row->uri)) {
                            return (string)$row->name;
                        }
                    }
                    // Si la función no se encuentra en el archivo XML
                    throw new Exception('Function no encontrada en el archivo.');
                } else {
                    // Si el archivo XML no se encuentra
                    throw new Exception('El archivo no se ha encontrado');
                }
            }
        /*=======================================================================*/
    }
    
    router::getInstance() -> routingStart();