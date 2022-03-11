<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Objet représentant un panier d'achats.
 */
#[ORM\Entity(repositoryClass: CartRepository::class)]
#[ORM\Table(name: "cart")]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:'integer')]
    public $id;

    /**
     * Les produits sont liés à un panier
     */
    #[ORM\ManyToMany(targetEntity:"App\Entity\Product", mappedBy:"carts")]
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }
}
