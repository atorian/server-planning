<?php
declare(strict_types=1);


namespace ServerPlanning;


class ServerPanning
{

    /**
     * ServerPanning constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param Server $server
     * @param VirtualMachine[] $virtualMachines
     * @return int
     */
    public function calculate(Server $server, array $virtualMachines): int
    {
        $serversNeeded = 0;

        foreach ($virtualMachines as $vm) {
            if ($server->canHost($vm)) {
                $server->host($vm);
                $serversNeeded += 1;
            }
        }

        return $serversNeeded;
    }
}
