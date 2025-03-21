<?php
// Dit is het hart van de Symfony applicatie

namespace App;

// We importeren de benodigde Symfony onderdelen
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

// Deze class start de applicatie op en regelt de basis werking
class Kernel extends BaseKernel
{
    use MicroKernelTrait;
}
