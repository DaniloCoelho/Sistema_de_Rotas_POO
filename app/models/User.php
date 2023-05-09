<?php
    namespace app\models;
    class User{
        //atributos
        private $id_usuarios;
        private $nome;
        private $email;
        private $senha;
        private $data_nasc;
        private $genero;
        private $estado;
        private $escolaridade;
        private $data_de_cadastro;
        private $assinante;
        private $ativo;
        private $recuperar_senha;
        private $ranking;
        //Métodos especias
        /*public function __construct()
            {
                $this->id_usuarios = null;
                $this->nome = "";
                $this->email = "";
                $this->senha = "";
                $this->data_nasc = "";
                $this->genero = "";
                $this->estado = "";
                $this->escolaridade = "";
                $this->data_de_cadastro = ""; 
                $this->assinante = 0;
                $this->ativo = 1;
            }*/
        public function getId_usuarios(){
            return $this->id_usuarios;
        }
        public function setId_usuarios(int $id_usuarios){
            $this->id_usuarios = $id_usuarios;
        }
        public function getNome(){
            return $this->nome;
        }
        public function setNome(string $nome){
            $this->nome = $nome;
        }
        public function getEmail(){
            return $this->email;
        }
        public function setEmail(string $email){
            $this->email = $email;
        }
        public function getSenha(){
            return $this->senha;
        }
        public function setSenha(string $senha){
            $this->senha = $senha;
        }
        public function getData_nasc(){
            return $this->data_nasc;
        }
        public function setData_nasc(string $data_nasc){
            $this->data_nasc = $data_nasc;
        }
        public function getGenero(){
            return $this->genero;
        }
        public function setGenero(string $genero){
            $this->genero = $genero;
        }
        public function getEstado(){
            return $this->estado;
        }
        public function setEstado(string $estado){
            $this->estado = $estado;
        }
        public function getEscolaridade(){
            return $this->escolaridade;
        }
        public function setEscolaridade(string $escolaridade){
            $this->escolaridade = $escolaridade;
        }
        public function getData_de_cadastro(){
            return $this->data_de_cadastro;
        }
        public function setData_de_cadastro(string $data_de_cadastro){
            $this->data_de_cadastro = $data_de_cadastro;
        }
        public function getAssinante(){
            return $this->assinante;
        }
        public function setAssinante(int $assinante){
            $this->assinante = $assinante;
        }
        public function getAtivo(){
            return $this->ativo;
        }
        public function setAtivo(int $ativo){
            $this->ativo = $ativo;
        }
        public function getRecuperar_senha(){
            return $this->recuperar_senha;
        }
        public function setRecuperar_senha(string $recuperar_senha){
            $this->recuperar_senha = $recuperar_senha;
        }
        public function getRanking(){
            return $this->ranking;
        }
        public function setRanking(int $ranking){
            $this->ranking = $ranking;
        }
    }
?>