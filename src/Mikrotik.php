<?php

namespace ArDigital\Mikrotik;

use PEAR2\Net\RouterOS;

class Mikrotik
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
    public function Command($command)
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
        return $this->Command('/ip/address/print');
    }

    // Get Interfaces
    public function interfaces()
    {
        return $this->Command('/interface/print');
    }

    // Get Firewall Filter Lists
    public function firewallFilter()
    {
        return $this->Command('/ip/firewall/filter/print');
    }

    //Get Firewall Nat
    public function firewallNat()
    {
        return $this->Command('/ip/firewall/nat/print');
    }

    // System Reboot Router Board
    public function rebootSystem()
    {
        $this->connection->sendSync(new RouterOS\Request('/system/reboot'));
        return ['status' => 'success'];
    }
    // DHCP Client List
    public function dhcpClient(){

        return $this->Command('/ip/dhcp-client/print');
    }

    // DHCP Server List
    public function dhcpServer(){
        return $this->Command('/ip/dhcp-server/print');
    }


}
