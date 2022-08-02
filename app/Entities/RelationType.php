<?php
namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Embeddable
 */
class RelationType
{

    const RELATIVE_PARENT   = 'parent';
    const RELATIVE_SIBLING  = 'sibling';
    const RELATIVE_SPOUSE   = 'spouse';
    const RELATIVE_OTHER    = 'relative';
    
    /**
     * @ORM\Column(type="string", length="50")
     * @var string
     */
    private $description;
    
    private function __construct( string $description )
    {
        $this->description = $description;
    }
    
    public static function fromDescription( string $description ) {
        if (!in_array($description, self::getPossibleRelations())) {
            throw new \Exception( sprintf('`%1$s` is not a valid relation type!', $description) );
        }
        
        return new self( $description );
    }

    // *************************************************************************************************
    
    public static function parent() {
        return new self(self::RELATIVE_PARENT);
    }
    
    public static function sibling() {
        
        return new self(self::RELATIVE_SIBLING);
    }
    
    public static function spouse() {
        return new self(self::RELATIVE_SPOUSE);
    }
    
    public static function other() {
        return new self(self::RELATIVE_OTHER);
    }
    
    
    public static function getRandom() {
        return new self( self::getPossibleRelations() [array_rand(self::getPossibleRelations(), 1) ] );
    }
    
    // *************************************************************************************************
    
    public static function getPossibleRelations() {
        return [
            self::RELATIVE_PARENT,
            self::RELATIVE_SIBLING,
            self::RELATIVE_SPOUSE,
            self::RELATIVE_OTHER
        ];
    }
    
    /**
     * 
     * @return string
     */
    public function __toString() {
        return $this->description;
    }
    
}