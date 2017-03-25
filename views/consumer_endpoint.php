<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 3/25/17
 * Time: 5:17 PM
 */

require_once __DIR__ . '/../models/consumer_model.php';

$data = json_decode(file_get_contents('php://input'), true);

$request_method = $_SERVER['REQUEST_METHOD'];


class ConsumerEndpoint
{


    public function getConsumerById()
    {

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $customer = Consumer::getId($id);
            print_r(json_encode($customer));
        } else {
            print_r([
                "statusCode" => 500,
                "message" => "id missing"
            ]);
        }
    }

    public function getAllConsumers()
    {
        $consumers = Consumer::all();

        print_r(json_encode($consumers));
    }

    public function createConsumer()
    {
        global $data;

        $consumer = new Consumer();
        $consumer->setAccountNo($data['account_no']);
        $consumer->setConnectionCode($data['connection_code']);
        $consumer->setConsumerName($data['consumer_name']);
        $consumer->setZoneId($data['zone_id']);
        $consumer->setZoneName($data['zone_name']);
        $consumer->setRouteId($data['route_id']);
        $consumer->setRouteName($data['route_name']);
        $consumer->setPlotNumber($data['plot_number']);
        $consumer->setBalance($data['balance']);
        $consumer->setSerialNo($data['serial_no']);
        $consumer->setPhoneNumber($data['phone_number']);
        $consumer->setConnectionStatus($data['connection_status']);



        $created = $consumer->create();
        if ($created) {
            print_r(json_encode([
                "statusCode" => 200,
                "message" => "Consumer Registered successfully"
            ]));
        } else {
            print_r(json_encode([
                "statusCode" => 500,
                "message" => "Error occurred when registering consumer"
            ]));
        }
    }

    public function updateConsumer()
    {

        global $data;

        $consumer = new Consumer();
        $consumer->setAccountNo($data['account_no']);
        $consumer->setConnectionCode($data['connection_code']);
        $consumer->setConsumerName($data['consumer_name']);
        $consumer->setZoneId($data['zone_id']);
        $consumer->setZoneName($data['zone_name']);
        $consumer->setRouteId($data['route_id']);
        $consumer->setRouteName($data['route_name']);
        $consumer->setPlotNumber($data['plot_number']);
        $consumer->setBalance($data['balance']);
        $consumer->setSerialNo($data['serial_no']);
        $consumer->setPhoneNumber($data['phone_number']);
        $consumer->setConnectionStatus($data['connection_status']);



        // get the id we are updating
        $id = $data['id'];

        $updated = $consumer->update($id);
        if ($updated) {
            print_r(json_encode([
                "statusCode" => 200,
                "message" => "Consumer Updated successfully"
            ]));
        } else {
            print_r(json_encode([
                "statusCode" => 500,
                "message" => "Error occurred when updating consumer"
            ]));
        }
    }

    public function deleteConsumer()
    {
        global $data;
        $id = $data['id'];

        $deleted = Consumer::delete($id);
        if ($deleted) {
            print_r(json_encode([
                "statusCode" => 204,
                "message" => "Consumer deleted successfully"
            ]));
        } else {
            print_r(json_encode([
                "statusCode" => 500,
                "message" => "Error occurred while deleting consumer"
            ]));
        }
    }
}

// check the request method used and respond accordingly

if ($request_method == 'GET' and empty($data)) {
    // instantiate endpoint class
    $endpoint = new ConsumerEndpoint();
    if (isset($_GET['id'])) {
        $endpoint->getConsumerById();
    } else {
        $endpoint->getAllConsumers();
    }
}

if ($request_method == 'POST') {
    global $data;

    $endpoint = new ConsumerEndpoint();
    $endpoint->createConsumer();

}

if ($request_method == 'PUT') {

    $endpoint = new ConsumerEndpoint($data);
    $endpoint->updateConsumer();

}

if ($request_method == 'DELETE') {
    global $data;

    $endpoint = new ConsumerEndpoint($data);
    $endpoint->deleteConsumer();

}