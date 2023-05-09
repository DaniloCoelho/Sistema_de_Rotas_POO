<?php
    namespace app\controllers;
    use app\models\Repository;

    use PDO;

        class UserController extends Controller
        {
            public function index()
            {
                $this->view('home', ['title' => 'Home', 'name' => 'Bem vindo']);
            }
            public function visualizar()
            {   
                $repo = new Repository();
                $result = $repo->select_usuarios();
                if($result->rowCount() > 0 || $result != null){
                    $this->view('visualizar',['title' => 'Visualizar Usuários' , 'resultado' => $result]);
                    
                }else {
                    echo "é null";
                } 
            }
            public function usuario(){
                $id = $_POST['id'];
                $repo = new Repository();
                $result = $repo->buscar_usuario($id);
                if($result->rowCount() > 0 || $result != null){
                    $this->view('usuario',['title' => 'Visualizar Usuário' , 'resultado' => $result]);
                }
            }


        }
?>