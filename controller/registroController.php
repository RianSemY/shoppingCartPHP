<?php
if ($_POST) {
    @$nome = $_POST['nome'];
    @$email = $_POST['email'];
    @$senha = $_POST['senha'];
    @$confirmarSenha = $_POST['confirmarSenha'];

    if (isset($nome) and isset($email) and isset($senha) and isset($confirmarSenha)) {

        if($confirmarSenha !== $senha){
            header('location:../registro.php?cod=wrong_pass');
            exit();
        }
        require_once '../model/usuarioModel.php';
        $usuario = new usuarioModel();
        $usuarioExiste = $usuario->checkEmailExistence($email);

        if ($usuarioExiste) {
            header('location:../registro.php?cod=email_exists');
            exit();
        }

        
        $usuario->setEmail($email);
        $usuario->setSenha($senha);
        $usuario->setNome($nome);
        
        $usuario->insert();
        header('location:../login.php?cod=sucess');
    } else{
        header('location:../registro.php?cod=172');
        exit();
    }
} else {
    header('location:../registro.php');
}