<?php

namespace app\routes;

use app\helpers\Request;
use app\helpers\Uri;
use Exception;

class Router{
    //declara essa constante para chamar a namespace para encontrar a classe
    public const CONTROLLER_NAMESPACE = 'app\\controllers';

    public static function load(string $controller, string $method){
        try {
            echo "load executado<br>";
            // verificar se o controller existe
            $controllerNamespace = self::CONTROLLER_NAMESPACE . '\\' . $controller;
            if (!class_exists($controllerNamespace)) {
                throw new Exception("O Controller {$controller} não existe");
            }

            $controllerInstance = new $controllerNamespace;
            echo "classe existe <br>";
            //verifica se o metodo existe
            if (!method_exists($controllerInstance, $method)) {
                throw new Exception("O método {$method} não existe no Controller {$controller}");
            }
            echo "metodo existe<br>";
            $controllerInstance->$method((object)$_REQUEST);
            
            echo "<br>Tudo certo !";
        } catch (\Throwable $th) {
            echo"erro na rota ->".$th->getMessage()."<br>";
        }
    }

    public static function routes(): array
    {
        
        return [
            'get' => [
                '/' => fn () => self::load('HomeController', 'index'),

                '/user' => fn () => self::load('UserController' , 'index'),

                '/visualizar' => fn () => self::load('UserController' , 'visualizar'), 
            ],
            'post' => [

                '/visualizar' => fn () => self::load('UserController' , 'visualizar'),
                '/usuario' => fn () => self::load('UserController' , 'usuario'),

                '/edit' => fn () => self::load('UserController' , 'edit'),
            ],
            'put' => [
                '/product' => fn () => self::load('ProductController' ,'update')
            ],
            'delete' => [

            ],
        ] ;
    }
    public static function execute()
    {
        try {
            echo "execute ok <br>";
            //pega as rotas
            $routes = self::routes();
            //pega a requisição
            $request = Request::get();
            
            //pega a uri
            $uri = Uri::get('path');

            if (!isset($routes[$request])) {
                throw new Exception(' 1 A rota não existe');
            }
            if (!array_key_exists($uri, $routes[$request])) {
                throw new Exception('2 A rota não existe');
            }

            $router = $routes[$request][$uri];
            //verifica se é algo que  pode ser chamado ou executado .Ex: função
            if (!is_callable($router)) {
                throw new Exception("Route {$uri} is not callable");
            }

            $router();
        } catch (\Throwable $th) {
            echo "catch - ".$th->getMessage();
        }
    }







}