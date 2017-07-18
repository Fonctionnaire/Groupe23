<?php

namespace UserBundle\Entity;


use AppBundle\Entity\Observation;
use AppBundle\Entity\Comment;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Context\ExecutionContextInterface;


/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 * @Vich\Uploadable
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
     *     max=40,
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
     *     max=40,
     *     minMessage="Le nom doit comporter plus de 2 caractères.",
     *     maxMessage="Nom trop long.",
     * )
     */
    protected $lastName;

    /**
     * @Assert\Regex(
     *  pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,16}$/",
     *  message="Le mot de passe doit contenir entre 8 et 16 caractères alphanumériques dont une majuscule, une minuscule et un chiffre."
     * )
     */
    protected $plainPassword;


    /**
     * @var string
     * @Assert\NotBlank(message="Veuillez préciser votre code postal.")
     * @Assert\Length(max="5", min="5", minMessage="Code postal invalide", maxMessage="Code postal invalide")
     * @Assert\Regex("/[0-9]{2}[0-9]{3}/", message="Code postal à 5 chiffres, sans espace.")
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
     *     max=40,
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


    /**
     * @var string
     *
     * @ORM\Column(nullable=true, name="phone", type="string")
     * @Assert\Length(
     *     min=12,
     *     max=12,
     *     exactMessage="Un numéro de téléphone doit comporter exactement 10 caractères",
     * )
     * @Assert\Regex(
     *     pattern="/^(\+33)[1234567]\d{8}/",
     *     match=true,
     *     message="Ce numéro de téléphone n'est pas valide",
     *
     * )
     *
     */
    protected $phone;


    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="avatar_image", fileNameProperty="avatarName", size="avatarSize")
     * @Assert\Image(
     *     minRatio="0.75",
     *     maxSize="512k"
     * )
     *
     * @var File
     */
    private $avatarFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $avatarName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var integer
     */
    private $avatarSize;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt;




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

        return $this;
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


    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return User
     */
    public function setPhone($phone)
    {
        $remplace = '+33';
        $this->phone = substr_replace($phone, $remplace, 0, 1);
        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }


    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $avatar
     *
     * @return User
     */
    public function setAvatarFile(File $avatar = null)
    {
        $this->avatarFile = $avatar;

        if ($avatar) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }

    /**
     * @return File|null
     */
    public function getAvatarFile()
    {
        return $this->avatarFile;
    }

    /**
     * @param string $avatarName
     *
     * @return User
     */
    public function setAvatarName($avatarName)
    {
        $this->avatarName = $avatarName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAvatarName()
    {
        return $this->avatarName;
    }

    /**
     * @param integer $avatarSize
     *
     * @return User
     */
    public function setAvatarSize($avatarSize)
    {
        $this->avatarSize = $avatarSize;

        return $this;
    }

    /**
     * @return integer|null
     */
    public function getAvatarSize()
    {
        return $this->avatarSize;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return User
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }


}
