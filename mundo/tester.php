<?php
namespace Comercial\mundo;

use Comercial\dal;
include_once '../dal/querybuilder.php';
include_once '../dal/history.php';
include_once './commonFunc.inc.php';

echo commonFunc::DateTimeNow();
echo commonFunc::getServerNamePort();

$h = new dal\History("marca", 4, 'i');
echo $h->toString();
echo commonFunc::stringPar(commonFunc::DateTimeNow());