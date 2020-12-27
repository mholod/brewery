<?php


namespace App\Dto\Transformer;


use App\Dto\Exception\UnexpectedTypeException;
use App\Dto\Response\CustomerResponseDto;
use App\Entity\Customer;

class CustomerResponseDtoTransformer extends AbstractResponseDtoTransformer
{
    /**
     * @param $customer
     * @return CustomerResponseDto
     */
    public function transformFromObject($customer): CustomerResponseDto
    {
        if (!$customer instanceof Customer) {
            throw new UnexpectedTypeException('Expected type of Customer but got ' . \get_class($customer));
        }

        $dto = new CustomerResponseDto();
        $dto->name = $customer->getName();
        $dto->email = $customer->getEmail();
        $dto->phone = $customer->getPhone();

        return $dto;
    }
}