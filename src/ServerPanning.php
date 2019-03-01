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
        if (count($virtualMachines) == 0) {
            return 0;
        }

        foreach ($virtualMachines as $vm) {
            $server->host($vm);
        }

        return $server->instances();
    }
}
