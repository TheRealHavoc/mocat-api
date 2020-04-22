<?php
    Auth::authenticateByToken($db);

    $request = (object) array();

    $request->headers = getallheaders();

    $res = $db->getUserByUsername($request->headers['username']);

    $db->updateToken(NULL, $res['id']);

    Response::success("User signed out", 200);