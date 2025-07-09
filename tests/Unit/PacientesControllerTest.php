<?php

namespace tests\Unit\PacientesControllerTest;

use App\Http\Controllers\PacientesController;
use App\Http\Requests\ValidationUsersStore;
use App\Repositories\PacientesRepositorie;
use App\Services\PacientesService;
use Exception;
use Mockery;
use PHPUnit\Framework\TestCase;

class PacientesControllerTest extends TestCase {

    private $pacientesController;
    private $pacientesServiceMock;
    private $requestMock;
    private $pacientesRepositoriesMock;

    //metodo responsavel por configurar os mocks e instanciar o controller
    protected function setUp(): void {

        parent::setUp();

        //criar mock de service
        $this->pacientesServiceMock = $this->createMock(PacientesService::class);

        //criar controller recebendo service
        $this->pacientesController = new PacientesController($this->pacientesServiceMock);

        $this->pacientesRepositoriesMock = $this->createMock(PacientesRepositorie::class);

        $this->requestMock = $this->createMock(ValidationUsersStore::class);

    }

    public function testReturnAllPatients() {

        //preparar dados de teste
        $expectedPatients = [
            ['id' => 1, 'nome' => 'joao', 'idade' => 22, 'email' => 'joao123@gmail.com',
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

    public function testRegisterPatientSuccess() {

        $inputData = ['nome' => 'joao', 'idade' => 22, 'email' => 'joao123@gmail.com',
            'telefone' => '12345678', 'alergias' => 'nao possuo', 'usando_medicamentos' => 'remedio_1', 'senha' => '123123'];
        $expectedPatient = ['id' => 1, 'nome' => 'joao', 'idade' => 22, 'email' => 'joao123@gmail.com',
            'telefone' => '12345678', 'alergias' => 'nao possuo', 'usando_medicamentos' => 'remedio_1', 'senha' => '123123'];
        
        $this->requestMock->expects($this->any())
            ->method('all')
            ->willReturn($inputData);

        $this->pacientesServiceMock
            ->expects($this->once())
            ->method('registerPatients')
            ->with($this->requestMock)
            ->willReturn($expectedPatient);
        
        $response = $this->pacientesController->store($this->requestMock);
        
        if ($response instanceof \Illuminate\Http\JsonResponse) {
            /*converte o conteúdo JSON da resposta em um array associativo PHP, parametro 'true' faz com que retorne um array e nao um obj*/
            $responseData = $response->getData(true);
            $this->assertEquals($expectedPatient, $responseData);
        } 
        //se retornar array diretamente
        else {
            $this->assertEquals($expectedPatient, $response);
        }
    }
    
    public function testRegisterPatientFailure()
    {
        $inputData = ['nome' => 'joao', 'idade' => 22, 'email' => 'joao123@gmail.com',
            'telefone' => '12345678', 'alergias' => 'nao possuo', 'usando_medicamentos' => 'remedio_1', 'senha' => '123123'];
        
        $this->requestMock->expects($this->any())
            ->method('all')
            ->willReturn($inputData);

        $this->pacientesServiceMock
            ->expects($this->once())
            ->method('registerPatients')
            ->with($this->requestMock)
            ->willReturn([
                'status' => 500,
                'message' => 'Falha ao cadastrar paciente',
                'error' => 'Erro no banco de dados'
        ]);
        
        $response = $this->pacientesController->store($this->requestMock);
        
        $this->assertEquals(500, $response['status']);
        $this->assertEquals('Falha ao cadastrar paciente', $response['message']);

    }

    public function testFindPatientSuccesss() {

        $expectedPatient = [
            ['id' => '1', 'nome' => 'joao', 'idade' => 22, 'email' => 'joao123@gmail.com',
            'telefone' => '12345678', 'alergias' => 'nao possuo', 'usando_medicamentos' => 'remedio_1', 'senha' => '123123']
        ];

        $this->pacientesServiceMock
            ->expects($this->once())
            ->method('findPatient')
            ->with('id')
            ->willReturn($expectedPatient);

        $result = $this->pacientesController->show('id');

        $this->assertEquals(($expectedPatient), $result);

        if ($result instanceof \Illuminate\Http\JsonResponse) {
            $responseData = $result->getData(true);
            $this->assertEquals($expectedPatient, $responseData);
        }

    }

    public function testFindPatientFailure() {

        $expectedPatient = [
            ['id' => '1', 'nome' => 'joao', 'idade' => 22, 'email' => 'joao123@gmail.com',
            'telefone' => '12345678', 'alergias' => 'nao possuo', 'usando_medicamentos' => 'remedio_1', 'senha' => '123123']
        ];

        $this->pacientesServiceMock
            ->expects($this->once())
            ->method('findPatient')
            ->with('id')
            ->willReturn([
                'status' => 404,
                'message' => 'Paciente não encontrado',
                'error' => 'Erro no banco de dados'
        ]);

        $response = $this->pacientesController->show('id');

        $this->assertEquals(404, $response['status']);
        $this->assertEquals('Paciente não encontrado', $response['message']);

    }
}