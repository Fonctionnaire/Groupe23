<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;



/**
 * TaxrefHabitat
 *
 * @ORM\Table(name="taxref_habitat")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TaxrefHabitatRepository")
 */
class TaxrefHabitat
{

    public function __toString()
    {
        return $this->description;
    }


    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(name="habitatId")
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Taxref", mappedBy="habitat")
     */
     private $habitatId;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="remarques", type="text")
     */
    private $remarques;


    /**
     * Set habitatId
     *
     * @param string $habitatId
     *
     * @return TaxrefHabitat
     */
    public function setHabitatId($habitatId)
    {
        $this->habitatId = $habitatId;

        return $this;
    }

    /**
     * Get habitatId
     *
     * @return string
     */
    public function getHabitatId()
    {
        return $this->habitatId;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return TaxrefHabitat
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set remarques
     *
     * @param string $remarques
     *
     * @return TaxrefHabitat
     */
    public function setRemarques($remarques)
    {
        $this->remarques = $remarques;

        return $this;
    }

    /**
     * Get remarques
     *
     * @return string
     */
    public function getRemarques()
    {
        return $this->remarques;
    }
}
