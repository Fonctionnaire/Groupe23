<?php

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Taxref
 *
 * @ORM\Table(name="taxref")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TaxrefRepository")
 */
class Taxref
{

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Observation", mappedBy="Taxref")
     */
    private $observations;



    /**
     * @var string
     *
     * @ORM\Column(name="Regne", type="string", length=255, options={"comment":"Règne auquel le taxon appartient"})
     */
    private $regne;

    /**
     * @var string
     *
     * @ORM\Column(name="Phylum", type="string", length=255, options={"comment":"Embranchement auquel le taxon appartient"})
     */
    private $phylum;

    /**
     * @var string
     *
     * @ORM\Column(name="Classe", type="string", length=255, options={"comment":"classe à laquelle le taxon appartient"})
     */
    private $classe;

    /**
     * @var string
     *
     * @ORM\Column(name="Ordre", type="string", length=255, options={"comment":"ordre auquel le taxon appartient"})
     */
    private $ordre;

    /**
     * @var string
     *
     * @ORM\Column(name="Famille", type="string", length=255, options={"comment":"Famille à laquelle le taxon appartient"})
     */
    private $famille;

    /**
     * @var int
     * @ORM\id
     * @ORM\Column(name="CD_NOM", type="integer", unique=true, options={"comment":"Identifiant unique du nom scientifique"})
     */
    private $cdnom;

    /**
     * @var int
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Taxref")
     * @ORM\JoinColumn(name="CD_TAXSUP", referencedColumnName="CD_NOM")
     * @ORM\Column(name="CD_TAXSUP", type="integer", nullable=true, options={"comment":"Identifiant (CD_NOM) du taxon supérieur"})
     */
    private $cdtaxsup;

    /**
     * @var int
     *
     * @ORM\Column(name="CD_REF", type="integer", options={"comment":"Identifiant (CD_NOM) du taxon de référence (nom retenu)"})
     */
    private $cdref;

    /**
     * Plusieurs espèces peuvent avoir le même rang
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefRang")
     * @ORM\JoinColumn(nullable=false, referencedColumnName="rang")
     */
    private $rang;

    /**
     * @var string
     *
     * @ORM\Column(name="LB_NOM", type="string", length=255, options={"comment":"Nom scientifique du taxon (sans l’autorité)"})
     */
    private $lbnom;

    /**
     * @var string
     *
     * @ORM\Column(name="LB_AUTEUR", type="string", length=255, nullable=true, options={"comment":"Autorité du taxon (Auteur, année, gestion des parenthèses)"})
     */
    private $lbauteur;

    /**
     * @var string
     *
     * @ORM\Column(name="NOM_COMPLET", type="string", length=255, options={"comment":"Combinaison des champs pour donner le nom complet (~LB_NOM+' ' +LB_AUTEUR)"})
     */
    private $nomcomplet;

    /**
     * @var string
     *
     * @ORM\Column(name="NOM_VALIDE", type="string", length=255, options={"comment":"Le NOM_COMPLET du CD_REF"})
     */
    private $nomvalide;

    /**
     * @var string
     *
     * @ORM\Column(name="NOM_VERN", type="string", length=255, nullable=true, options={"comment":"Nom(s) vernaculaire(s) du taxon"})
     */
    private $nonvern;

    /**
     * @var string
     *
     * @ORM\Column(name="NOM_VERN_ENG", type="string", length=255, nullable=true, options={"comment":"Nom(s) vernaculaire(s) du taxon en Anglais"})
     */
    private $nomverneng;

