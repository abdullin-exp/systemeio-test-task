<?php

declare(strict_types=1);

namespace App\Entity\Tools;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Id\AbstractIdGenerator;
use Symfony\Component\Uid\Uuid;

class UuidV7Generator extends AbstractIdGenerator
{

    public function generateId(EntityManagerInterface $em, ?object $entity): mixed
    {
        return $entity?->id !== null ? $entity->id : Uuid::v7();
    }
}