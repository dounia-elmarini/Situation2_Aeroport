<?php

namespace Dev\AeroportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reserve
 *
 * @ORM\Table(name="reserve")
 * @ORM\Entity(repositoryClass="Dev\AeroportBundle\Entity\ReserveRepository")
 */
class Reserve
{
    /**
     * @var integer
     *
     * @ORM\Column(name="vol_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $volId;

    /**
     * @var string
     *
     * @ORM\Column(name="cli_id", type="string", length=11, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $cliId;



    /**
     * Set volId
     *
     * @param integer $volId
     * @return Reserve
     */
    public function setVolId($volId)
    {
        $this->volId = $volId;
    
        return $this;
    }

    /**
     * Get volId
     *
     * @return integer 
     */
    public function getVolId()
    {
        return $this->volId;
    }

    /**
     * Set cliId
     *
     * @param string $cliId
     * @return Reserve
     */
    public function setCliId($cliId)
    {
        $this->cliId = $cliId;
    
        return $this;
    }

    /**
     * Get cliId
     *
     * @return string 
     */
    public function getCliId()
    {
        return $this->cliId;
    }
}