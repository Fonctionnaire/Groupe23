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
     * @ORM\OneToOne(targetEntity="Student")
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
     * @var TaxrefRang
     *
     * @ORM\Column(name="RANG", type="string", length=255, options={"comment":"Rang taxonomique (clé vers TAXREF_RANG)"})
     * Plusieurs espèces peuvent avoir le même rang
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefRang", inversedBy="taxrefs")
     * @ORM\JoinColumn(name="taxrefs", referencedColumnName="rang")
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
     * @var TaxrefHabitat
     * @ORM\Column(name="HABITAT", type="smallint", options={"comment":"Code de l'habitat (clé vers TAXREF_HABITAT)"})
     * Plusieurs espèces peuvent avoir le même habitat
     * @ORM\ManyToOne(targetEntity="TaxrefHabitat", inversedBy="taxrefs")
     * @ORM\JoinColumn(name="habitat", referencedColumnName="habitat")
     */
    private $habitat;

    /**
     * @var TaxrefStatut
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefStatut", inversedBy="taxrefs")
     * @ORM\JoinColumn(name="statut", referencedColumnName="statut")
     * @ORM\Column(name="FR", type="string", length=1, nullable=true, options={"comment":"Statut biogéographique en France métropolitaine (clé vers TAXREF_STATUTS)"})
     */
    private $fr_statut;

    /**
     * @var TaxrefStatut
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefStatut", inversedBy="taxrefs")
     * @ORM\JoinColumn(name="statut", referencedColumnName="statut")
     * @ORM\Column(name="GF", type="string", length=1, nullable=true, options={"comment":"Statut biogéographique en Guyane française (clé vers TAXREF_STATUTS)"})
     */
    private $gf_statut;

    /**
     * @var TaxrefStatut
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefStatut", inversedBy="taxrefs")
     * @ORM\JoinColumn(name="statut", referencedColumnName="statut")
     * @ORM\Column(name="MAR", type="string", length=1, nullable=true, options={"comment":"Statut biogéographique à la Martinique (clé vers TAXREF_STATUTS)"})
     */
    private $mar_statut;

    /**
     * @var TaxrefStatut
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefStatut", inversedBy="taxrefs")
     * @ORM\JoinColumn(name="statut", referencedColumnName="statut")
     * @ORM\Column(name="GUA", type="string", length=1, nullable=true, options={"comment":"Statut biogéographique à la Guadeloupe (clé vers TAXREF_STATUTS)"})
     */
    private $gua_statut;

    /**
     * @var TaxrefStatut
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefStatut", inversedBy="taxrefs")
     * @ORM\JoinColumn(name="statut", referencedColumnName="statut")
     * @ORM\Column(name="SM", type="string", length=1, nullable=true, options={"comment":"Statut biogéographique à Saint-Martin (clé vers TAXREF_STATUTS)"})
     */
    private $sm_statut;

    /**
     * @var TaxrefStatut
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefStatut", inversedBy="taxrefs")
     * @ORM\JoinColumn(name="statut", referencedColumnName="statut")
     * @ORM\Column(name="SB", type="string", length=1, nullable=true, options={"comment":"Statut biogéographique à Saint-Barthélemy (clé vers TAXREF_STATUTS)"})
     */
    private $sb_statut;

    /**
     * @var TaxrefStatut
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefStatut", inversedBy="taxrefs")
     * @ORM\JoinColumn(name="statut", referencedColumnName="statut")
     * @ORM\Column(name="SPM", type="string", length=1, nullable=true, options={"comment":"Statut biogéographique à Saint-Pierre et Miquelon (clé vers TAXREF_STATUTS)"})
     */
    private $spm_statut;

    /**
     * @var TaxrefStatut
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefStatut", inversedBy="taxrefs")
     * @ORM\JoinColumn(name="statut", referencedColumnName="statut")
     * @ORM\Column(name="MAY", type="string", length=1, nullable=true, options={"comment":"Statut biogéographique à Mayotte (clé vers TAXREF_STATUTS)"})
     */
    private $may_statut;

    /**
     * @var TaxrefStatut
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefStatut", inversedBy="taxrefs")
     * @ORM\JoinColumn(name="statut", referencedColumnName="statut")
     * @ORM\Column(name="EPA", type="string", length=1, nullable=true, options={"comment":"Statut biogéographique aux îles Éparses (clé vers TAXREF_STATUTS)"})
     */
    private $epa_statut;

    /**
     * @var TaxrefStatut
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefStatut", inversedBy="taxrefs")
     * @ORM\JoinColumn(name="statut", referencedColumnName="statut")
     * @ORM\Column(name="REU", type="string", length=1, nullable=true, options={"comment":"Statut biogéographique à la Réunion (clé vers TAXREF_STATUTS)"})
     */
    private $reu_statut;

    /**
     * @var TaxrefStatut
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefStatut", inversedBy="taxrefs")
     * @ORM\JoinColumn(name="statut", referencedColumnName="statut")
     * @ORM\Column(name="SA", type="string", length=1, nullable=true, options={"comment":"Statut biogéographique aux îles subantarctiques (clé vers TAXREF_STATUTS)"})
     */
    private $sa_statut;

    /**
     * @var TaxrefStatut
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefStatut", inversedBy="taxrefs")
     * @ORM\JoinColumn(name="statut", referencedColumnName="statut")
     * @ORM\Column(name="TA", type="string", length=1, nullable=true, options={"comment":"Statut biogéographique en Terre Adélie (clé vers TAXREF_STATUTS)"})
     */
    private $ta_statut;

    /**
     * @var TaxrefStatut
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefStatut", inversedBy="taxrefs")
     * @ORM\JoinColumn(name="statut", referencedColumnName="statut")
     * @ORM\Column(name="TAAF", type="string", length=1, nullable=true, options={"comment":"Statut biogéographique aux Terres australes et antarctiques françaises (clé vers TAXREF_STATUTS)"})
     */
    private $taaf_statut;

    /**
     * @var TaxrefStatut
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefStatut", inversedBy="taxrefs")
     * @ORM\JoinColumn(name="statut", referencedColumnName="statut")
     * @ORM\Column(name="NC", type="string", length=1, nullable=true, options={"comment":"Statut biogéographique en Nouvelle-Calédonie (clé vers TAXREF_STATUTS)"})
     */
    private $nc_statut;

    /**
     * @var TaxrefStatut
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefStatut", inversedBy="taxrefs")
     * @ORM\JoinColumn(name="statut", referencedColumnName="statut")
     * @ORM\Column(name="WF", type="string", length=1, nullable=true, options={"comment":"Statut biogéographique à Wallis et Futuna (clé vers TAXREF_STATUTS)"})
     */
    private $wf_statut;

    /**
     * @var TaxrefStatut
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefStatut", inversedBy="taxrefs")
     * @ORM\JoinColumn(name="statut", referencedColumnName="statut")
     * @ORM\Column(name="PF", type="string", length=1, nullable=true, options={"comment":"Statut biogéographique en Polynésie française (clé vers TAXREF_STATUTS)"})
     */
    private $pf_statut;

    /**
     * @var TaxrefStatut
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TaxrefStatut", inversedBy="taxrefs")
     * @ORM\JoinColumn(name="statut", referencedColumnName="statut")
     * @ORM\Column(name="CLI", type="string", length=1, nullable=true, options={"comment":"Statut biogéographique à Clipperton (clé vers TAXREF_STATUTS)"})
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
     * Set rang
     *
     * @param string $rang
     *
     * @return Taxref
     */
    public function setRang($rang)
    {
        $this->rang = $rang;

        return $this;
    }

    /**
     * Get rang
     *
     * @return string
     */
    public function getRang()
    {
        return $this->rang;
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
     * Set habitat
     *
     * @param integer $habitat
     *
     * @return Taxref
     */
    public function setHabitat($habitat)
    {
        $this->habitat = $habitat;

        return $this;
    }

    /**
     * Get habitat
     *
     * @return integer
     */
    public function getHabitat()
    {
        return $this->habitat;
    }

    /**
     * Set frStatut
     *
     * @param string $frStatut
     *
     * @return Taxref
     */
    public function setFrStatut($frStatut)
    {
        $this->fr_statut = $frStatut;

        return $this;
    }

    /**
     * Get frStatut
     *
     * @return string
     */
    public function getFrStatut()
    {
        return $this->fr_statut;
    }

    /**
     * Set gfStatut
     *
     * @param string $gfStatut
     *
     * @return Taxref
     */
    public function setGfStatut($gfStatut)
    {
        $this->gf_statut = $gfStatut;

        return $this;
    }

    /**
     * Get gfStatut
     *
     * @return string
     */
    public function getGfStatut()
    {
        return $this->gf_statut;
    }

    /**
     * Set marStatut
     *
     * @param string $marStatut
     *
     * @return Taxref
     */
    public function setMarStatut($marStatut)
    {
        $this->mar_statut = $marStatut;

        return $this;
    }

    /**
     * Get marStatut
     *
     * @return string
     */
    public function getMarStatut()
    {
        return $this->mar_statut;
    }

    /**
     * Set guaStatut
     *
     * @param string $guaStatut
     *
     * @return Taxref
     */
    public function setGuaStatut($guaStatut)
    {
        $this->gua_statut = $guaStatut;

        return $this;
    }

    /**
     * Get guaStatut
     *
     * @return string
     */
    public function getGuaStatut()
    {
        return $this->gua_statut;
    }

    /**
     * Set smStatut
     *
     * @param string $smStatut
     *
     * @return Taxref
     */
    public function setSmStatut($smStatut)
    {
        $this->sm_statut = $smStatut;

        return $this;
    }

    /**
     * Get smStatut
     *
     * @return string
     */
    public function getSmStatut()
    {
        return $this->sm_statut;
    }

    /**
     * Set sbStatut
     *
     * @param string $sbStatut
     *
     * @return Taxref
     */
    public function setSbStatut($sbStatut)
    {
        $this->sb_statut = $sbStatut;

        return $this;
    }

    /**
     * Get sbStatut
     *
     * @return string
     */
    public function getSbStatut()
    {
        return $this->sb_statut;
    }

    /**
     * Set spmStatut
     *
     * @param string $spmStatut
     *
     * @return Taxref
     */
    public function setSpmStatut($spmStatut)
    {
        $this->spm_statut = $spmStatut;

        return $this;
    }

    /**
     * Get spmStatut
     *
     * @return string
     */
    public function getSpmStatut()
    {
        return $this->spm_statut;
    }

    /**
     * Set mayStatut
     *
     * @param string $mayStatut
     *
     * @return Taxref
     */
    public function setMayStatut($mayStatut)
    {
        $this->may_statut = $mayStatut;

        return $this;
    }

    /**
     * Get mayStatut
     *
     * @return string
     */
    public function getMayStatut()
    {
        return $this->may_statut;
    }

    /**
     * Set epaStatut
     *
     * @param string $epaStatut
     *
     * @return Taxref
     */
    public function setEpaStatut($epaStatut)
    {
        $this->epa_statut = $epaStatut;

        return $this;
    }

    /**
     * Get epaStatut
     *
     * @return string
     */
    public function getEpaStatut()
    {
        return $this->epa_statut;
    }

    /**
     * Set reuStatut
     *
     * @param string $reuStatut
     *
     * @return Taxref
     */
    public function setReuStatut($reuStatut)
    {
        $this->reu_statut = $reuStatut;

        return $this;
    }

    /**
     * Get reuStatut
     *
     * @return string
     */
    public function getReuStatut()
    {
        return $this->reu_statut;
    }

    /**
     * Set saStatut
     *
     * @param string $saStatut
     *
     * @return Taxref
     */
    public function setSaStatut($saStatut)
    {
        $this->sa_statut = $saStatut;

        return $this;
    }

    /**
     * Get saStatut
     *
     * @return string
     */
    public function getSaStatut()
    {
        return $this->sa_statut;
    }

    /**
     * Set taStatut
     *
     * @param string $taStatut
     *
     * @return Taxref
     */
    public function setTaStatut($taStatut)
    {
        $this->ta_statut = $taStatut;

        return $this;
    }

    /**
     * Get taStatut
     *
     * @return string
     */
    public function getTaStatut()
    {
        return $this->ta_statut;
    }

    /**
     * Set taafStatut
     *
     * @param string $taafStatut
     *
     * @return Taxref
     */
    public function setTaafStatut($taafStatut)
    {
        $this->taaf_statut = $taafStatut;

        return $this;
    }

    /**
     * Get taafStatut
     *
     * @return string
     */
    public function getTaafStatut()
    {
        return $this->taaf_statut;
    }

    /**
     * Set ncStatut
     *
     * @param string $ncStatut
     *
     * @return Taxref
     */
    public function setNcStatut($ncStatut)
    {
        $this->nc_statut = $ncStatut;

        return $this;
    }

    /**
     * Get ncStatut
     *
     * @return string
     */
    public function getNcStatut()
    {
        return $this->nc_statut;
    }

    /**
     * Set wfStatut
     *
     * @param string $wfStatut
     *
     * @return Taxref
     */
    public function setWfStatut($wfStatut)
    {
        $this->wf_statut = $wfStatut;

        return $this;
    }

    /**
     * Get wfStatut
     *
     * @return string
     */
    public function getWfStatut()
    {
        return $this->wf_statut;
    }

    /**
     * Set pfStatut
     *
     * @param string $pfStatut
     *
     * @return Taxref
     */
    public function setPfStatut($pfStatut)
    {
        $this->pf_statut = $pfStatut;

        return $this;
    }

    /**
     * Get pfStatut
     *
     * @return string
     */
    public function getPfStatut()
    {
        return $this->pf_statut;
    }

    /**
     * Set cliStatut
     *
     * @param string $cliStatut
     *
     * @return Taxref
     */
    public function setCliStatut($cliStatut)
    {
        $this->cli_statut = $cliStatut;

        return $this;
    }

    /**
     * Get cliStatut
     *
     * @return string
     */
    public function getCliStatut()
    {
        return $this->cli_statut;
    }
}
