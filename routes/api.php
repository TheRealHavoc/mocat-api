<?php
    $router = new Router();

    /**
     * Register your routes here
     */
    $router->url('', 'index');
    $router->url('search', 'search');

    /**
     * Authorisation
     */
    $router->url('signin', 'auth/signin');
    $router->url('signout', 'auth/signout');

    /**
     * Development
     */
    $router->url('createuser', 'dev/createuser');