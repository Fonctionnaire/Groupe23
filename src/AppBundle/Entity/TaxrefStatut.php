<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * TaxrefStatuts
 *
 * @ORM\Table(name="taxref_statuts")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TaxrefStatutsRepository")
 */
class TaxrefStatut
{


    /**
     * @var string Taxref
     * @ORM\Id
     * @ORM\Column(name="statut")
     */
    private $statut;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="definition", type="text")
     */
    private $definition;



    /**
     * Set statut
     *
     * @param string $statut
     *
     * @return TaxrefStatut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return TaxrefStatut
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
     * Set definition
     *
     * @param string $definition
     *
     * @return TaxrefStatut
     */
    public function setDefinition($definition)
    {
        $this->definition = $definition;

        return $this;
    }

    /**
     * Get definition
     *
     * @return string
     */
    public function getDefinition()
    {
        return $this->definition;
    }
}