    /**
     *
     * Plusieurs espèces peuvent avoir le même habitat
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefHabitat")
     * @ORM\JoinColumn(nullable=false, referencedColumnName="habitatId")
     */
    private $habitat;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefStatut")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="statut")
     */
    private $fr_statut;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefStatut")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="statut")
     */
    private $gf_statut;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefStatut")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="statut")
     */
    private $mar_statut;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefStatut")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="statut")
     */
    private $gua_statut;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefStatut")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="statut")
     */
    private $sm_statut;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefStatut")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="statut")
     */
    private $sb_statut;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefStatut")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="statut")
     */
    private $spm_statut;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefStatut")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="statut")
     */
    private $may_statut;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefStatut")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="statut")
     */
    private $epa_statut;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefStatut")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="statut")
     */
    private $reu_statut;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefStatut")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="statut")
     */
    private $sa_statut;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefStatut")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="statut")
     */
    private $ta_statut;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefStatut")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="statut")
     */
    private $taaf_statut;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefStatut")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="statut")
     */
    private $nc_statut;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefStatut")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="statut")
     */
    private $wf_statut;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefStatut")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="statut")
     */
    private $pf_statut;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefStatut")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="statut")
     */
    private $cli_statut;



    /**
     * Set regne
     *
     * @param string $regne
     *
     * @return Taxref
     */
    public function setRegne($regne)
    {
        $this->regne = $regne;

        return $this;
    }

    /**
     * Get regne
     *
     * @return string
     */
    public function getRegne()
    {
        return $this->regne;
    }

    /**
     * Set phylum
     *
     * @param string $phylum
     *
     * @return Taxref
     */
    public function setPhylum($phylum)
    {
        $this->phylum = $phylum;

        return $this;
    }

    /**
     * Get phylum
     *
     * @return string
     */
    public function getPhylum()
    {
        return $this->phylum;
    }

    /**
     * Set classe
     *
     * @param string $classe
     *
     * @return Taxref
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * Get classe
     *
     * @return string
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * Set ordre
     *
     * @param string $ordre
     *
     * @return Taxref
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return string
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    /**
     * Set famille
     *
     * @param string $famille
     *
     * @return Taxref
     */
    public function setFamille($famille)
    {
        $this->famille = $famille;

        return $this;
    }

    /**
     * Get famille
     *
     * @return string
     */
    public function getFamille()
    {
        return $this->famille;
    }

    /**
     * Set cdnom
     *
     * @param integer $cdnom
     *
     * @return Taxref
     */
    public function setCdnom($cdnom)
    {
        $this->cdnom = $cdnom;

        return $this;
    }

    /**
     * Get cdnom
     *
     * @return integer
     */
    public function getCdnom()
    {
        return $this->cdnom;
    }

    /**
     * Set cdtaxsup
     *
     * @param integer $cdtaxsup
     *
     * @return Taxref
     */
    public function setCdtaxsup($cdtaxsup)
    {
        $this->cdtaxsup = $cdtaxsup;

        return $this;
    }

    /**
     * Get cdtaxsup
     *
     * @return integer
     */
    public function getCdtaxsup()
    {
        return $this->cdtaxsup;
    }

    /**
     * Set cdref
     *
     * @param integer $cdref
     *
     * @return Taxref
     */
    public function setCdref($cdref)
    {
        $this->cdref = $cdref;

        return $this;
    }

    /**
     * Get cdref
     *
     * @return integer
     */
    public function getCdref()
    {
        return $this->cdref;
    }

    /**
     * Set lbnom
     *
     * @param string $lbnom
     *
     * @return Taxref
     */
    public function setLbnom($lbnom)
    {
        $this->lbnom = $lbnom;

        return $this;
    }

    /**
     * Get lbnom
     *
     * @return string
     */
    public function getLbnom()
    {
        return $this->lbnom;
    }

    /**
     * Set lbauteur
     *
     * @param string $lbauteur
     *
     * @return Taxref
     */
    public function setLbauteur($lbauteur)
    {
        $this->lbauteur = $lbauteur;

        return $this;
    }

    /**
     * Get lbauteur
     *
     * @return string
     */
    public function getLbauteur()
    {
        return $this->lbauteur;
    }

