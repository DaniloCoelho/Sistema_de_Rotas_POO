<?php
    namespace app\controllers;

        class HomeController extends Controller
        {
            public function index()
            {
                $this->view('home', ['title' => 'Home', 'name' => 'Bem vindo']);
            }
            public function visualizar()
            {
                $this->view('visualizar', ['title' => 'Visualizar', 'name' => 'Usuários']);
            }
        }

?>