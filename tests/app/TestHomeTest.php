<?php
namespace app;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;
use Config\App;
use Config\Services;
use Tests\Support\Libraries\ConfigReader;
use App\Entities\Planos;

/**
 *
 * @internal
 */
final class TestHomeTest extends CIUnitTestCase
{
    use ControllerTestTrait;

    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /* testa se o controlador esta respondendo corretamente */
    public function testIndex(): void
    {
        $result = $this->withURI('http://localhost:8080/')
            ->controller(\App\Controllers\Home::class)
            ->execute('index');

        $this->assertTrue($result->isOK());
    }

    public function testTipoRespostaPlanos(): void
    {
        $result = $this->withURI('http://localhost:8080/planos/getPlanos/?id=1')
            ->controller(\App\Controllers\Planos::class)
            ->execute('getPlanos');

        $this->assertTrue($result->getJSON() !== true);
    }

    public function testCodigoHttpRespostaPlanos(): void
    {
        $result = $this->withURI('http://localhost:8080/planos/getPlanos/?id=1')
            ->controller(\App\Controllers\Planos::class)
            ->execute('getPlanos');

        $result->assertStatus(200);
    }

}