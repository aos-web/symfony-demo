<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommandRepository;

/**
 * Objet représentant une commande Client
 */
#[ORM\Entity(repositoryClass: CommandRepository::class)]
#[ORM\Table(name: "command")]
class Command
{
    #[ORM\OneToOne(targetEntity:"App\Entity\Cart")]
    #[ORM\JoinColumn(name:"cart_id", referencedColumnName:"id")]
    private $cart;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:'integer')]
    public $id;
}
