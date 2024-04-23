<?php
session_start();
if(!isset($_SESSION['login'])){
    header('location:login.php?cod=172');
}