<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use ServerPlanning\Server;
use ServerPlanning\ServerPanning;

final class ServerPlanningTest extends TestCase
{
    public function test_needs_0_servers_if_VirtualMachines_list_is_empty(): void
    {
        $planner = new ServerPanning();
        $server = new Server(0, 0, 0);

        $this->assertEquals(0, $planner->calculate($server, []));
    }
}
