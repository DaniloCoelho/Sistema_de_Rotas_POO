<?php
namespace app\models;
use PDO;
use app\models\Conn;


class Repository { 
    private $pdo;
       
    public function __construct(){
        $x = new Conn();
        return $this->pdo = $x->conexao();
    }
    public function atualizar_rec_senha($keyRecSenha ,$id_usuario){
        try{
            $sqlcode = "UPDATE usuarios SET recuperar_senha = :recuperar_senha WHERE id_usuarios = :id_usuarios Limit 1";
            $query = $this->pdo->prepare($sqlcode);
            $query->bindParam(':id_usuarios',$id_usuario,PDO::PARAM_INT); 
            $query->bindParam(':recuperar_senha' ,$keyRecSenha , PDO::PARAM_STR);
            $query->execute();
            return "<a href='http://localhost/simulado_de_provas/atualizar_senha.php?v=$keyRecSenha'><button> Atualizar senha </button></a>";
            
        }catch(PDOException $e){
           echo "Erro na recuperação de senha , Tente novamente".$e->getMessage() ;

        }     
    }
    public function atualizar_usuario(User $usuario){
        try{
            $sql_edit_user = "UPDATE usuarios SET nome = :nome, email = :email, data_nasc = :data_nasc, genero = :genero, estado = :estado,  escolaridade = :escolaridade ,assinante = :assinante , ativo = :ativo ,ranking = :ranking WHERE id_usuarios = :id_usuarios ";
            
            $nome = strip_tags($usuario->getNome());
            $email = strip_tags($usuario->getEmail());
            $data_nasc = strip_tags($usuario->getData_nasc());
            $genero = strip_tags($usuario->getGenero());
            $estado = strip_tags($usuario->getEstado());
            $escolaridade = strip_tags($usuario->getEscolaridade());
            $assinante = strip_tags($usuario->getAssinante());
            $ativo = strip_tags($usuario->getAtivo());
            $iduser = strip_tags($usuario->getId_usuarios());
            $ranking = strip_tags($usuario->getRanking());

            $query = $this->pdo->prepare($sql_edit_user);
            $query->bindParam(':nome' ,$nome , PDO::PARAM_STR);
            $query->bindParam(':email' ,$email,PDO::PARAM_STR);        
            $query->bindParam(':data_nasc',$data_nasc,PDO::PARAM_STR); 
            $query->bindParam(':genero',$genero,PDO::PARAM_STR);
            $query->bindParam(':estado',$estado,PDO::PARAM_STR); 
            $query->bindParam(':escolaridade',$escolaridade,PDO::PARAM_STR);   
            $query->bindParam(':assinante',$assinante,PDO::PARAM_INT); 
            $query->bindParam(':ativo',$ativo,PDO::PARAM_INT); 
            $query->bindParam(':ranking',$ranking,PDO::PARAM_INT);
            $query->bindParam(':id_usuarios',$iduser,PDO::PARAM_INT);
            $query->execute();
            
        }catch(PDOException $e){
            echo "Erro ao atualizar usuário. Tente novamente! <a href='index.php'><button> Voltar </button></a>".$e->getMessage();
            
        } 
    }
    public function atualizar_senha($id , $senha){ 
        try{
            $sen = strip_tags($senha); 
            $senhacry = password_hash($sen , PASSWORD_DEFAULT,['cost' => 10]);
            $sqlcode = "UPDATE usuarios SET senha = :senha WHERE id_usuarios = :id_usuarios ";
            $query = $this->pdo->prepare($sqlcode);
            $query->bindParam(':senha' ,$senhacry,PDO::PARAM_STR);
            $query->bindParam(':id_usuarios',$id,PDO::PARAM_INT);
            $query->execute();
            
        }catch(PDOException $e){
           echo "Erro ao atualizar senha. Tente novamente!".$e->getMessage();
        }
    }
    public function buscar_email($email){
        try{
            $ema = strip_tags($email);
            $sql_code = "SELECT id_usuarios , nome ,email FROM usuarios WHERE email = :email LIMIT 1";
            $query = $this->pdo->prepare($sql_code);
            $query->bindParam('email' ,$ema ,PDO::PARAM_STR);
            $query->execute();
            if(!$query){
                throw new PDOException("Erro ao buscar usuário. Tente novamente! <a href='index.php'><button> Voltar </button></a>");
            }else{
                $linhas = $query->rowCount();
                if ($linhas == 0) { return $linhas; }
                else if ($linhas > 1) {return $linhas = 0;}
                else {return $query;}
            }
            
            
        }catch(PDOException $e){
            echo "Erro ao buscar usuário. Tente novamente! <a href='index.php'><button> Voltar </button></a>".$e->getMessage();
        }
    }
    public function buscar_usuario(int $id_usuarios){ 
        try{
            $sql_search_user = "SELECT * FROM usuarios WHERE id_usuarios = :id_usuarios";       
            $query = $this->pdo->prepare($sql_search_user);
            $query->bindParam(':id_usuarios',$id_usuarios,PDO::PARAM_INT);
            $query->execute();    
            if(!$query){
                throw new PDOException("Erro ao buscar usuário. Tente novamente!");
            }else{
                //return  $query->fetchObject('User');
                return  $query;
            }
        }catch(PDOException $e){
            echo "Erro ao buscar usuário. Tente novamente!".$e->getMessage();
        }
    }
    public function cadastrar_disciplina($disciplina){
        try{
            $dis = strip_tags($disciplina);
            $sqlcode = "INSERT INTO  disciplina (nome_disciplina) VALUES(:disciplina);";
            $query = $this->pdo->prepare($sqlcode);
            $query->bindParam('disciplina' ,$dis ,PDO::PARAM_STR);
            $query->execute();
            if(!$query){
                throw new PDOException("Erro ao cadastrar disciplina. Tente novamente!");
            }
        }catch(PDOException $e){
            $texto = $e->getMessage();
            echo "Erro ao cadastrar disciplina. Tente novamente!";
        }
    }
    public function remover_usuario(int $id_usuarios){ 
        try{
            $sql_remove_user = "DELETE FROM usuarios WHERE id_usuarios = :id_usuarios";
            $query = $this->pdo->prepare($sql_remove_user);
            $query->bindParam(':id_usuarios',$id_usuarios,PDO::PARAM_INT);
            $query->execute();
            if(!$query){
                throw new PDOException("Erro ao excluir usuários. Tente novamente!");
            }
        }catch(PDOException $e){
            $texto = $e->getMessage();
            echo "Erro ao excluir usuários. Tente novamente!";
        }
       
    }
    public function select_usuarios(){  
        try{
            $sqlcode = "SELECT * FROM usuarios";
            $query = $this->pdo->query($sqlcode);
            
            if($query->rowCount() < 1){
                throw new PDOException("Erro ao listar histórico de provas. Tente novamente!");
            }else{
                return $query;
            }
        }catch(PDOException $e){
            $texto = $e->getMessage();
            echo "Erro ao listar histórico de provas. Tente novamente!";
        }
    }
    public function salvar_usuario(User $usuario){
        try{
                $sql_save_user = "INSERT INTO usuarios(nome, email, senha, data_nasc, genero,estado, escolaridade ,data_cadastro , assinante , ativo ,recuperar_senha, ranking) VALUES (:nome, :email, :senha, :data_nasc, :genero, :estado, :escolaridade , :data_cadastro , :assinante , :ativo ,:recuperar_senha ,:ranking)";

                $nome = strip_tags($usuario->getNome());
                $email = strip_tags($usuario->getEmail());
                $sen = strip_tags($usuario->getSenha()); //criptografar aqui
                $senha = password_hash($sen , PASSWORD_DEFAULT);
                $data_nasc = strip_tags($usuario->getData_nasc());
                $genero = strip_tags($usuario->getGenero());
                $estado = strip_tags($usuario->getEstado());
                $escolaridade = strip_tags($usuario->getEscolaridade());
                $data_cadastro = strip_tags($usuario->getData_de_cadastro());
                $assinante = strip_tags($usuario->getAssinante());
                $ativo = strip_tags($usuario->getAtivo());
                $recuperar_senha = strip_tags($usuario->getRecuperar_senha());
                $ranking = strip_tags($usuario->getRanking());

                $query = $this->pdo->prepare($sql_save_user);       
                $query->bindParam(':nome' ,$nome , PDO::PARAM_STR);
                $query->bindParam(':email' ,$email,PDO::PARAM_STR); 
                $query->bindParam(':senha' ,$senha,PDO::PARAM_STR); 
                $query->bindParam(':data_nasc',$data_nasc,PDO::PARAM_STR); 
                $query->bindParam(':genero',$genero,PDO::PARAM_STR);
                $query->bindParam(':estado',$estado,PDO::PARAM_STR); 
                $query->bindParam(':escolaridade',$escolaridade,PDO::PARAM_STR);
                $query->bindParam(':data_cadastro',$data_cadastro,PDO::PARAM_STR); 
                $query->bindParam(':assinante',$assinante,PDO::PARAM_INT); 
                $query->bindParam(':ativo',$ativo,PDO::PARAM_INT); 
                $query->bindParam(':recuperar_senha',$recuperar_senha,PDO::PARAM_STR);
                $query->bindParam(':ranking',$ranking,PDO::PARAM_INT);
                $query->execute();
            if(!$query){
                throw new PDOException("Houve um erro ao cadastrar usuário. Tente novamente ! <a href='index.php'><button> Voltar </button></a>");
            }
        }catch(PDOException $e){
            echo "Houve um erro ao cadastrar usuário. Tente novamente ! <a href='index.php'><button> Voltar </button></a>";
            echo $e->getMessage();
        } 
    }
    public function buscar_em_usuarios(string $id_usuarios , string $nome){ 
        try{
            $sql_search_user = "SELECT * FROM usuarios WHERE id_usuarios = :id_usuarios OR nome = :nome ";       
            $query = $this->pdo->prepare($sql_search_user);
            $query->bindParam(':id_usuarios',$id_usuarios,PDO::PARAM_STR);
            $query->bindParam(':nome',$nome,PDO::PARAM_STR);
            $query->execute();    
            if(!$query){
                throw new PDOException("Erro ao buscar usuário. Tente novamente!");
            }else{
                return $query;
            }
        }catch(PDOException $e){
            echo "Erro ao buscar usuário. Tente novamente!".$e->getMessage();
        }
    }



}