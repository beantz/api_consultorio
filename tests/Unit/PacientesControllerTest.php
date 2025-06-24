<?php

namespace tests\Unit\PacientesControllerTest;

use App\Http\Controllers\PacientesController;
use App\Services\PacientesService;
use PHPUnit\Framework\TestCase;

class PacientesControllerTest extends TestCase {

    private $pacientesController;
    private $pacientesServiceMock;

    //metodo responsavel por configurar os mocks e instanciar o controller
    protected function setUp(): void {

        //criar mock de service
        $this->pacientesServiceMock = $this->createMock(PacientesService::class);

        //criar controller recebendo service
        $this->pacientesController = new PacientesController($this->pacientesServiceMock);

    }

    public function testReturnAllPatients() {

        //preparar dados de teste
        $expectedPatients = [
            ['id' => 1, 'nome' => 'joao', 'idade' => '22', 'email' => 'joao123@gmail.com',
            'telefone' => '12345678', 'alergias' => 'nao possuo', 'usando_medicamentos' => 'remedio_1', 'senha' => '123123'],
            ['id' => 2, 'nome' => 'beatriz', 'idade' => 22, 'email' => 'beatriz123@gmail.com', 
            'telefone' => '12345678', 'alergias' => 'nao possuo', 'usando_medicamentos' => 'remedio_2', 'senha' => '123123']
        ];

        //configurar mock
        $this->pacientesServiceMock
            ->expects($this->once()) //garante q o metodo é chamado uma vez
            ->method('getAll')
            ->willReturn($expectedPatients); //retorno esperado

        //executar o metodo no controller
        $result = $this->pacientesController->index();

        //verificar se são iguais
        $this->assertEquals(($expectedPatients), $result);

        //se por acaso for uma resposta json
        if ($result instanceof \Illuminate\Http\JsonResponse) {
            $responseData = $result->getData(true);
            $this->assertEquals($expectedPatients, $responseData);
        }

    }

}