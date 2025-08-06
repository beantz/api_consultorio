<?php

namespace tests\Feature;

use App\Http\Controllers\PacientesController;
use App\Http\Requests\ValidationUsersStore;
use App\Services\PacientesService;
use Illuminate\Http\Request;
use Mockery;
use Tests\TestCase;

class PacientesControllerTest extends TestCase {

    private $pacientesController;
    private $pacientesServiceMock;
    private $requestMock;

    //metodo responsavel por configurar os mocks e instanciar o controller
    protected function setUp(): void {

        parent::setUp();

        //criar mock de service
        $this->pacientesServiceMock = Mockery::mock(PacientesService::class);

        //criar controller recebendo service
        $this->pacientesController = new PacientesController($this->pacientesServiceMock);

        $this->requestMock = Mockery::mock(ValidationUsersStore::class);

    }

    /*método para limpar os mocks*/
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
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
            ->shouldReceive('getAll')
            ->once() //garante q o metodo é chamado uma vez
            ->andReturn($expectedPatients); //retorno esperado

        //executar o metodo no controller
        $response = $this->pacientesController->index();

        //verifica se a resposta é um json
        $this->assertInstanceOf(\Illuminate\Http\JsonResponse::class, $response);

        $responseData = $response->getData(true);
        $this->assertEquals($expectedPatients, $responseData);

