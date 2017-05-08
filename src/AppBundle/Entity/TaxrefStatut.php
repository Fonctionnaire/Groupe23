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
     * @var ArrayCollection Taxref
     * @ORM\Id()
     * @ORM\OneToMany(targetEntity="Taxref", mappedBy="fr_statut", cascade={"persist"})
     * @ORM\OneToMany(targetEntity="Taxref", mappedBy="gf_statut", cascade={"persist"})
     * @ORM\OneToMany(targetEntity="Taxref", mappedBy="mar_statut", cascade={"persist"})
     * @ORM\OneToMany(targetEntity="Taxref", mappedBy="gua_statut", cascade={"persist"})
     * @ORM\OneToMany(targetEntity="Taxref", mappedBy="fr_statut", cascade={"persist"})
     * @ORM\OneToMany(targetEntity="Taxref", mappedBy="sm_statut", cascade={"persist"})
     * @ORM\OneToMany(targetEntity="Taxref", mappedBy="sb_statut", cascade={"persist"})
     * @ORM\OneToMany(targetEntity="Taxref", mappedBy="spm_statut", cascade={"persist"})
     * @ORM\OneToMany(targetEntity="Taxref", mappedBy="may_statut", cascade={"persist"})
     * @ORM\OneToMany(targetEntity="Taxref", mappedBy="epa_statut", cascade={"persist"})
     * @ORM\OneToMany(targetEntity="Taxref", mappedBy="reu_statut", cascade={"persist"})
     * @ORM\OneToMany(targetEntity="Taxref", mappedBy="sa_statut", cascade={"persist"})
     * @ORM\OneToMany(targetEntity="Taxref", mappedBy="ta_statut", cascade={"persist"})
     * @ORM\OneToMany(targetEntity="Taxref", mappedBy="taaf_statut", cascade={"persist"})
     * @ORM\OneToMany(targetEntity="Taxref", mappedBy="nc_statut", cascade={"persist"})
     * @ORM\OneToMany(targetEntity="Taxref", mappedBy="wf_statut", cascade={"persist"})
     * @ORM\OneToMany(targetEntity="Taxref", mappedBy="pf_statut", cascade={"persist"})
     * @ORM\OneToMany(targetEntity="Taxref", mappedBy="cli_statut", cascade={"persist"})
     * @ORM\Column(name="statut")
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
     * @ORM\Column(name="definition", type="text")
     */
    private $definition;


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

