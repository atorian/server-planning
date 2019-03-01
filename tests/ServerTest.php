<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use ServerPlanning\InsufficientResourcesException;
use ServerPlanning\Server;
use ServerPlanning\VirtualMachine;

final class ServerTest extends TestCase
{
    public function test_can_host_vm_if_all_parameters_are_gte_expected(): void
    {
        $server = new Server(2, 32, 100);
        $server->empty();

        $vm = new VirtualMachine(1, 16, 10);

        $this->assertTrue($server->canHost($vm));
    }

    public function test_hosting_vm_occupies_resources(): void
    {
        $server = new Server(2, 32, 100);
        $vm = new VirtualMachine(1, 16, 10);

        $server->empty();
        $server->host($vm);

        $this->assertEquals(1, $server->getAvailableCpu());
        $this->assertEquals(16, $server->getAvailableRam());
        $this->assertEquals(90, $server->getAvailableHdd());
    }

    public function test_throws_is_hosted_vm_is_too_big(): void
    {

        $server = new Server(1, 16, 10);
        $vm = new VirtualMachine(2, 32, 100);

        $server->empty();

        $this->expectException(InsufficientResourcesException::class);

        $server->host($vm);
    }

}
