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
        $this->cpu = $cpu;
        $this->ram = $ram;
        $this->hdd = $hdd;
        $this->empty();
    }

    public function canHost(VirtualMachine $vm): bool
    {
        return $this->availableCpu >= $vm->getCpu() &&
            $this->availableRam >= $vm->getRam() &&
            $this->availableHdd >= $vm->getHdd();
    }

    public function empty()
    {
        $this->availableCpu = $this->cpu;
        $this->availableRam = $this->ram;
        $this->availableHdd = $this->hdd;
    }

    public function host(VirtualMachine $vm)
    {
        $this->availableCpu -= $vm->getCpu();
        $this->availableRam -= $vm->getRam();
        $this->availableHdd -= $vm->getHdd();

        if ($this->availableCpu < 0 || $this->availableRam < 0 || $this->availableHdd < 0) {
            throw new InsufficientResourcesException();
        }
    }


    public function getAvailableCpu(): int
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
