<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 3/25/17
 * Time: 4:00 PM
 */

require_once __DIR__ . '/../db/db_connection.php';

class Consumer implements ApiCrud
{

    private $accountNo;
    private $connectionCode;
    private $consumerName;
    private $zoneId;
    private $zoneName;
    private $routeId;
    private $routeName;
    private $plotNumber;
    private $balance;
    private $serialNo;
    private $phoneNumber;
    private $connectionStatus;

    /**
     * @return mixed
     */
    public function getAccountNo()
    {
        return $this->accountNo;
    }

    /**
     * @param mixed $accountNo
     */
    public function setAccountNo($accountNo)
    {
        $this->accountNo = $accountNo;
    }

    /**
     * @return mixed
     */
    public function getConnectionCode()
    {
        return $this->connectionCode;
    }

    /**
     * @param mixed $connectionCode
     */
    public function setConnectionCode($connectionCode)
    {
        $this->connectionCode = $connectionCode;
    }

    /**
     * @return mixed
     */
    public function getConsumerName()
    {
        return $this->consumerName;
    }

    /**
     * @param mixed $consumerName
     */
    public function setConsumerName($consumerName)
    {
        $this->consumerName = $consumerName;
    }

    /**
     * @return mixed
     */
    public function getZoneId()
    {
        return $this->zoneId;
    }

    /**
     * @param mixed $zoneId
     */
    public function setZoneId($zoneId)
    {
        $this->zoneId = $zoneId;
    }

    /**
     * @return mixed
     */
    public function getZoneName()
    {
        return $this->zoneName;
    }

    /**
     * @param mixed $zoneName
     */
    public function setZoneName($zoneName)
    {
        $this->zoneName = $zoneName;
    }

    /**
     * @return mixed
     */
    public function getRouteId()
    {
        return $this->routeId;
    }

    /**
     * @param mixed $routeId
     */
    public function setRouteId($routeId)
    {
        $this->routeId = $routeId;
    }

    /**
     * @return mixed
     */
    public function getRouteName()
    {
        return $this->routeName;
    }

    /**
     * @param mixed $routeName
     */
    public function setRouteName($routeName)
    {
        $this->routeName = $routeName;
    }

    /**
     * @return mixed
     */
    public function getPlotNumber()
    {
        return $this->plotNumber;
    }

    /**
     * @param mixed $plotNumber
     */
    public function setPlotNumber($plotNumber)
    {
        $this->plotNumber = $plotNumber;
    }

    /**
     * @return mixed
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @param mixed $balance
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    }

    /**
     * @return mixed
     */
    public function getSerialNo()
    {
        return $this->serialNo;
    }

