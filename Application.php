<?php

namespace yzh\phhpmvc;

use yzh\phhpmvc\db\DbModel;
use yzh\phhpmvc\db\Database;

/**
 * Class Application
 * 
 * @author Yavor Zhekov
 * @package yzh\phhpmvc
 */
class Application
{

    public string $layout = 'main';
    /**
     * @var string
     */
    public static string $ROOT_DIR;

    public  $userClass;

    /**
     * @var Response
     */
    public Response $response;

    /**
     * @var Router
     */
    public Router $router;

    /**
     * @var Request
     */
    public Request $request;

    /**
     * @var Application
     */
    public static Application $app;

    /**
     * @var Controller
     */
    public Controller $controller;

    /**
     * @var Session
     */
    public Session $session;

    
    /**
     * @var Database
     */
    public Database $db;

    public ?UserModel $user;

    public View $view;

    
    /**
     * @param string $rootPath
     */
    public function __construct($rootPath, array $config)
    {
        
        $this->userClass = new $config['userClass'];
        self::$app = $this;
        self::$ROOT_DIR = $rootPath;
        $this->request = new Request();
        $this->session = new Session();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->controller = new Controller();
        $this->view = new View();

        $this->db = new Database($config['db']);

        $primaryValue = $this->session->get('user');
        if ($primaryValue) {
            $primaryKey = $this->userClass->primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        }
        else {
            $this->user = null;
        }
        
        
    }

    /**
     * @return [type]
     */
    public function run() {
        try {
            echo $this->router->resolve();    
        }catch (\Exception $e) {
            $this->response->setStatusCode($e->getCode());
            echo $this->view->renderView('_error', [
                'exception' => $e
            ]);
        }
         
    } 
    

    /**
     * @return Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }

    public function login(UserModel $user) 
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;

    }

    public function logout() 
    {
        $this->user = null;
        $this->session->remove('user');
        

    }

    public static function isGuest() {
        return !self::$app->user;
    }
}
