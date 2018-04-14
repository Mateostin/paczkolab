<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $tmpParcel = [];
    if (isset($pathId) && !empty($pathId)) {
        $parcel = Parcel::load($pathId);
        $tmpParcel[0]['id'] = $parcel['id'];
        $tmpParcel[0]['sender'] = $parcel['sender'];
        $tmpParcel[0]['size'] = $parcel['size'];
        $tmpParcel[0]['address'] = $parcel['address'];
    } else {
        $parcel = Parcel::loadAll();
        foreach ($parcel as $k => $p) {
            $tmpParcel[$k]['id'] = $p['id'];
            $tmpParcel[$k]['sender'] = $p['sender'];
            $tmpParcel[$k]['size'] = $p['size'];
            $tmpParcel[$k]['address'] = $p['address'];

        }
    }
    $response = $tmpParcel;

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    parse_str(file_get_contents("php://input"), $patch_vars);
    $parcel = new Parcel($patch_vars['user_id'], $patch_vars['size_id'], $patch_vars['address_id']);
    if ($parcel->save()/* and creditQuantity > price */) $response = ['add'];

} elseif ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
    parse_str(file_get_contents("php://input"), $patch_vars);
    $parcel = new Parcel($patch_vars['user_id'], $patch_vars['size_id'], $patch_vars['address_id']);
    if ($parcel->update($patch_vars['id'])) $response = ['patch'];

} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"), $patch_vars);
    if (Parcel::delete($patch_vars['id'])) $response = ['delete'];

} else {
    $response = ['error' => 'Wrong request method'];
}