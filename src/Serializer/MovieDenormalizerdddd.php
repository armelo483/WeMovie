<?php

namespace App\Serializer;

use App\Entity\Movie;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ContextAwareDenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class MovieDenormalizerssss
{
    //use DenormalizerAwareTrait;
    use DenormalizerAwareTrait;
    use LoggerAwareTrait;
    public function __construct(protected $denormalizer){}

    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        $data = $this->removeEmptyDateTime($data, $type);

        return $this->denormalizer->denormalize($data, $type, $format, $context);
    }



    private function removeEmptyDateTime($data, $type)
    {
        if ($type == Movie::class && isset($data['release_date']) && $data['release_date'] === '') {
            unset($data['release_date']);
        }

        return $data;
    }

    public function supportsDenormalization($data, string $type, string $format = null, array $context = [])
    {
        //dd('tz',$type,  'App\Entity\Movie[]' === $type);
        return 'App\Entity\Movie[]' === $type;
    }

    public function setDenormalizer(DenormalizerInterface $denormalizer)
    {

    }

    public function setLogger(LoggerInterface $logger)
    {
        // TODO: Implement setLogger() method.
    }
}