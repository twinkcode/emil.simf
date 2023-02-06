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



//
//    /**
//     * @param Product $product
//     * @return CalculatePriceDTO
//     */
//    public function setProduct(Product $product): self
//    {
//        $this->product = $product;
//
//        return $this;
//    }


}
//class CalculatePriceDTO
//{
//    /**
//     * @var Product
//     */
//    private Product $product;
//
//    /**
//     * @var Country
//     */
//    private Country $country;
//
//    /**
//     * @var $taxNumber
//     */
//    private string $taxNumber;
//
//    /**
//     * @return string $taxNumber
//     */
//    public function getTaxNumber(): string
//    {
//        return $this->taxNumber;
//    }
//
//    /**
//     * @param $taxNumber
//     * @return CalculatePriceDTO
//     */
//    public function setTaxNumber($taxNumber): self
//    {
//        $this->taxNumber = $taxNumber;
//        return $this;
//    }
//
//    /**
//     * @return Product
//     */
//    public function getProduct(): Product
//    {
//        return $this->product;
//    }
//
//    /**
//     * @param Product $product
//     * @return CalculatePriceDTO
//     */
//    public function setProduct(Product $product): self
//    {
//        $this->product = $product;
//
//        return $this;
//    }
//
//    /**
//     * @return Country
//     */
//    public function getCountry(): Country
//    {
//        return $this->country;
//    }
//
//    /**
//     * @param Country $country
//     * @return CalculatePriceDTO
//     */
//    public function setCountry(Country $country): self
//    {
//        $this->country = $country;
//
//        return $this;
//    }
//
//
//}
