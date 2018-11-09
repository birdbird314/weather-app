<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * City
 *
 * @ORM\Table(name="city")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CityRepository")
 */
class City
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="city_name", type="string", length=255)
     */
    private $cityName;

    /**
     * @var string
     *
     * @ORM\Column(name="contry_code", type="string", length=2)
     */
    private $contryCode;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set cityName
     *
     * @param string $cityName
     *
     * @return City
     */
    public function setCityName($cityName)
    {
        $this->cityName = $cityName;

        return $this;
    }

    /**
     * Get cityName
     *
     * @return string
     */
    public function getCityName()
    {
        return $this->cityName;
    }

    /**
     * Set contryCode
     *
     * @param string $contryCode
     *
     * @return City
     */
    public function setContryCode($contryCode)
    {
        $this->contryCode = $contryCode;

        return $this;
    }

    /**
     * Get contryCode
     *
     * @return string
     */
    public function getContryCode()
    {
        return $this->contryCode;
    }
}

