<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Objet qui définit un client
 */
#[ORM\Entity(repositoryClass: CustomerRepository::class)]
#[ORM\Table(name: "customer")]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:'integer')]
    public $id;

    /**
     * Un client a potentiellement plusieurs adresses
     */
    #[ORM\OneToMany(targetEntity:"App\Entity\Address", mappedBy:"customer")]
    private $addresses;

    public function __construct()
    {
        $this->addresses = new ArrayCollection();
    }
}
