<?php

namespace WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_start", type="date")
     */
    private $dateStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_end", type="date", nullable=true)
     */
    private $dateEnd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time_start", type="time", nullable=true)
     */
    private $timeStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time_end", type="time", nullable=true)
     */
    private $timeEnd;

    /**
     * @var string
     *
     * @ORM\Column(name="date_complement", type="string", length=255, nullable=true)
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
     */
    private $isAtWork;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="phoneNumber", type="string", length=255, nullable=true)
     */
    private $phoneNumber;

    /**
     * @var int
     *
     * @ORM\Column(name="tariff", type="integer", nullable=true)
     */
    private $tariff;
    
    /**
     * @ORM\ManyToOne(targetEntity="WebsiteBundle\Entity\Image", cascade={"persist"})
     */
    private $image;
    
    /**
     * @ORM\ManyToOne(targetEntity="WebsiteBundle\Entity\Address", cascade={"persist"})
     */
    private $address;
    
    
    
    public function __construct() 
    {
        $this->dateStart = new \Datetime();
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
}
