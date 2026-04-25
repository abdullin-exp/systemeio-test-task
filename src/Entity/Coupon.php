<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\CouponType;
use App\Repository\CouponRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CouponRepository::class)]
#[ORM\Table(name: 'coupons')]
class Coupon
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: 'integer')]
    public int $id;

    #[ORM\Column(name: 'code', type: 'string', length: 50)]
    public string $code;

    #[ORM\Column(name: 'type', length: 10, enumType: CouponType::class)]
    public CouponType $type;

    #[ORM\Column(name: 'discount', type: 'integer')]
    public int $discount;

}
