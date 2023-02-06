<?php

namespace App\DTO;

use App\Entity\Country;
use App\Entity\Product;
use Symfony\Component\Validator\Constraints as Assert;

class CalculatePriceDTO
{
    /**
     * @var Product
     * @Assert\NotBlank()
     */
    public Product $product;

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @Assert\NotBlank()
     */
    public string $taxNumber;

}
