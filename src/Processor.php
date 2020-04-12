<?php

namespace ArDigital\Mikrotik;

use PEAR2\Net\RouterOS;

class Processor
{

    protected $connection; // Connection Class

    // Constructor Connection Function
    public function __construct()
    {
        try {
            $this->connection = new RouterOS\Client(config('mikrotik.ip_address'), config('mikrotik.username'), config('mikrotik.password'));
        } catch (Exception $e) {
            die('Unable to connect to the router.');
        }
    }

    // Get Resultant Command
    public function printCommand($command)
    {
        $results = [];
        $responses = $this->connection->sendSync(new RouterOS\Request($command));
        foreach ($responses as $key => $tara) {
            $arr = [];
            foreach ($tara as $keys => $te) {
                $arr[$keys] = $te;
            }
            array_push($results, $arr);
        }
        return array_filter($results); // Remove Empty array using array_filter
    }

    // Get Ip Address
    public function getIps()
    {
        return $this->printCommand('/ip/address/print');
    }

    // Get Interfaces
    public function interfaces()
    {
        return $this->printCommand('/interface/print');
    }

    // Get Firewall Filter Lists
    public function firewallFilter()
    {
        return $this->printCommand('/ip/firewall/filter/print');
    }

    //Get Firewall Nat
    public function firewallNat()
    {
        return $this->printCommand('/ip/firewall/nat/print');
    }

    // System Reboot Router Board
    public function rebootSystem()
    {
        $this->connection->sendSync(new RouterOS\Request('/system/reboot'));
        return ['status' => 'success'];
    }
    // DHCP Client List
    public function dhcpClient(){

        return $this->printCommand('/ip/dhcp-client/print');
    }

    // DHCP Server List
    public function dhcServer(){
        return $this->printCommand('/ip/dhcp-server/print');
    }


}