    /**
     * Set nomcomplet
     *
     * @param string $nomcomplet
     *
     * @return Taxref
     */
    public function setNomcomplet($nomcomplet)
    {
        $this->nomcomplet = $nomcomplet;

        return $this;
    }

    /**
     * Get nomcomplet
     *
     * @return string
     */
    public function getNomcomplet()
    {
        return $this->nomcomplet;
    }

    /**
     * Set nomvalide
     *
     * @param string $nomvalide
     *
     * @return Taxref
     */
    public function setNomvalide($nomvalide)
    {
        $this->nomvalide = $nomvalide;

        return $this;
    }

    /**
     * Get nomvalide
     *
     * @return string
     */
    public function getNomvalide()
    {
        return $this->nomvalide;
    }

    /**
     * Set nonvern
     *
     * @param string $nonvern
     *
     * @return Taxref
     */
    public function setNonvern($nonvern)
    {
        $this->nonvern = $nonvern;

        return $this;
    }

    /**
     * Get nonvern
     *
     * @return string
     */
    public function getNonvern()
    {
        return $this->nonvern;
    }

    /**
     * Set nomverneng
     *
     * @param string $nomverneng
     *
     * @return Taxref
     */
    public function setNomverneng($nomverneng)
    {
        $this->nomverneng = $nomverneng;

        return $this;
    }

    /**
     * Get nomverneng
     *
     * @return string
     */
    public function getNomverneng()
    {
        return $this->nomverneng;
    }

    /**
     * Set rang
     *
     * @param \AppBundle\Entity\TaxrefRang $rang
     *
     * @return Taxref
     */
    public function setRang(\AppBundle\Entity\TaxrefRang $rang)
    {
        $this->rang = $rang;

        return $this;
    }

    /**
     * Get rang
     *
     * @return \AppBundle\Entity\TaxrefRang
     */
    public function getRang()
    {
        return $this->rang;
    }

    /**
     * Set habitat
     *
     * @param \AppBundle\Entity\TaxrefHabitat $habitat
     *
     * @return Taxref
     */
    public function setHabitat(\AppBundle\Entity\TaxrefHabitat $habitat = null)
    {
        $this->habitat = $habitat;

        return $this;
    }

    /**
     * Get habitat
     *
     * @return \AppBundle\Entity\TaxrefHabitat
     */
    public function getHabitat()
    {
        return $this->habitat;
    }

    /**
     * Set frStatut
     *
     * @param \AppBundle\Entity\TaxrefStatut $frStatut
     *
     * @return Taxref
     */
    public function setFrStatut(\AppBundle\Entity\TaxrefStatut $frStatut = null)
    {
        $this->fr_statut = $frStatut;

        return $this;
    }

    /**
     * Get frStatut
     *
     * @return \AppBundle\Entity\TaxrefStatut
     */
    public function getFrStatut()
    {
        return $this->fr_statut;
    }

    /**
     * Set gfStatut
     *
     * @param \AppBundle\Entity\TaxrefStatut $gfStatut
     *
     * @return Taxref
     */
    public function setGfStatut(\AppBundle\Entity\TaxrefStatut $gfStatut = null)
    {
        $this->gf_statut = $gfStatut;

        return $this;
    }

    /**
     * Get gfStatut
     *
     * @return \AppBundle\Entity\TaxrefStatut
     */
    public function getGfStatut()
    {
        return $this->gf_statut;
    }

    /**
     * Set marStatut
     *
     * @param \AppBundle\Entity\TaxrefStatut $marStatut
     *
     * @return Taxref
     */
    public function setMarStatut(\AppBundle\Entity\TaxrefStatut $marStatut = null)
    {
        $this->mar_statut = $marStatut;

        return $this;
    }

    /**
     * Get marStatut
     *
     * @return \AppBundle\Entity\TaxrefStatut
     */
    public function getMarStatut()
    {
        return $this->mar_statut;
    }

