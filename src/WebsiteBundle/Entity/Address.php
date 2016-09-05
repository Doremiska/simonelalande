<?php

namespace WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Address
 *
 * @ORM\Table(name="address")
 * @ORM\Entity(repositoryClass="WebsiteBundle\Repository\addressRepository")
 */
class Address
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
     * @ORM\Column(name="address", type="string", length=255)
     * @Assert\Length(max=255, maxMessage="L'adresse ne peut pas avoir plus de {{ limit }} caractères.")
     * @Assert\NotBlank(message="Ce champ est requis.")
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="postalCode", type="string", length=5)
     * @Assert\Length(
            max=5,
            min=5,
            exactMessage="Le code postal doit avoir {{ limit }} chiffres."
        )
     * @Assert\NotBlank(message="Ce champ est requis.")
     */
    private $postalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     * @Assert\Length(max=255, maxMessage="La ville ne peut pas avoir plus de {{ limit }} caractères.")
     * @Assert\NotBlank(message="Ce champ est requis.")
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="addressComplement", type="string", length=255, nullable=true)
     * @Assert\Length(max=255, maxMessage="Le complément d'adresse ne peut pas avoir plus de {{ limit }} caractères.")
     */
    private $addressComplement;


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
     * Set address
     *
     * @param string $address
     *
     * @return address
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set postalCode
     *
     * @param string $postalCode
     *
     * @return address
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return address
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set addressComplement
     *
     * @param string $addressComplement
     *
     * @return address
     */
    public function setAddressComplement($addressComplement)
    {
        $this->addressComplement = $addressComplement;

        return $this;
    }

    /**
     * Get addressComplement
     *
     * @return string
     */
    public function getAddressComplement()
    {
        return $this->addressComplement;
    }
}

