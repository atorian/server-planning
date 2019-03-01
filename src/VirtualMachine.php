<?php
declare(strict_types=1);


namespace ServerPlanning;


class VirtualMachine
{
    /**
     * @var int
     */
    private $cpu;
    /**
     * @var int
     */
    private $ram;
    /**
     * @var int
     */
    private $hdd;

    /**
     * VirtualMachine constructor.
     * @param $cpu int
     * @param $ram int
     * @param $hdd int
     */
    public function __construct($cpu, $ram, $hdd)
    {
        $this->cpu = $cpu;
        $this->ram = $ram;
        $this->hdd = $hdd;
    }

    public function getCpu(): int {
        return $this->cpu;
    }

    public function getRam(): int
    {
        return $this->ram;
    }

    public function getHdd(): int
    {
        return $this->hdd;
    }
}
