<?php

namespace src;

use InvalidArgumentException;
use Exception;

/**
 * 邻接矩阵类
 * Class AdjMatrix
 * @package src
 */
class AdjMatrix
{
    /**
     * 顶点数
     * @var int
     */
    private $V;
    /**
     * 边数
     * @var int
     */
    private $E;
    /**
     * 邻接矩阵
     * @var array
     */
    private $adj = [];

    public function __construct(string $filename)
    {
        try {
            $graph = @file_get_contents($filename);
            if ($graph === false) {
                throw new InvalidArgumentException("未找到{$filename}路径对应的文件！");
            }

            $graph = Util::strToArray($graph);
            $this->V = array_shift($graph);
            if ($this->V < 0) {
                throw new InvalidArgumentException("V 必须是非负整数");
            }

            if ($this->E < 0) {
                throw new InvalidArgumentException("E 必须是非负整数");
            }

            $this->E = array_shift($graph);
            $this->adj = Util::get2dArray($this->V);
            while (count($graph) > 0) {
                $a = array_shift($graph);
                $b = array_shift($graph);
                $this->validateVertex($a);
                $this->validateVertex($b);
                if ($a === $b) {
                    throw new InvalidArgumentException("该图存在自环边！");
                }

                if ($this->adj[$a][$b] === 1) {
                    throw new InvalidArgumentException("该图存在平行边！");
                }

                $this->adj[$a][$b] = 1;
                $this->adj[$b][$a] = 1;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }

    public function V(): string
    {
        return $this->V;
    }

    public function E(): string
    {
        return $this->E;
    }

    public function hasEdge(int $v, int $w): bool
    {
        $this->validateVertex($v);
        $this->validateVertex($w);
        return $this->adj[$v][$w] === 1;
    }

    public function adj(int $v): array
    {
        $this->validateVertex($v);
        $res = [];
        for ($i = 0; $i < $this->V; $i++) {
            if ($this->adj[$v][$i] === 1) {
                array_push($res, $i);
            }
        }

        return $res;
    }

    public function degree(int $v): int
    {
        return count($this->adj($v));
    }

    /**
     * 验证顶点是否合法
     * @param int $v
     */
    private function validateVertex(int $v): void
    {
        if ($v < 0 || $v == $this->V) {
            throw new InvalidArgumentException("顶点 ${$v} 不合法");
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