<?php

    /**
     * Include config file
     */
    require_once __DIR__.'/config/config.php';

    /**
     * Handles response
     */
    require_once __DIR__.'/core/Response.php';

    /**
     * Database
     */
    require_once __DIR__.'/core/Database.php';
    $db = new Database();

    /**
     * Register helpers
     */
    require_once __DIR__.'/helpers/Auth.php';
    require_once __DIR__.'/helpers/Token.php';

    /**
     * Routing
     */
    require_once('app/core/Router.php');
    require_once('routes/api.php');

    /**
     * Request
     */
    require_once('app/core/request.php');