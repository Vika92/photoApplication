<?php
class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath = ROOT.'/config/routes.php';
        $this -> routes = include($routesPath);
    }

    /**
     * @return request string
     */
    private function getURI(){
        if (!empty($_SERVER['REQUEST_URI'])){
            return substr(trim($_SERVER['REQUEST_URI']),1);
        };
    }
    public function run()
    {
        //get uri request string
        $uri = $this->getURI();

        if($uri){
            //check presence of returned uri in routes.php
            $finalPath = null;

            foreach($this->routes as $uriPattern => $path){
                if (preg_match("~$uriPattern~",$uri)){
                    $internalRoute = preg_replace("~$uriPattern~",$path, $uri);
                    $dataArray = explode('/',$internalRoute);

                    $controllerName = array_shift($dataArray)."Controller";

                    $actionName = "action".ucfirst(array_shift($dataArray));
                    $parameters = $dataArray;

                    break;
                }
            }

            //include file with controller class
            $controllerFile = str_replace(" ","",ROOT ."/controllers/ ". $controllerName.'.php');

            if(file_exists($controllerFile)){
                include_once($controllerFile);
            }

            //create object of controllerClass and call needful method
            $controllerObject = new $controllerName;


//            $result = call_user_func_array(array($controllerObject,$actionName),$parameters);
            $result = $controllerObject->$actionName($parameters);

            if($result != null){
                exit;
            }
        }
    }
}
?>