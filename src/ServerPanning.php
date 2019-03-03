<?php
declare(strict_types=1);


namespace ServerPlanning;


class ServerPanning
{
    /**
     * Not static as it's better for testing and
     * most likely will be used later
     *
     * @param Server $serverType
     * @param VirtualMachine[] $virtualMachines
     * @return int
     */
    public function calculate(Server $serverType, array $virtualMachines): int
    {
        if (count($virtualMachines) == 0) {
            return 0;
        }

        foreach ($virtualMachines as $vm) {
            $serverType->host($vm);
        }

        return $serverType->instances();
    }
}
