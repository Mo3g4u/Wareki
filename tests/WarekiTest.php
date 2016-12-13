<?php
/**
 * Created by PhpStorm.
 * User: takeuchi
 * Date: 2016/12/09
 * Time: 17:47
 */

namespace Mo3g4u\Wareki;


class WarekiTest extends \PHPUnit_Framework_TestCase
{


    public function testToString()
    {
        $wareki = new Wareki();
        $date = new \DateTime('2014-08-01');
        $wareki->setDate($date);
        $this->assertEquals('平成26年08月01日', $wareki->toString());
        $this->assertEquals('平成', $wareki->eraName());
        $this->assertEquals('26', $wareki->year());
    }



    public function testShowaToHeisei()
    {
        $wareki = new Wareki();
        $date = new \DateTime('1989-01-07');
        $wareki->setDate($date);
        $this->assertEquals('昭和64年01月07日', $wareki->toString());
        $date = new \DateTime('1989-01-08');
        $wareki->setDate($date);
        $this->assertEquals('平成元年01月08日', $wareki->toString());
        $date = new \DateTime('1990-01-08');
        $wareki->setDate($date);
        $this->assertEquals('平成2年01月08日', $wareki->toString());
    }



}
