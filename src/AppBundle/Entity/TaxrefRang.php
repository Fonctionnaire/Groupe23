<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * TaxrefRang
 *
 * @ORM\Table(name="taxref_rang")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TaxrefRangRepository")
 */
class TaxrefRang
{
    /**
     * @var ArrayCollection Taxref
     * @ORM\Id()
     * @ORM\OneToMany(targetEntity="Taxref", mappedBy="rang", cascade={"persist"})
     * @ORM\Column(name="rang")
     */
    private $taxrefs;

    /**
     * @var string
     *
     * @ORM\Column(name="detail", type="string", length=255)
     */
    private $detail;


    /**
     * Set taxrefs
     *
     * @param string $taxrefs
     *
     * @return TaxrefRang
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
     * Set detail
     *
     * @param string $detail
     *
     * @return TaxrefRang
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;

        return $this;
    }

    /**
     * Get detail
     *
     * @return string
     */
    public function getDetail()
    {
        return $this->detail;
    }
}
