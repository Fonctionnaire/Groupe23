<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TaxrefProtege
 *
 * @ORM\Table(name="taxref_protege")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TaxrefProtegeRepository")
 */
class TaxrefProtege
{
    /**
     * @var string
     *
     * @ORM\Column(name="nomTexte", type="string", length=255, options={"comment":"Nom cité dans le texte"})
     */
    private $nomTexte;

    /**
     * @var string
     *
     * @ORM\Column(name="nomTexteFr", type="string", length=255, options={"comment":"Nom français cité dans le texte"})
     */
    private $nomTexteFr;

    /**
     * @var string
     *
     * @ORM\Column(name="nomValide", type="string", length=255, options={"comment":"Nom valide"})
     */
    private $nomValide;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule", type="string", length=255)
     */
    private $intitule;

    /**
     * @var string
     *
     * @ORM\Column(name="arrete", type="string", length=255)
     */
    private $arrete;

    /**
     * @var string
     *
     * @ORM\Column(name="article", type="string", length=255)
     */
    private $article;

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(name="cdnom")
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Taxref", mappedBy="cdnom")
     */
    private $cdnom;


    /**
     * Set nomTexte
     *
     * @param string $nomTexte
     *
     * @return TaxrefProtege
     */
    public function setNomTexte($nomTexte)
    {
        $this->nomTexte = $nomTexte;

        return $this;
    }

    /**
     * Get nomTexte
     *
     * @return string
     */
    public function getNomTexte()
    {
        return $this->nomTexte;
    }

    /**
     * Set nomTexteFr
     *
     * @param string $nomTexteFr
     *
     * @return TaxrefProtege
     */
    public function setNomTexteFr($nomTexteFr)
    {
        $this->nomTexteFr = $nomTexteFr;

        return $this;
    }

    /**
     * Get nomTexteFr
     *
     * @return string
     */
    public function getNomTexteFr()
    {
        return $this->nomTexteFr;
    }

    /**
     * Set nomValide
     *
     * @param string $nomValide
     *
     * @return TaxrefProtege
     */
    public function setNomValide($nomValide)
    {
        $this->nomValide = $nomValide;

        return $this;
    }

    /**
     * Get nomValide
     *
     * @return string
     */
    public function getNomValide()
    {
        return $this->nomValide;
    }

    /**
     * Set intitule
     *
     * @param string $intitule
     *
     * @return TaxrefProtege
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * Get intitule
     *
     * @return string
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Set arrete
     *
     * @param string $arrete
     *
     * @return TaxrefProtege
     */
    public function setArrete($arrete)
    {
        $this->arrete = $arrete;

        return $this;
    }

    /**
     * Get arrete
     *
     * @return string
     */
    public function getArrete()
    {
        return $this->arrete;
    }

    /**
     * Set article
     *
     * @param string $article
     *
     * @return TaxrefProtege
     */
    public function setArticle($article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return string
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set cdnom
     *
     * @param integer $cdnom
     *
     * @return TaxrefProtege
     */
    public function setCdnom($cdnom)
    {
        $this->cdnom = $cdnom;

        return $this;
    }

    /**
     * Get cdnom
     *
     * @return int
     */
    public function getCdnom()
    {
        return $this->cdnom;
    }
}

