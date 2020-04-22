<?php
    $router = new Router();

    /**
     * Register your routes here
     */
    $router->url('', 'index.php');

    /**
     * Authorisation
     */
    $router->url('signin', 'auth/signin.php');

    /**
     * Development
     */
    $router->url('createuser', 'dev/createuser.php');
    $router->url('auth', 'dev/auth.php');