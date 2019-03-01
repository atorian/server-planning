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
    /** @var int */
    private $instances = 0;

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
        $this->next();
    }

    private function canHost(VirtualMachine $vm): bool
    {
        return $this->availableCpu >= $vm->getCpu() &&
            $this->availableRam >= $vm->getRam() &&
            $this->availableHdd >= $vm->getHdd();
    }

    private function next()
    {
        $this->availableCpu = $this->cpu;
        $this->availableRam = $this->ram;
        $this->availableHdd = $this->hdd;

        $this->instances += 1;
    }

    public function host(VirtualMachine $vm)
    {
        if (!$this->canHost($vm)) {
            $this->next();
        }

        $this->availableCpu -= $vm->getCpu();
        $this->availableRam -= $vm->getRam();
        $this->availableHdd -= $vm->getHdd();

        if ($this->availableCpu < 0 || $this->availableRam < 0 || $this->availableHdd < 0) {
            throw new InsufficientResourcesException($this, $vm);
        }
    }

    public function instances(): int
    {
        return $this->instances;
    }
}
