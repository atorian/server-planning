<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use ServerPlanning\InsufficientResourcesException;
use ServerPlanning\Server;
use ServerPlanning\VirtualMachine;

final class ServerTest extends TestCase
{

    /**
     * @dataProvider bigVm
     */
    public function test_throws_if_hosted_vm_is_too_big(VirtualMachine $vm): void
    {
        $server = new Server(2, 32, 100);

        $this->expectException(InsufficientResourcesException::class);

        $server->host($vm);
    }

    public function test_required_instances_is_0_if_no_vms_hosted(): void
    {
        $server = new Server(1, 16, 10);

        $this->assertEquals(0, $server->instances());
    }

    public function bigVm()
    {
        return [
            [new VirtualMachine(4, 32, 100)],
            [new VirtualMachine(2, 64, 100)],
            [new VirtualMachine(2, 32, 200)],
        ];
    }
}
