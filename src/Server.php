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
     * @param $cpu int - max available CPU units
     * @param $ram int - max available RAG Gb
     * @param $hdd int - max available HDD Gb
     */
    public function __construct($cpu, $ram, $hdd)
    {
        $this->cpu = $cpu;
        $this->ram = $ram;
        $this->hdd = $hdd;
    }

    private function canHost(VirtualMachine $vm): bool
    {
        return $this->availableCpu >= $vm->getCpu() &&
            $this->availableRam >= $vm->getRam() &&
            $this->availableHdd >= $vm->getHdd();
    }

    private function next(): void
    {
        $this->availableCpu = $this->cpu;
        $this->availableRam = $this->ram;
        $this->availableHdd = $this->hdd;

        $this->instances += 1;
    }

    public function host(VirtualMachine $vm): void
    {
        if (!$this->canHost($vm)) {
            $this->next();
        }

        $this->availableCpu -= $vm->getCpu();
        $this->availableRam -= $vm->getRam();
        $this->availableHdd -= $vm->getHdd();

        if ($this->availableCpu < 0) {
            throw InsufficientResourcesException::cpu($this, $vm);
        }

        if ($this->availableRam < 0) {
            throw InsufficientResourcesException::ram($this, $vm);
        }

        if ($this->availableHdd < 0) {
            throw InsufficientResourcesException::hdd($this, $vm);
        }
    }

    public function instances(): int
    {
        return $this->instances;
    }

    /**
     * @return int
     */
    public function getCpu(): int
    {
        return $this->cpu;
    }

    /**
     * @return int
     */
    public function getRam(): int
    {
        return $this->ram;
    }

    /**
     * @return int
     */
    public function getHdd(): int
    {
        return $this->hdd;
    }
}
