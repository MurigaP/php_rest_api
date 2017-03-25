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
    private $data;

    public function __construct($data = [])
    {
        $this->data = $data;
    }

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
        $data = $this->data;

        $consumer = new Consumer();
        $consumer->setAccountNo($data['account_no']);
        $consumer->setConnectionCode($data['connection_code']);
        $consumer->setConsumerName($data['consumer_name']);
        $consumer->setZoneId($data['zone_id']);
        $consumer->setRouteId($data['route_id']);
        $consumer->setPlotNumber($data['plot_number']);
        $consumer->setBalance($data['balance']);
        $consumer->setSerialNo($data['serial_no']);
        $consumer->setPhoneNumber($data['phone_number']);
        $consumer->setConnectionStatus($data['connection_data']);

        $created = $consumer->create();
        if ($created) {
            print_r(json_encode([
                "statusCode" => 200,
                "message" => "Consumer Registered successfully"
            ]));
        }
        else{
            print_r(json_encode([
                "statusCode" => 500,
                "message" => "Error occurred when registering consumer"
            ]));
        }
    }

    public function updateConsumer(){

        $data = $this->data;

        $consumer = new Consumer();
        $consumer->setAccountNo($data['account_no']);
        $consumer->setConnectionCode($data['connection_code']);
        $consumer->setConsumerName($data['consumer_name']);
        $consumer->setZoneId($data['zone_id']);
        $consumer->setRouteId($data['route_id']);
        $consumer->setPlotNumber($data['plot_number']);
        $consumer->setBalance($data['balance']);
        $consumer->setSerialNo($data['serial_no']);
        $consumer->setPhoneNumber($data['phone_number']);
        $consumer->setConnectionStatus($data['connection_data']);

        // get the id we are updating
        $id = $data['id'];

        $updated = $consumer->update($id);
        if ($updated) {
            print_r(json_encode([
                "statusCode" => 200,
                "message" => "Consumer Updated successfully"
            ]));
        }
        else{
            print_r(json_encode([
                "statusCode" => 500,
                "message" => "Error occurred when updating consumer"
            ]));
        }
    }

    public function deleteConsumer(){
        $data = $this->data;
        $id = $data['id'];

        $deleted = Consumer::delete($id);
        if ($deleted){
            print_r(json_encode([
                "statusCode" => 204,
                "message" => "Consumer deleted successfully"
            ]));
        }
        else{
            print_r(json_encode([
                "statusCode" => 500,
                "message" => "Error occurred while deleting consumer"
            ]));
        }
    }
}

// check the request method used and respond accordingly

if ($request_method == 'GET' and empty($data)){
    // instantiate endpoint class
    $endpoint = new ConsumerEndpoint();
    if (isset($_GET['id'])){
        $endpoint->getConsumerById();
    }
    else{
        $endpoint->getAllConsumers();
    }
}

if ($request_method == 'POST'){
    global $data;
    if (!empty($data)){
        $endpoint = new ConsumerEndpoint($data);
        $endpoint->createConsumer();
    }
    else{
        print_r(json_encode([
            "statusCode" => 500,
            "message" => "No json data received"
        ]));
    }
}

if ($request_method == 'PUT'){
    global $data;
    if (!empty($data)){
        $endpoint = new ConsumerEndpoint($data);
        $endpoint->updateConsumer();
    }
    else{
        print_r(json_encode([
            "statusCode" => 500,
            "message" => "No json data received"
        ]));
    }
}

if($request_method == 'DELETE') {
    global $data;
    if (!empty($data)){
        $endpoint = new ConsumerEndpoint($data);
        $endpoint->deleteConsumer();
    }
    else{
        print_r(json_encode([
            "statusCode" => 500,
            "message" => "No json data received"
        ]));
    }
}