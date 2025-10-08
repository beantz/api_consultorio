<?php

namespace App\Services;

use App\Http\Requests\AtualizarAgendamentoStatusRequest;
use App\Http\Requests\ValidationAgendamento;
use App\Repositories\AgendamentoRepositorie;
use App\Traits\ApiResponse;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class AgendamentoService {

    use ApiResponse;

    protected $agendamentoRepositorie;

    public function __construct(AgendamentoRepositorie $agendamentoRepositorie)
    {
        $this->agendamentoRepositorie = $agendamentoRepositorie;
    }

    public function getAll() {

        try {
            $agendamentos = $this->agendamentoRepositorie->getAll();

            if($agendamentos->count() > 0) {
                return $this->success($agendamentos, 'Todos os agendamentos', 200);
            }

            return $this->error('Sem agendamentos cadastrados', 404);
            
        } catch (\Exception $e) {
            
            return $this->error('Falha ao listar agendamentos', 500, $e->getMessage());
        }

    }

    public function registerAppointment(ValidationAgendamento $request) {

        $request->validated();

        try {
            $newAgendamento = $this->agendamentoRepositorie->create($request);
            return $this->success($newAgendamento, 'Agendamento criado', 201);
            
        } catch (\Exception $e) {
            
            return $this->error('Falha ao criar agendamento', 500, $e->getMessage());
        }

    }

    public function findAppointment($id) {

        try {
            $agendamento = $this->agendamentoRepositorie->find($id);

            if(is_null($agendamento)){
                $response = $this->error("Paciente de id: $id não encontrado!", 404);
                return $response;
            }
             
            return $this->success($agendamento, 'Agendamento encontrado', 200);
            
        } catch (\Exception $e) {
            
            return $this->error('Falha ao buscar agendamento', 500, $e->getMessage());
        }
    }

    public function updateAppointment(ValidationAgendamento $request, $id) {

        $request->validated();

        try {
            
            $agendamento = $this->agendamentoRepositorie->find($id);

            if(is_null($agendamento)){
                return $this->error("Agendamento de id: $id não encontrado!", 404);
            }
            
            $agendamento->update($request->all());
            return $this->success($agendamento, 'Agendamento atualizado com sucesso', 200);
            
        } catch (\Exception $e) {
            
            return $this->error("Não foi possível atualizar agendamento de id: $id", 404, $e->getMessage());
        }

    }

    public function deleteAppointment($id) {

        try {
            $agendamento = $this->agendamentoRepositorie->find($id);

            if(is_null($agendamento)){
                return $this->error("Agendamento de id: $id não encontrado!", 404);
            }

            $agendamento->delete();
            return $this->success(null, 'Agendamento deletado com sucesso', 200);
            
        } catch (\Exception $e) {
            
            return $this->error("Não foi possível deletar agendamento de id: $id", 404);
        }

    }

    public function updateStatusAndReport(AtualizarAgendamentoStatusRequest $request, $id) {

        $request->validated();

        try {
            $agendamento = $this->agendamentoRepositorie->find($id);

            if(is_null($agendamento)){
                return $this->error("Agendamento de id: $agendamento não encontrado!", 404);
            }

            $agendamento->update(['status' => $request->status, 'relatorio_consulta' => $request->relatorio_consulta]);

            return $this->success($agendamento, 'Agendamento atualizado com sucesso', 200);
            
        } catch (\Exception $e) {
            
            return $this->error("Não foi possível deletar agendamento de id: $id", 404);
        }

    }

}