<?php

    /**
     * Include config file
     */
    require_once __DIR__.'/config/config.php';

    /**
     * Register helpers
     */
    require_once __DIR__.'/helpers/Response.php';

    /**
     * Database
     */
    require_once __DIR__.'/core/Database.php';
    $db = new Database();

    /**
     * Routing
     */
    require_once('app/core/Router.php');
    require_once('routes/api.php');

    /**
     * Request
     */
    require_once('app/core/request.php');