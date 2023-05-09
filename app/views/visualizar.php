<?php 
$this->layout('master', ['title' => $title]) ?>


<h2>Olá <?php echo ""; ?></h2>
<?php

    
    foreach($resultado->fetchAll() as $dados){
        echo "ID : " .$dados['id_usuarios'] ."<br>";
        echo "Nome : " .$dados['nome'];
        echo "<br>";
    }
    
?>


