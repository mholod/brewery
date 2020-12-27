<?php


namespace App\Dto\Transformer;


abstract class AbstractResponseDtoTransformer implements ResponseDtoTransformerInterface
{
    public function transformFromObjects($objects): iterable
    {
        $dto = [];
        foreach ($objects as $object) {
            $dto[] = $this->transformFromObject($object);
        }

        return $dto;
    }
}