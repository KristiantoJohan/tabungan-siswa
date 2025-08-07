<?php

namespace App\Services;

use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;

class MqttService
{
    protected $mqtt;
    protected $clientId;

    public function __construct()
    {
        $host = env('MQTT_HOST');
        $port = env('MQTT_PORT');
        $username = env('MQTT_USERNAME');
        $password = env('MQTT_PASSWORD');
        $this->clientId = env('MQTT_CLIENT_ID', 'laravel-client');

        $settings = (new ConnectionSettings)
            ->setUsername($username)
            ->setPassword($password);

        $this->mqtt = new MqttClient($host, $port, $this->clientId);
        $this->mqtt->connect($settings, true);
    }

    public function publish(string $topic, string $message, int $qos = 0)
    {
        $this->mqtt->publish($topic, $message, $qos);
        $this->mqtt->disconnect();
    }

    public function subscribe(string $topic, callable $callback, int $qos = 0)
    {
        $this->mqtt->subscribe($topic, $callback, $qos);
        $this->mqtt->loop(true);
        $this->mqtt->disconnect();
    }
}