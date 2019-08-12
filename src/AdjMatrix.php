<?php


namespace src;


class AdjMatrix
{
    private $V;
    private $E;
    private $adj = [];

    public function __construct(string $filename)
    {
        $graph = @file_get_contents($filename);
        if ($graph === false) {
            exit('无此文件');
        }
        $graph = Util::strToArray($graph);
        $this->V = array_shift($graph);
        $this->E = array_shift($graph);
        $this->adj = Util::get2dArray($this->V);
        while (count($graph) > 0) {
            $a = array_shift($graph);
            $b = array_shift($graph);
            $this->adj[$a][$b] = 1;
            $this->adj[$b][$a] = 1;
        }
    }

    public function __toString(): string
    {
        $str = "V = {$this->V}, E = {$this->E}" . PHP_EOL;
        for ($i = 0; $i < $this->V; $i++) {
            for ($j = 0; $j < $this->V; $j++) {
                $int = $this->adj[$i][$j];
                $str .= "$int ";
            }
            $str .= PHP_EOL;
        }
        return $str;
    }
}