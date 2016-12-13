<?php
/**
 * Created by PhpStorm.
 * User: takeuchi
 * Date: 2016/12/09
 * Time: 17:44
 */

namespace Mo3g4u\Wareki;

use Symfony\Component\Yaml\Yaml;

class Wareki
{
    /**
     * @var array
     */
    private $warekiConf = [];

    /**
     * @var \DateTime
     */
    private $dateTime;

    /**
     * @var string
     */
    private $caption = '';

    /**
     * @var string
     */
    private $year = '';

    /**
     * Wareki constructor.
     */
    public function __construct()
    {
        $this->warekiConf = Yaml::parse(file_get_contents(__DIR__.'/../config/wareki.yaml'));
        $this->dateTime = new \DateTime();
        $this->searchEra();
    }

    /**
     * @return string
     */
    public function eraName()
    {
        return $this->caption;
    }

    /**
     * @return string
     */
    public function year()
    {
        return $this->year;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date)
    {
        $this->dateTime = $date;
        $this->searchEra();
    }

    /**
     * @return string
     */
    public function toString()
    {
        return sprintf("%s%s年%02d月%02d日",
            $this->caption,
            $this->year,
            $this->dateTime->format('m'),
            $this->dateTime->format('d')
        );
    }

    private function searchEra()
    {
        $end = new \DateTime();
        foreach ($this->warekiConf as $item){
            $start = new \DateTime($item['start']);
            if($item['end']){
                $end = new \DateTime($item['end']);
            }
            if($start <= $this->dateTime && $this->dateTime <= $end){
                $this->caption = $item['caption'];
                $this->year = $this->dateTime->format('Y') - $start->format('Y') + 1;
                if($this->year === 1){
                    $this->year = '元';
                }
                break;
            }
        }
    }
}