    /**
     * Set guaStatut
     *
     * @param \AppBundle\Entity\TaxrefStatut $guaStatut
     *
     * @return Taxref
     */
    public function setGuaStatut(\AppBundle\Entity\TaxrefStatut $guaStatut = null)
    {
        $this->gua_statut = $guaStatut;

        return $this;
    }

    /**
     * Get guaStatut
     *
     * @return \AppBundle\Entity\TaxrefStatut
     */
    public function getGuaStatut()
    {
        return $this->gua_statut;
    }

    /**
     * Set smStatut
     *
     * @param \AppBundle\Entity\TaxrefStatut $smStatut
     *
     * @return Taxref
     */
    public function setSmStatut(\AppBundle\Entity\TaxrefStatut $smStatut = null)
    {
        $this->sm_statut = $smStatut;

        return $this;
    }

    /**
     * Get smStatut
     *
     * @return \AppBundle\Entity\TaxrefStatut
     */
    public function getSmStatut()
    {
        return $this->sm_statut;
    }

    /**
     * Set sbStatut
     *
     * @param \AppBundle\Entity\TaxrefStatut $sbStatut
     *
     * @return Taxref
     */
    public function setSbStatut(\AppBundle\Entity\TaxrefStatut $sbStatut = null)
    {
        $this->sb_statut = $sbStatut;

        return $this;
    }

    /**
     * Get sbStatut
     *
     * @return \AppBundle\Entity\TaxrefStatut
     */
    public function getSbStatut()
    {
        return $this->sb_statut;
    }

    /**
     * Set spmStatut
     *
     * @param \AppBundle\Entity\TaxrefStatut $spmStatut
     *
     * @return Taxref
     */
    public function setSpmStatut(\AppBundle\Entity\TaxrefStatut $spmStatut = null)
    {
        $this->spm_statut = $spmStatut;

        return $this;
    }

    /**
     * Get spmStatut
     *
     * @return \AppBundle\Entity\TaxrefStatut
     */
    public function getSpmStatut()
    {
        return $this->spm_statut;
    }

    /**
     * Set mayStatut
     *
     * @param \AppBundle\Entity\TaxrefStatut $mayStatut
     *
     * @return Taxref
     */
    public function setMayStatut(\AppBundle\Entity\TaxrefStatut $mayStatut = null)
    {
        $this->may_statut = $mayStatut;

        return $this;
    }

    /**
     * Get mayStatut
     *
     * @return \AppBundle\Entity\TaxrefStatut
     */
    public function getMayStatut()
    {
        return $this->may_statut;
    }

    /**
     * Set epaStatut
     *
     * @param \AppBundle\Entity\TaxrefStatut $epaStatut
     *
     * @return Taxref
     */
    public function setEpaStatut(\AppBundle\Entity\TaxrefStatut $epaStatut = null)
    {
        $this->epa_statut = $epaStatut;

        return $this;
    }

    /**
     * Get epaStatut
     *
     * @return \AppBundle\Entity\TaxrefStatut
     */
    public function getEpaStatut()
    {
        return $this->epa_statut;
    }

    /**
     * Set reuStatut
     *
     * @param \AppBundle\Entity\TaxrefStatut $reuStatut
     *
     * @return Taxref
     */
    public function setReuStatut(\AppBundle\Entity\TaxrefStatut $reuStatut = null)
    {
        $this->reu_statut = $reuStatut;

        return $this;
    }

    /**
     * Get reuStatut
     *
     * @return \AppBundle\Entity\TaxrefStatut
     */
    public function getReuStatut()
    {
        return $this->reu_statut;
    }

    /**
     * Set saStatut
     *
     * @param \AppBundle\Entity\TaxrefStatut $saStatut
     *
     * @return Taxref
     */
    public function setSaStatut(\AppBundle\Entity\TaxrefStatut $saStatut = null)
    {
        $this->sa_statut = $saStatut;

        return $this;
    }

