<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use ServerPlanning\InsufficientResourcesException;
use ServerPlanning\InvalidResourceProvisionException;
use ServerPlanning\Server;
use ServerPlanning\VirtualMachine;

final class ServerTest extends TestCase
{

    public function test_server_cpu_must_be_gt_0(): void
    {
        $this->expectException(InvalidResourceProvisionException::class);

        $server = new Server(0, 1, 1);
    }

    public function test_server_ram_must_be_gt_0(): void
    {
        $this->expectException(InvalidResourceProvisionException::class);

        $server = new Server(1, 0, 1);
    }

    public function test_server_hdd_must_be_gt_0(): void
    {
        $this->expectException(InvalidResourceProvisionException::class);

        $server = new Server(1, 1, 0);
    }
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
