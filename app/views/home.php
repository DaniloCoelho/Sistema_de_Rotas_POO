<?php $this->layout('master', ['title' => $title]) ?>

<h2>Olá <?php echo $name; ?></h2>

<p>
    Esta aplicação é uma demostração de um sistema de rotas em PHP com Orientação a Objetos .
</p>

<form action="/visualizar" method="post">
    <input type="text" name="texto">
    <input type="submit" value="Pesquisar">
</form>

<form action="/usuario" method="post">
    <input type="text" name="id">
    <input type="submit" value="Pesquisar">
</form>

