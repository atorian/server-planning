<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use ServerPlanning\Server;
use ServerPlanning\ServerPanning;
use ServerPlanning\VirtualMachine;

final class ServerPlanningTest extends TestCase
{
    public function test_needs_0_servers_if_VirtualMachines_list_is_empty(): void
    {
        $planner = new ServerPanning();
        $server = new Server(0, 0, 0);

        $this->assertEquals(0, $planner->calculate($server, []));
    }

    public function test_needs_1_server_if_VirtualMachine_fits_server(): void
    {
        $planner = new ServerPanning();
        $server = new Server(2, 32, 100);
        $vm = new VirtualMachine(1, 16, 10);

        $this->assertEquals(1, $planner->calculate($server, [$vm]));
    }
}