        $this->assertEquals(200, $response->getStatusCode());

    }

    public function testRegisterPatientSuccess() {

        $id = 1;

        $inputData = ['nome' => 'joao', 'idade' => 22, 'email' => 'joao123@gmail.com',
            'telefone' => '12345678', 'alergias' => 'nao possuo', 'usando_medicamentos' => 'remedio_1', 'senha' => '123123', 'status' => '201'];
        /* encaminhando 201 aqui pois como esse teste é feito para dar certo, eu preciso ter um dado de status nos response */

        $expectedPatient = $inputData + ['id' => $id];
        
        $this->requestMock
            ->shouldReceive('validated')
            ->once()
            ->andReturn($inputData);

        $this->pacientesServiceMock
            ->shouldReceive('registerPatients')
            ->once()
            ->with($this->requestMock)
            ->andReturn($expectedPatient);
        
        $response = $this->pacientesController->store($this->requestMock);
        
        $this->assertInstanceOf(\Illuminate\Http\JsonResponse::class, $response);

        $responseData = $response->getData(true);
        $this->assertEquals($expectedPatient, $responseData);
        $this->assertEquals(201, $response->getStatusCode());
    }

    public function testRegisterPatientFailure() {

        $this->requestMock
            ->shouldReceive('validated')
            ->once()
            ->andReturn(true);

        // Configura o mock do serviço para retornar erro
        $errorMessage = 'Erro no banco de dados';
        $this->pacientesServiceMock
            ->shouldReceive('registerPatients')
            ->once()
            ->with($this->requestMock)
            ->andReturn([
                'success' => false,
                'message' => 'Falha ao cadastrar paciente',
                'data' => $errorMessage,
                'status' => 500
            ]);

        //chama o método do controller
        $response = $this->pacientesController->store($this->requestMock);

        //verifica o status HTTP
        $this->assertEquals(500, $response->getStatusCode());
        
        //verifica o conteúdo da resposta
        $responseData = $response->getData(true);
        $this->assertFalse($responseData['success']);
        $this->assertEquals('Falha ao cadastrar paciente', $responseData['message']);
        $this->assertEquals($errorMessage, $responseData['data']);

    }

    public function testFindPatientSuccesss() {

        $id = 1;

        $expectedPatient =
            ['id' => '1', 'nome' => 'joao', 'idade' => 22, 'email' => 'joao123@gmail.com',
            'telefone' => '12345678', 'alergias' => 'nao possuo', 'usando_medicamentos' => 'remedio_1', 'senha' => '123123', 'message' => 'Paciente encontrado'];

        $this->pacientesServiceMock
            ->shouldReceive('findPatient')
            ->once()
            ->with($id)
            ->andReturn($expectedPatient);

        $response = $this->pacientesController->show($id);

        $this->assertEquals(200, $response->getStatusCode());
        //verifica o conteúdo da resposta
        $responseData = $response->getData(true);
        $this->assertEquals(($expectedPatient), $responseData);
        $this->assertEquals('Paciente encontrado', $responseData['message']);

    }

    public function testFindPatientFailure() {
        $id = 2;

        $this->pacientesServiceMock
            ->shouldReceive('findPatient')
            ->once()
            ->with($id)
            ->andReturn([
                'status' => 404,
                'message' => 'Paciente não encontrado',
                'error' => 'Erro no banco de dados'
        ]);

        $response = $this->pacientesController->show($id);

        $responseData = $response->getData(true);
        $this->assertEquals(404, $responseData['status']);
        $this->assertEquals('Paciente não encontrado', $responseData['message']);

    }

    public function testUpdatePatientSucess() {

        $id = 1;

        $inputPatient = 
            ['nome' => 'victor', 'idade' => 23, 'email' => 'joao123@gmail.com',
            'telefone' => '12345678', 'alergias' => 'nao possuo', 'usando_medicamentos' => 'remedio_1', 'senha' => '123123'];

        $expectedPatient = $inputPatient + ['id' => $id];

        $request = new Request([], $inputPatient); 

        $this->pacientesServiceMock
            ->shouldReceive('updatePatient')
            ->once()
            ->with($request ,$id)
            ->andReturn([
                'status' => 200,
                'message' => 'Paciente atualizado com sucesso',
                'data' => $expectedPatient
            ]);

        $response = $this->pacientesController->update($request, $id);

        $this->assertEquals(200, $response->getStatusCode());
        //verifica o conteúdo da resposta
        $responseData = $response->getData(true);

        $this->assertEquals([
            'status' => 200,
            'message' => 'Paciente atualizado com sucesso',
            'data' => $expectedPatient
        ], $responseData);

        $this->assertEquals($expectedPatient, $responseData['data']);
    }

    public function testUpdatePatientFailure() {

        $id = 1;

        $inputPatient = 
            ['nome' => 'victor', 'idade' => 23, 'email' => 'joao123@gmail.com',
            'telefone' => '12345678', 'alergias' => 'nao possuo', 'usando_medicamentos' => 'remedio_1', 'senha' => '123123'];


        $request = new Request([], $inputPatient); 

        $this->pacientesServiceMock
            ->shouldReceive('updatePatient')
            ->once()
            ->with($request ,$id)
            ->andReturn([
                'status' => 404,
                'message' => 'Não foi possível atualizar paciente de id: '
            ]);

        $response = $this->pacientesController->update($request, $id);

        $responseData = $response->getData(true);

        $this->assertEquals(404, $responseData['status']);
        $this->assertEquals("Não foi possível atualizar paciente de id: ", $responseData['message']);

    }

    public function testDeletePatientSucess() {

        $id = 1;

        $this->pacientesServiceMock
            ->shouldReceive('deletePatient')
            ->once()
            ->with($id)
            ->andReturn([
                'status' => 200,
                'message' => 'Paciente deletado com sucesso'
            ]);

        $response = $this->pacientesController->destroy($id);

        $this->assertEquals(200, $response->getStatusCode());
        //verifica o conteúdo da resposta
        $responseData = $response->getData(true);

        $this->assertEquals([
            'status' => 200,
            'message' => 'Paciente deletado com sucesso'
        ], $responseData);
    }

    public function testDeletePatientFailure() {

        $id = 1;

        $this->pacientesServiceMock
            ->shouldReceive('deletePatient')
            ->once()
            ->with($id)
            ->andReturn([
                'status' => 404,
                'message' => 'Não foi possível deletar paciente de id: '
            ]);

        $response = $this->pacientesController->destroy($id);

        $this->assertEquals(404, $response->getStatusCode());
        //verifica o conteúdo da resposta
        $responseData = $response->getData(true);

        $this->assertEquals([
            'status' => 404,
            'message' => 'Não foi possível deletar paciente de id: '
        ], $responseData);
    }
}
