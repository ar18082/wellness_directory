<?php
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class Base64Extension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('base64_encode', [$this, 'base64Encode']),
        ];
    }

    public function base64Encode($string)
    {
        return base64_encode($string);
    }
}