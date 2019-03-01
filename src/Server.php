<?php
declare(strict_types=1);


namespace ServerPlanning;


final class Server
{
    /** @var int */
    private $cpu;
    /** @var int */
    private $ram;
    /** @var int */
    private $hdd;
    /** @var int */
    private $availableCpu = 0;
    /** @var int */
    private $availableRam = 0;
    /** @var int */
    private $availableHdd = 0;

    /**
     * Server constructor.
     * @param $cpu int
     * @param $ram int
     * @param $hdd int
     */
    public function __construct($cpu, $ram, $hdd)
    {
        $this->cpu = $this->availableCpu = $cpu;
        $this->ram = $this->availableRam = $ram;
        $this->hdd = $this->availableHdd = $hdd;
    }

    public function canHost(VirtualMachine $vm): bool
    {
        return $this->cpu >= $vm->getCpu() &&
            $this->ram >= $vm->getRam() &&
            $this->hdd >= $vm->getHdd();
    }

    public function host(VirtualMachine $vm)
    {
        $this->availableCpu -= $vm->getCpu();
        $this->availableRam -= $vm->getRam();
        $this->availableHdd -= $vm->getHdd();
    }

    public function getAvaliableCpu(): int
    {
        return $this->availableCpu;
    }

    public function getAvailableRam(): int
    {
        return $this->availableRam;
    }

    public function getAvailableHdd(): int
    {
        return $this->availableHdd;
    }
}
