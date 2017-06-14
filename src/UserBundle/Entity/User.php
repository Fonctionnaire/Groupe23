<?php

namespace UserBundle\Entity;


use AppBundle\Entity\Observation;
use AppBundle\Entity\Comment;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateRegister", type="datetime")
     */
    protected $dateRegister;



    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Observation", mappedBy="user")
     */
    private $observations;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Comment", mappedBy="author", cascade={"remove","persist"})
     */
    private $comments;


    /**
     * @ORM\Column(name="firstName", type="string", length=255)
     *
     * @Assert\NotBlank(message="Veuillez renseigner votre prénom.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=2,
     *     max=255,
     *     minMessage="Le prénom doit comporter plus de 2 caractères.",
     *     maxMessage="Prénom trop long.",
     * )
     */
    protected $firstName;

    /**
     * @ORM\Column(name="lastName", type="string", length=255)
     *
     * @Assert\NotBlank(message="Veuillez renseigner votre nom.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=2,
     *     max=255,
     *     minMessage="Le nom doit comporter plus de 2 caractères.",
     *     maxMessage="Nom trop long.",
     * )
     */
    protected $lastName;


    /**
     * @var string
     * @Assert\NotBlank(message="Veuillez préciser votre code postal.")
     * @Assert\Length(max="5", min="5", minMessage="Code postal invalide", maxMessage="Code postal invalide")
     * @Assert\Regex("/[0-9]{2}[0-9]{3}/", message="Veuillez ne pas mettre d'espace entre les chiffres.")
     *
     * @ORM\Column(name="codePostal", length=5)
     */
    protected $codePostal;

    /**
     * @ORM\Column(name="town", type="string", length=255)
     *
     * @Assert\NotBlank(message="Veuillez renseigner votre ville.")
     * @Assert\Length(
     *     min=2,
     *     max=255,
     *     minMessage="Le nom de la ville doit comporter plus de 2 caractères.",
     *     maxMessage="Ce nom est trop long.",
     * )
     */
    protected $town;

    /**
     * @var \DateTime
     *
     * @ORM\Column(nullable=true, name="birthDate", type="date")
     * @Assert\Date()
     */
    protected $birthDate;



    public function __construct()
    {
        parent::__construct();
        $this->dateRegister = new \Datetime();
        $this->observations = new ArrayCollection();
        $this->comments = new ArrayCollection();


    }


    /**
     * Add observation
     *
     * @param \AppBundle\Entity\Observation $observation
     *
     * @return User
     */
    public function addObservation(Observation $observation)
    {
        $this->observations[] = $observation;
        $observation->setUser($this);

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


    /**
     * Set dateRegister
     *
     * @param \DateTime $dateRegister
     *
     * @return User
     */
    public function setDateRegister($dateRegister)
    {
        $this->dateRegister = $dateRegister;
    }

    /**

     * Get dateRegister
     *
     * @return \DateTime
     */
    public function getDateRegister()
    {
        return $this->dateRegister;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set codePostal
     *
     * @param string $codePostal
     *
     * @return User
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return string
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set town
     *
     * @param string $town
     *
     * @return User
     */
    public function setTown($town)
    {
        $this->town = $town;

        return $this;
    }

    /**
     * Get town
     *
     * @return string
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Set birthDate
     *
     * @param \DateTime $birthDate
     *
     * @return User
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Add comment
     *
     * @param Comment $comment
     *
     * @return User
     */
    public function addComment(Comment $comment)
    {
        $this->comments[] = $comment;
        return $this;
    }

    /**
     * Remove comment
     *
     * @param Comment $comment
     */
    public function removeComment(Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;

    }

}

