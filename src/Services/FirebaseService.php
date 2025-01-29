<?php

namespace AbdelrhmanSaeed\Tpo\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Contract\Database;
use Workerman\Worker;
use Workerman\Timer;


class FirebaseService
{
    private Database $firebase;
    private Worker $worker;
    private mixed $lastData = null;


    public function __construct()
    {
        $this->firebase = (new Factory())->withServiceAccount('')
                        ->withDatabaseUri('')
                        ->createDatabase();

        $this->worker = new Worker('127.0.0.1:8080');

        $this->worker->onConnect = fn ($connection): string => "new client connection!\n";
        $this->worker->onMessage = fn ($connection, $data) : void
                                        => $this->onMessage($connection, $data);

        $this->worker->onWorkerStart = fn () => $this->onStart();
    }

    public function onStart(): void
    {
        Timer::add(5, function ()
            {
                $newData = $this->firebase
                                ->getReference('messages')
                                ->getValue();

                if ($newData === $this->lastData) {
                    return;
                }

                echo "Firebase Data Changed!\n";

                foreach($this->worker->connections as $connection) {
                    $connection->send(json_encode($newData));
                }

                $this->lastData = $newData;
                
            });
    }

    public function onMessage($connection, $data)
    {

    }

}