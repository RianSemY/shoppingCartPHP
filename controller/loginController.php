<?php
session_start();

if ($_POST) {
    @$email = $_POST['email'];
    @$senha = $_POST['senha'];

    if (isset($email) && isset($senha)) {
        require_once '../model/usuarioModel.php';
        $clientesModel = new usuarioModel();
        $clienteId = $clientesModel->autenticarUsuario($email, $senha);

        if ($clienteId) {
            $_SESSION['login'] = $clienteId;
            header('location:../index.php');
        }
    } else {
        header('location:../login.php?cod=171');
    }
} else {
    header('location:../login.php?cod=172');
}
