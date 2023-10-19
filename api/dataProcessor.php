<?php
include_once '../vendor/autoload.php';
include_once '../src/Request.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['phone']) && !empty($_POST['email']) && !empty($_POST['name']) && !empty($_POST['price'])) {
        //Все данные из формы получены
        //отправка в amoCRM
        $req = new Request($_POST['email'], $_POST['price'], $_POST['phone'], $_POST['name']);
        $req->createContact();
        $req->createLead();
        $req->connectContactToLead();
        //возвращение результата в js
        $response = ['result' => 'ok'];
    } else {
        //возвращение результата в js
        $response = ['result' => 'fail'];
    }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    die;

}