    /**
     * Get saStatut
     *
     * @return \AppBundle\Entity\TaxrefStatut
     */
    public function getSaStatut()
    {
        return $this->sa_statut;
    }

    /**
     * Set taStatut
     *
     * @param \AppBundle\Entity\TaxrefStatut $taStatut
     *
     * @return Taxref
     */
    public function setTaStatut(\AppBundle\Entity\TaxrefStatut $taStatut = null)
    {
        $this->ta_statut = $taStatut;

        return $this;
    }

    /**
     * Get taStatut
     *
     * @return \AppBundle\Entity\TaxrefStatut
     */
    public function getTaStatut()
    {
        return $this->ta_statut;
    }

    /**
     * Set taafStatut
     *
     * @param \AppBundle\Entity\TaxrefStatut $taafStatut
     *
     * @return Taxref
     */
    public function setTaafStatut(\AppBundle\Entity\TaxrefStatut $taafStatut = null)
    {
        $this->taaf_statut = $taafStatut;

        return $this;
    }

    /**
     * Get taafStatut
     *
     * @return \AppBundle\Entity\TaxrefStatut
     */
    public function getTaafStatut()
    {
        return $this->taaf_statut;
    }

    /**
     * Set ncStatut
     *
     * @param \AppBundle\Entity\TaxrefStatut $ncStatut
     *
     * @return Taxref
     */
    public function setNcStatut(\AppBundle\Entity\TaxrefStatut $ncStatut = null)
    {
        $this->nc_statut = $ncStatut;

        return $this;
    }

    /**
     * Get ncStatut
     *
     * @return \AppBundle\Entity\TaxrefStatut
     */
    public function getNcStatut()
    {
        return $this->nc_statut;
    }

    /**
     * Set wfStatut
     *
     * @param \AppBundle\Entity\TaxrefStatut $wfStatut
     *
     * @return Taxref
     */
    public function setWfStatut(\AppBundle\Entity\TaxrefStatut $wfStatut = null)
    {
        $this->wf_statut = $wfStatut;

        return $this;
    }

    /**
     * Get wfStatut
     *
     * @return \AppBundle\Entity\TaxrefStatut
     */
    public function getWfStatut()
    {
        return $this->wf_statut;
    }

    /**
     * Set pfStatut
     *
     * @param \AppBundle\Entity\TaxrefStatut $pfStatut
     *
     * @return Taxref
     */
    public function setPfStatut(\AppBundle\Entity\TaxrefStatut $pfStatut = null)
    {
        $this->pf_statut = $pfStatut;

        return $this;
    }

    /**
     * Get pfStatut
     *
     * @return \AppBundle\Entity\TaxrefStatut
     */
    public function getPfStatut()
    {
        return $this->pf_statut;
    }

    /**
     * Set cliStatut
     *
     * @param \AppBundle\Entity\TaxrefStatut $cliStatut
     *
     * @return Taxref
     */
    public function setCliStatut(\AppBundle\Entity\TaxrefStatut $cliStatut = null)
    {
        $this->cli_statut = $cliStatut;

        return $this;
    }

    /**
     * Get cliStatut
     *
     * @return \AppBundle\Entity\TaxrefStatut
     */
    public function getCliStatut()
    {
        return $this->cli_statut;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->observations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add observation
     *
     * @param \AppBundle\Entity\Observation $observation
     *
     * @return Taxref
     */
    public function addObservation(\AppBundle\Entity\Observation $observation)
    {
        $this->observations[] = $observation;
        $observation->setTaxref($this);

        return $this;
    }

    /**
     * Remove observation
     *
     * @param \AppBundle\Entity\Observation $observation
     */
    public function removeObservation(\AppBundle\Entity\Observation $observation)
    {
        $this->observations->removeElement($observation);
    }

    /**
     * Get observations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getObservations()
    {
        return $this->observations;
    }
}
