<?php


namespace App\Dto\Transformer;


use App\Dto\Response\CustomerResponseDto;

class CustomerResponseDtoTransformer
{
    public function transformFromObject($customer): CustomerResponseDto
    {
        $dto = new CustomerResponseDto();
        $dto->name = $customer->getName();
        $dto->email = $customer->getEmail();
        $dto->phone = $customer->getPhone();

        return $dto;
    }

    public function transformFromObjects($customers): iterable
    {
        $dto = [];
        foreach ($customers as $customer) {
            $dto[] = $this->transformFromObject($customer);
        }

        return $dto;
    }
}