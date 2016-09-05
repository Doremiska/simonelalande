<?php

namespace WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Advert
 *
 * @ORM\Table(name="advert")
 * @ORM\Entity(repositoryClass="WebsiteBundle\Repository\AdvertRepository")
 */
class Advert
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\Length(max=255, maxMessage="Le titre ne peut pas avoir plus de {{ limit }} caractères.")
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @var bool
     *
     * @ORM\Column(name="to_come_up", type="boolean")
     * @Assert\Type("bool", message="Le type de ce champ doit être un booléen.")
     */
    private $toComeUp;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_start", type="date")
     * @Assert\DateTime(message="La date n'est pas valide.")
     */
    private $dateStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_end", type="date", nullable=true)
     * @Assert\DateTime(message="La date n'est pas valide.")
     */
    private $dateEnd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time_start", type="time", nullable=true)
     * @Assert\Time(message="L'heure n'est pas valide.")
     */
    private $timeStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time_end", type="time", nullable=true)
     * @Assert\Time(message="L'heure n'est pas valide.")
     */
    private $timeEnd;

    /**
     * @var string
     *
     * @ORM\Column(name="date_complement", type="string", length=255, nullable=true)
     * @Assert\Length(max=255, maxMessage="Ce champ ne peut pas avoir plus de {{ limit }} caractères.")
     */
    private $dateComplement;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

    /**
     * @var bool
     *
     * @ORM\Column(name="isAtWork", type="boolean")
     * @Assert\Type("bool", message="Le type de ce champ doit être un booléen.")
     */
    private $isAtWork;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     * @Assert\Length(max=255, maxMessage="Le lien ne peut pas avoir plus de {{ limit }} caractères.")
     * @Assert\Url()
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="phoneNumber", type="string", length=21, nullable=true)
     * @Assert\Length(
            max=21,
            min=10,
            maxMessage="Le numéro de téléphone est trop long.",
            minMessage="Le numéro de téléphone doit avoir au moins {{ limit }} chiffres"
        )
     */
    private $phoneNumber;

    /**
     * @var int
     *
     * @ORM\Column(name="tariff", type="integer", nullable=true)
     * @Assert\Type("integer", message="Le type de ce champ doit être un entier.")
     */
    private $tariff;
    
    /**
     * @ORM\ManyToOne(targetEntity="WebsiteBundle\Entity\Image", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $image;
    
    /**
     * @ORM\ManyToOne(targetEntity="WebsiteBundle\Entity\Address", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $address;
    
    /**
     * @ORM\ManyToMany(targetEntity="WebsiteBundle\Entity\Category", cascade={"persist"})
     * @Assert\Valid()
     */
    private $categories;
    
    
    
    public function __construct() 
    {
        $this->dateStart = new \Datetime();
        $this->categories = new ArrayCollection();
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
     * Set title
     *
     * @param string $title
     *
     * @return Advert
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set dateStart
     *
     * @param \DateTime $dateStart
     *
     * @return Advert
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * Get dateStart
     *
     * @return \DateTime
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * Set dateEnd
     *
     * @param \DateTime $dateEnd
     *
     * @return Advert
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return \DateTime
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Set timeStart
     *
     * @param \DateTime $timeStart
     *
     * @return Advert
     */
    public function setTimeStart($timeStart)
    {
        $this->timeStart = $timeStart;

        return $this;
    }

    /**
     * Get timeStart
     *
     * @return \DateTime
     */
    public function getTimeStart()
    {
        return $this->timeStart;
    }

    /**
     * Set timeEnd
     *
     * @param \DateTime $timeEnd
     *
     * @return Advert
     */
    public function setTimeEnd($timeEnd)
    {
        $this->timeEnd = $timeEnd;

        return $this;
    }

    /**
     * Get timeEnd
     *
     * @return \DateTime
     */
    public function getTimeEnd()
    {
        return $this->timeEnd;
    }

    /**
     * Set dateComplement
     *
     * @param string $dateComplement
     *
     * @return Advert
     */
    public function setDateComplement($dateComplement)
    {
        $this->dateComplement = $dateComplement;

        return $this;
    }

    /**
     * Get dateComplement
     *
     * @return string
     */
    public function getDateComplement()
    {
        return $this->dateComplement;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Advert
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set isAtWork
     *
     * @param boolean $isAtWork
     *
     * @return Advert
     */
    public function setIsAtWork($isAtWork)
    {
        $this->isAtWork = $isAtWork;

        return $this;
    }

    /**
     * Get isAtWork
     *
     * @return bool
     */
    public function getIsAtWork()
    {
        return $this->isAtWork;
    }

    /**
     * Set link
     *
     * @param string $link
     *
     * @return Advert
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     *
     * @return Advert
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set tariff
     *
     * @param integer $tariff
     *
     * @return Advert
     */
    public function setTariff($tariff)
    {
        $this->tariff = $tariff;

        return $this;
    }

    /**
     * Get tariff
     *
     * @return int
     */
    public function getTariff()
    {
        return $this->tariff;
    }

    /**
     * Set image
     *
     * @param \WebsiteBundle\Entity\Image $image
     *
     * @return Advert
     */
    public function setImage(\WebsiteBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \WebsiteBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set address
     *
     * @param \WebsiteBundle\Entity\Address $address
     *
     * @return Advert
     */
    public function setAddress(\WebsiteBundle\Entity\Address $address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return \WebsiteBundle\Entity\Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set toComeUp
     *
     * @param boolean $toComeUp
     *
     * @return Advert
     */
    public function setToComeUp($toComeUp)
    {
        $this->toComeUp = $toComeUp;

        return $this;
    }

    /**
     * Get toComeUp
     *
     * @return boolean
     */
    public function getToComeUp()
    {
        return $this->toComeUp;
    }

    /**
     * Add category
     *
     * @param \WebsiteBundle\Entity\Category $category
     *
     * @return Advert
     */
    public function addCategory(\WebsiteBundle\Entity\Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \WebsiteBundle\Entity\Category $category
     */
    public function removeCategory(\WebsiteBundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }
}
