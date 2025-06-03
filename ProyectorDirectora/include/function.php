<?php

require 'app.php';

function incluirTemplate($nombre): void
{
    include TEMPLATES_URL . "/{$nombre}.php";
}

function adminAutenticado(): bool
{
    session_start();

    $auth = $_SESSION['login'];

    if ($auth) {
        return true;
    }

    return false;
}

function usuarioAutenticado(): bool
{
    session_start();

    $auth = $_SESSION['login'];

    if ($auth) {
        return true;
    }

    return false;
}
