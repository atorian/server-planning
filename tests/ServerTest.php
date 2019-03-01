<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use ServerPlanning\InsufficientResourcesException;
use ServerPlanning\Server;
use ServerPlanning\VirtualMachine;

final class ServerTest extends TestCase
{
    public function test_throws_if_hosted_vm_is_too_big(): void
    {
        $server = new Server(1, 16, 10);
        $vm = new VirtualMachine(2, 32, 100);

        $this->expectException(InsufficientResourcesException::class);

        $server->host($vm);
    }
}
