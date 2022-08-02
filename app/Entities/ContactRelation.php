<?php
namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="contacts_relation")
 */
class ContactRelation
{   
    
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Contact::class, inversedBy="relativeContacts")
     * @ORM\JoinColumn(name="contact_id", referencedColumnName="id")
     */
    private $contact;
    
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Contact::class)
     * @ORM\JoinColumn(name="relative_id", referencedColumnName="id")
     */
    private $relative;    
    
    /**
     *  @ORM\Embedded(class="RelationType", columnPrefix = "rel_type_")
     */
    private $relationType;
    
    
    public function __construct(Contact $contact, Contact $relative, RelationType $relationType)
    {
        $this->contact = $contact;
        $this->relative = $relative;
        $this->relationType = $relationType;
    }
    
    /**
     * 
     * @return \App\Entities\Contact
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * 
     * @return \App\Entities\Contact
     */
    public function getRelative()
    {
        return $this->relative;
    }

    public function setContact($contact)
    {
        $this->contact = $contact;
    }

    public function setRelative($relative)
    {
        $this->relative = $relative;
    }
    
    /**
     * 
     * @return \App\Entities\RelationType
     */
    public function getRelationType()
    {
        return $this->relationType;
    }

    public function setRelationType($relationType)
    {
        $this->relationType = $relationType;
    }

    
}