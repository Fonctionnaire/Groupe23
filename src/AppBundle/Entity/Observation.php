<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Observation
 *
 * @ORM\Table(name="observation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ObservationRepository")
 */
class Observation
{


    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="observations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Taxref", inversedBy="observations")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="CD_NOM")
     * @Assert\NotBlank(message = "Veuillez renseigner l'espèce")
     *
     */
    private $taxref;


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateObservation", type="datetime")
     * @Assert\DateTime()
     * @Assert\NotBlank(message = "Veuillez indiquer la date de votre observation")
     */
    private $dateObservation;



    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", nullable=true)
     * @Assert\Length(max=255, maxMessage="Votre commentaire ne peut dépasser {{ limit }} caractères.")
     */
    private $comment;

    /**
     * @var string
     *
     * @ORM\Column(name="adminComment", type="text", nullable=true)
     * @Assert\Length(max=255, maxMessage="Votre commentaire ne peut dépasser {{ limit }} caractères.")
     */
    private $adminComment;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     * @Assert\Valid()
     * @Assert\File(
     *     maxSize = "2M",
     *     maxSizeMessage = "  La taille de votre fichier ({{ size }} M) dépasse la taille maximale autorisée (2M).",
     *     mimeTypes = {"image/jpeg", "image/png","image/jpg", "image/gif"},
     *     mimeTypesMessage = "Seules les extensions .jpeg .png .jpg et .gif sont autorisées"
     *     )
     */
    private $image;

    /**
     * @var bool
     *
     * @ORM\Column(name="valided", type="boolean", nullable=true)
     */
    private $valided;

    /**
     * @var bool
     *
     * @ORM\Column(name="waiting", type="boolean")
     */
    private $waiting=true;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_visible", type="boolean", nullable=true)
     */
    private $isVisible;


    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float")
     * @Assert\NotBlank(message = "Veuillez renseigner ce champ")
     * @Assert\Type(type="float", message="coordonnee invalide")
     */
    private $longitude;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float")
     * @Assert\NotBlank(message = "Veuillez renseigner ce champ")
     * @Assert\Type(type="float", message="coordonnee invalide")
     * )
     */
    private $latitude;




    public function __construct()
    {
        $this->date = new \Datetime();
    }

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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Observation
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set dateObservation
     *
     * @param \DateTime $dateObservation
     *
     * @return Observation
     */
    public function setDateObservation($dateObservation)
    {
        $this->dateObservation = $dateObservation;

        return $this;
    }

    /**
     * Get dateObservation
     *
     * @return \DateTime
     */
    public function getDateObservation()
    {
        return $this->dateObservation;
    }



    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Observation
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Observation
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set valided
     *
     * @param boolean $valided
     *
     * @return Observation
     */
    public function setValided($valided)
    {
        $this->valided = $valided;

        return $this;
    }

    /**
     * Get valided
     *
     * @return bool
     */
    public function getValided()
    {
        return $this->valided;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     *
     * @return Observation
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     *
     * @return Observation
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Observation
     */
    public function setUser(\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set taxref
     *
     * @param \AppBundle\Entity\Taxref $taxref
     *
     * @return Observation
     */
    public function setTaxref(\AppBundle\Entity\Taxref $taxref)
    {
        $this->taxref = $taxref;

        return $this;
    }

    /**
     * Get taxref
     *
     * @return \AppBundle\Entity\Taxref
     */
    public function getTaxref()
    {
        return $this->taxref;
    }



    /**
     * Set waiting
     *
     * @param boolean $waiting
     *
     * @return Observation
     */
    public function setWaiting($waiting)
    {
        $this->waiting = $waiting;

        return $this;
    }

    /**
     * Get waiting
     *
     * @return boolean
     */
    public function getWaiting()
    {
        return $this->waiting;
    }

    /**
     * Set adminComment
     *
     * @param string $adminComment
     *
     * @return Observation
     */
    public function setAdminComment($adminComment)
    {
        $this->adminComment = $adminComment;

        return $this;
    }

    /**
     * Get adminComment
     *
     * @return string
     */
    public function getAdminComment()
    {
        return $this->adminComment;
    }

    /**
     * Set isVisible
     *
     * @param boolean $isVisible
     *
     * @return Observation
     */
    public function setIsVisible($isVisible)
    {
        $this->isVisible = $isVisible;

        return $this;
    }

    /**
     * Get isVisible
     *
     * @return boolean
     */
    public function getIsVisible()
    {
        return $this->isVisible;
    }
}
