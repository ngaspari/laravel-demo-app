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
     * @ORM\OneToMany(targetEntity=ContactRelation::class, mappedBy="contact", fetch="EXTRA_LAZY", cascade={"all"})
     * @var ArrayCollection|ContactRelation[]
     */
    private $relativeContacts;
    
    /**
     * @ORM\OneToMany(targetEntity=ContactRelation::class, mappedBy="relative", fetch="EXTRA_LAZY", cascade={"all"})
     * @var ArrayCollection|ContactRelation[]
     */
    private $relativeTo;
    
    
    
    public function __construct($firstName, $lastName, $address, $city, $country, $email, $phoneNumber)
    {
        $this->firstName = $firstName;
        $this->lastName  = $lastName;
        $this->address = $address;
        $this->city = $city;
        $this->country = $country;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        
        $this->relativeContacts = new ArrayCollection();
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
            'firstName'     => $this->getFirstName(),
            'lastName'      => $this->getLastName(),
            'address'       => $this->getAddress(),
            'city'          => $this->getCity(),
            'city'          => $this->getCity(),
            'country'       => $this->getCountry(),
            'email'         => $this->getEmail(),
            'phoneNumber'   => $this->getPhoneNumber(),
            'relativesList' => $this->getRelativesList(),
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
    
    /**
     * 
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getRelatives() {
        return $this->relativeContacts;
    }
    
    /**
     * 
     * @return boolean
     */
    public function hasRelatives() {
        return !$this->getRelatives()->isEmpty();
    }
    
    /**
     * 
     * @param Contact $relative
     * @return boolean
     */
    private function isAlreadyRelative(Contact $relative) {
        if ($this->hasRelatives()) {
            /** @var ContactRelation $existingRelative */
            foreach ($this->getRelatives() as $existingRelative) {
                if ($existingRelative->getRelative()->getId() == $relative->getId()) {
                    return true;
                }
            }
        }
        
        return false;   // not a relative
    }
    
    /**
     * 
     * @param Contact $relative
     * @param string $relationType
     */
    public function addRelative(Contact $relative, string $relationType) {
        if (!$this->isAlreadyRelative($relative)) {
            $this->getRelatives()->add(
                new ContactRelation($this, $relative, RelationType::fromDescription($relationType))
            );
        }
    }
    
    
    /**
     * 
     * @return array
     */
    public function getRelativesList() {
        $relativesArray = [];
        if ($this->hasRelatives()) {
            
            /** @var ContactRelation $existingRelative */
            foreach ($this->getRelatives() as $existingRelative) {
                $relativesArray[ (string)$existingRelative->getRelationType() ][] = [
                    'id'        => $existingRelative->getRelative()->getId(),
                    'firstName' => $existingRelative->getRelative()->getFirstName(),
                    'lastName'  => $existingRelative->getRelative()->getLastName(),
                ];
            }
        }
        
        return $relativesArray;
    }
    
}