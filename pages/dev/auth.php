<?php
    $request = (object) array();

    $request->headers = getallheaders();

    if(Auth::authenticateByToken($db, $request->headers['username'], $request->headers['token']))
        Response::success("You are authenticated", 200);