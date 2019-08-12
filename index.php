<?php
// 声明严格类型模式
declare(strict_types=1);
use src\AdjMatrix;
require 'vendor/autoload.php';

$adjMatrix = new AdjMatrix('asset/g.txt');
echo $adjMatrix;