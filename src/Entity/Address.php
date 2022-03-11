<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Objet qui définit une adresse
 */
#[ORM\Entity(repositoryClass: AddressRepository::class)]
#[ORM\Table(name: "address")]
class Address
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:'integer')]
    public $id;

    /**
     * Les adresses sont liées à un client
     */
    #[ORM\ManyToOne(targetEntity:"App\Entity\Customer", inversedBy:"adresses")]
    #[ORM\JoinColumn(name:"customer_id", referencedColumnName:"id")]
    private $customer;
}
