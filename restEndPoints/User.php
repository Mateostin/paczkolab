<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $tmpUsers = [];
    if (isset($pathId) && !empty($pathId)) {
        $tmpUsers = User::load($pathId);
        $tmpUsers[0]['id'] = $users['id'];
        $tmpUsers[0]['address'] = $users['address'];
        $tmpUsers[0]['name'] = $users['name'];
        $tmpUsers[0]['surname'] = $users['surname'];
        $tmpUsers[0]['creditQuantity'] = $users['creditQuantity'];

    } else {
        $users = User::loadAll();
        foreach ($users as $k => $user) {
            $updateUsers[$k]['id'] = $user['id'];
            $updateUsers[$k]['address'] = $user['address'];
            $updateUsers[$k]['name'] = $user['name'];
            $updateUsers[$k]['surname'] = $user['surname'];
            $updateUsers[$k]['creditQuantity'] = $user['creditQuantity'];

        }
    }
    $response = $updateUsers;

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    parse_str(file_get_contents("php://input"), $patch_vars);
    $users = new User($patch_vars['name'], $patch_vars['surname'], $patch_vars['creditQuantity'], $patch_vars['address']);
    if ($users->save()) $response = ['add'];

} elseif ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
    parse_str(file_get_contents("php://input"), $patch_vars);

    $users = new User($patch_vars['name'], $patch_vars['surname'], $patch_vars['creditQuantity'], $patch_vars['address']);
    if ($users->update($patch_vars['id'])) $response = ['patch'];

} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"), $patch_vars);
    if (User::delete($patch_vars['id'])) $response = ['delete'];

} else {
    $response = ['error' => 'Wrong request method'];
}