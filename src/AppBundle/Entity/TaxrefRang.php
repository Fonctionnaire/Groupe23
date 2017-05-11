<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * TaxrefRang
 *
 * @ORM\Table(name="Taxref_rang")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TaxrefRangRepository")
 */
class TaxrefRang
{
    /**
     * @var string
     * @ORM\Id
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Taxref", mappedBy="rang")
     * @ORM\Column(name="rang")
     */
    private $rang;

    /**
     * @var string
     *
     * @ORM\Column(name="detail", type="string", length=255)
     */
    private $detail;


    /**
     * Set Rang
     *
     * @param string $rang
     *
     * @return TaxrefRang
     */
    public function setRang($rang)
    {
        $this->rang = $rang;

        return $this;
    }

    /**
     * Get Rangs
     *
     * @return string
     */
    public function getRang()
    {
        return $this->rang;
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
