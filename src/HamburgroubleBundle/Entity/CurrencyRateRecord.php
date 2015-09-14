<?php

namespace Etki\Projects\Hamburgrouble\HamburgroubleBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Currency rate record entity.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Projects\Hamburgrouble\HamburgroubleBundle\Entity
 * @author  Etki <etki@etki.name>
 */
class CurrencyRateRecord
{
    /**
     * Identifier.
     *
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @type int
     * @since 0.1.0
     */
    private $id;
    /**
     * Date of the rate record.
     *
     * @ORM\Column(type="datetimetz", nullable=false)
     *
     * @type DateTime
     * @since 0.1.0
     */
    private $date;
    /**
     * Currency rate.
     *
     * @ORM\Column(type="float", nullable=false)
     *
     * @type float
     * @since 0.1.0
     */
    private $rate;

    /**
     * Returns id.
     *
     * @return int
     * @since 0.1.0
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets id.
     *
     * @param int $id Id.
     *
     * @return $this Current instance.
     * @since 0.1.0
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Returns date.
     *
     * @return DateTime
     * @since 0.1.0
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Sets date.
     *
     * @param DateTime $date Date.
     *
     * @return $this Current instance.
     * @since 0.1.0
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Returns rate.
     *
     * @return float
     * @since 0.1.0
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Sets rate.
     *
     * @param float $rate Rate.
     *
     * @return $this Current instance.
     * @since 0.1.0
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
        return $this;
    }
}
