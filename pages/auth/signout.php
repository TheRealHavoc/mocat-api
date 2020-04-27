<?php
    $user = Auth::authenticateByToken($db);

    $request = (object) array();

    $request->headers = getallheaders();

    $db->updateToken(NULL, $user['id']);

    Response::success("User signed out", 200);