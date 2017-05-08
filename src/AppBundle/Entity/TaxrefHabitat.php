<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * TaxrefHabitats
 *
 * @ORM\Table(name="taxref_habitat")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TaxrefHabitatsRepository")
 */
class TaxrefHabitat
{
    /**
     * @var ArrayCollection Taxref
     * @ORM\Id()
     * @ORM\OneToMany(targetEntity="Taxref", mappedBy="habitat", cascade={"persist"})
     * @ORM\Column(name="habitat")
     */
    private $taxrefs;

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
     * Set taxrefs
     *
     * @param integer $taxrefs
     *
     * @return TaxrefHabitat
     */
    public function setTaxrefs($taxrefs)
    {
        $this->taxrefs = $taxrefs;

        return $this;
    }

    /**
     * Get taxrefs
     *
     * @return ArrayCollection taxrefs
     */
    public function getTaxrefs()
    {
        return $this->taxrefs;
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
