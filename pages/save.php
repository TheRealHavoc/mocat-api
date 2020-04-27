<?php
    $user = Auth::authenticateByToken($db);

    if(isset($_GET['id'])) {
        $db->save($_GET['id'], $user['id']);

        Response::success("Media saved to user", 200);
    }