    /**
     * @param mixed $serialNo
     */
    public function setSerialNo($serialNo)
    {
        $this->serialNo = $serialNo;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param mixed $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return mixed
     */
    public function getConnectionStatus()
    {
        return $this->connectionStatus;
    }

    /**
     * @param mixed $connectionStatus
     */
    public function setConnectionStatus($connectionStatus)
    {
        $this->connectionStatus = $connectionStatus;
    }


    /**
     * @return bool
     */
    public function create()
    {
        global $conn;

        //get the variables

        $accountNo = $this->getAccountNo();
        $connectionCode = $this->getConnectionCode();
        $customerName = $this->getConsumerName();
        $zoneId = $this->getZoneId();
        $zoneName = $this->getZoneName();
        $routeId = $this->getRouteId();
        $routeName = $this->getRouteName();
        $plotNumber = $this->getPlotNumber();
        $balance = $this->getBalance();
        $serialNo = $this->getSerialNo();
        $phoneNumber = $this->getPhoneNumber();
        $connectionStatus = $this->getConnectionStatus();

        try {

            $stmt = $conn->prepare("INSERT INTO consumers(account_no, connection_code, consumer_name, zone_id, zone_name, route_id, route_name, plot_number, balance, serial_no, phone_number, connection_status) 
                                    VALUES(:account_no, :connection_code, :consumer_name, :zone_id, :zone_name, :route_id, :route_name, :plot_number, :balance, :serial_no, :phone_number, :connection_status)");

            $stmt->bindParam(":account_no", $accountNo);
            $stmt->bindParam(":connection_code", $connectionCode);
            $stmt->bindParam(":consumer_name", $customerName);
            $stmt->bindParam(":zone_id", $zoneId);
            $stmt->bindParam(":zone_name", $zoneName);
            $stmt->bindParam(":route_id", $routeId);
            $stmt->bindParam(":route_name", $routeName);
            $stmt->bindParam(":plot_number", $plotNumber);
            $stmt->bindParam(":balance", $balance);
            $stmt->bindParam(":serial_no", $serialNo);
            $stmt->bindParam(":phone_number", $phoneNumber);
            $stmt->bindParam(":connection_status", $connectionStatus);

            $stmt->execute();
            return true;


        } catch (PDOException $e) {

            print_r(json_encode(array(
                'statusCode' => 500,
                'message' => "Error " . $e->getMessage()
            )));
            return false;
        }


    }

    /**
     * @param $id
     * @return bool
     */
    public function update($id)
    {
        global $conn;

        $accountNo = $this->getAccountNo();
        $connectionCode = $this->getConnectionCode();
        $customerName = $this->getConsumerName();
        $zoneId = $this->getZoneId();
        $zoneName = $this->getZoneName();
        $routeId = $this->getRouteId();
        $routeName = $this->getRouteName();
        $plotNumber = $this->getPlotNumber();
        $balance = $this->getBalance();
        $serialNo = $this->getSerialNo();
        $phoneNumber = $this->getPhoneNumber();
        $connectionStatus = $this->getConnectionStatus();

        try {

            $stmt = $conn->prepare("UPDATE consumers SET account_no=:account_no, connection_code=:connection_code,
                                consumer_name=:consumer_name, zone_id=:zone_id, zone_name=:zone_name,
                                route_id=:route_id, route_name=:route_name, plot_number=:plot_number,
                                balance=:balance, serial_no=:serial_no, phone_number=:phone_number,
                                connection_status=:connection_status
                                WHERE id=:id");

            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":account_no", $accountNo);
            $stmt->bindParam(":connection_code", $connectionCode);
            $stmt->bindParam(":consumer_name", $customerName);
            $stmt->bindParam(":zone_id", $zoneId);
            $stmt->bindParam(":zone_name", $zoneName);
            $stmt->bindParam(":route_id", $routeId);
            $stmt->bindParam(":route_name", $routeName);
            $stmt->bindParam(":plot_number", $plotNumber);
            $stmt->bindParam(":balance", $balance);
            $stmt->bindParam(":serial_no", $serialNo);
            $stmt->bindParam(":phone_number", $phoneNumber);
            $stmt->bindParam(":connection_status", $connectionStatus);

            $stmt->execute();
            return true;

        } catch (PDOException $e) {
            print_r(json_encode(array(
                'statusCode' => 500,
                'message' => "Error " . $e->getMessage()
            )));
            return false;
        }


    }

    /**
     * @param $id
     * @return bool
     */
    public static function delete($id)
    {
        global $conn;

        try {
            $stmt = $conn->prepare("DELETE FROM consumers WHERE  id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return true;

        } catch (PDOException $e) {
            print_r(json_encode(array(
                'statusCode' => 500,
                'message' => "Error " . $e->getMessage()
            )));
            return false;
        }

    }

    /**
     * @param $id
     * @return array
     */
    public static function getId($id)
    {
        global $conn;

        try {

            $stmt = $conn->prepare("SELECT * FROM consumers WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            if ($stmt->rowCount() != 1) {
                return [];
            }
            else {

                $customer = $stmt->fetch(PDO::FETCH_ASSOC);

                return $customer;
            }


        } catch (PDOException $e) {
            print_r(json_encode(array(
                'statusCode' => 500,
                'message' => "Error " . $e->getMessage()
            )));
            return [];
        }
    }

    /**
     * @return array
     */
    public static function all()
    {
        global $conn;
        try{

            $stmt = $conn->prepare("SELECT * FROM consumers WHERE 1");
            $stmt->execute();
            if($stmt->rowCount() > 0){
                $consumers = [];
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $consumers[] = $row;
                }

                return $consumers;
            }else{
                return [];
            }

        } catch (PDOException $e){
            print_r(json_encode(array(
                'statusCode' => 500,
                'message' => "Error " . $e->getMessage()
            )));
            return [];
        }
    }

}