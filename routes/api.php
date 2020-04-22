<?php
    $router = new Router();
    /**
     * Register your routes here
     */

    $router->url('', 'pages/index.php');

    /**
     * Development
     */
    $router->url('createuser', 'pages/dev/createuser.php');