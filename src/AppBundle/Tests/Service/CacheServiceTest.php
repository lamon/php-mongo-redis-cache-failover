<?php

namespace AppBundle\Tests\Service;

use AppBundle\Service\CacheService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CacheServiceTest extends WebTestCase
{
    protected $client;

    public function setUp()
    {

    }

    public function testIsOnline()
    {
        // TODO

        // Augusto, como eu nunca usei o Symfony, eu não consegui fazer o CacheService funcionar aqui para testá-lo
        // peço desculpas
        // vou tentar descrever como eu faria para testar o método isOnline() do CacheService
        // segue:

        // usaria o serviço real, o CacheService, não faria o mock, assim se o redis realmente tiver caído,
        // o metodo isOnline() retornaria false

        // OUTRA maneira:
        // faria o mock do CacheService
        // faria o mock do metodo isOnline() retornando true
        // faria um assertTrue(isOnline())

    }

}
