<?php
namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="contacts")
 */
class Contact
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected $firstName;
    
    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected $lastName;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $address;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $city;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $country;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $email;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $phoneNumber;
    
    
    
    /**
     * @param $firstname
     * @param $lastname
     */
    public function __construct($firstName, $lastName, $address, $city, $country, $email, $phoneNumber)
    {
        $this->firstName = $firstName;
        $this->lastName  = $lastName;
        $this->address = $address;
        $this->city = $city;
        $this->country = $country;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getFirstName()
    {
        return $this->firstName;
    }
    
    public function getLastName()
    {
        return $this->lastName;
    }
    public function getAddress()
    {
        return $this->address;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }
    
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'firstName' => $this->getFirstName(),
            'lastName' => $this->getLastName(),
            'address' => $this->getAddress(),
            'city' => $this->getCity(),
            'city' => $this->getCity(),
            'country' => $this->getCountry(),
            'email' => $this->getEmail(),
            'phoneNumber' => $this->getPhoneNumber(),
        ];
        
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }
   
    
    public function update( 
        ?string $firstName, 
        ?string $lastName, 
        ?string $address, 
        ?string $city, 
        ?string $country, 
        ?string $email, 
        ?string $phoneNumber
    ) {       
        $firstName !== null ? $this->setFirstName($firstName) : null;
        $lastName !== null ? $this->setLastName($lastName) : null;
        $address !== null ? $this->setAddress($address) : null;
        $city !== null ? $this->setCity($city) : null;
        $email !== null ? $this->setEmail($email) : null;
        $phoneNumber !== null ? $this->setPhoneNumber($phoneNumber) : null;
        
        return $this;
    }
    
    
}