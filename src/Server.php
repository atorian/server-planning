<?php
declare(strict_types=1);


namespace ServerPlanning;


final class Server
{
    private $cpu;
    private $ram;
    private $hdd;

    /**
     * Server constructor.
     * @param $cpu
     * @param $ram
     * @param $hdd
     */
    public function __construct($cpu, $ram, $hdd)
    {
        $this->cpu = $cpu;
        $this->ram = $ram;
        $this->hdd = $hdd;
    }

}
