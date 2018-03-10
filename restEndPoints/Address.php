<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    Address::setDb($db);
    $addresses = Address::loadAll();
    $tmpAddresses = [];
    foreach ($addresses as $k => $address) {
        $tmpAddresses[$k]['id'] = $address['id'];
        $tmpAddresses[$k]['city'] = $address['city'];
        $tmpAddresses[$k]['postcode'] = $address['postcode'];
        $tmpAddresses[$k]['street'] = $address['street'];
        $tmpAddresses[$k]['house'] = $address['house'];
    }
    $response = $tmpAddresses;
}