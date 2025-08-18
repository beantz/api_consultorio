<?php

namespace App\Services;

use App\Repositories\AgendamentoProcedimentoRepositorie;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AgendamentoProcedimentoService {

    use ApiResponse;

    protected $agendamentoProcedimentoRepositorie;

    public function __construct(AgendamentoProcedimentoRepositorie $agendamentoProcedimentoRepositorie)
    {
        $this->agendamentoProcedimentoRepositorie = $agendamentoProcedimentoRepositorie;
    }

    public function getAll() {

        try {
            $agendamentosProcedimentos = $this->agendamentoProcedimentoRepositorie->getAll();

            if($agendamentosProcedimentos->count() > 0) {
                return $this->success($agendamentosProcedimentos, 'Todos os agendamentos com procedimentos aqui', 200);
            }

            return $this->error('Sem agendamentos com procedimentos cadastrados', 404);
            
        } catch (\Exception $e) {
            
            return $this->error('Falha ao listar agendamentos com procedimento', 500, $e->getMessage());
        }

    }

    public function registerAppointmentProcedure(Request $request, $id_procedimento) {

        //vallidações

        try {


            $newAgendamento = $this->agendamentoProcedimentoRepositorie->create($request, $id_procedimento);
            return $this->success($newAgendamento, 'Agendamento com procedimento criado', 201);
            
        } catch (\Exception $e) {
            
            return $this->error('Falha ao criar agendamento', 500, $e->getMessage());
        }

    }

    public function findAppointmentProcedure($id) {

        try {
            $agendamentos = $this->agendamentoProcedimentoRepositorie->getAll();
            $agendamento = $agendamentos->find($id);

            if(is_null($agendamento)){
                return $this->error("Agendamento de id: $id não encontrado!", 404);
                
            }
             
            return $this->success($agendamento, 'Agendamento encontrado', 200);
            
        } catch (\Exception $e) {
            
            return $this->error('Falha ao buscar agendamento', 500, $e->getMessage());
        }
    }

    public function deleteAppointmentProcedure($id) {

        try {
            $agendamentos = $this->agendamentoProcedimentoRepositorie->getAll();
            $agendamento = $agendamentos->find($id);

            if(is_null($agendamento)){
                return $this->error("Agendamento de id: $id não encontrado!", 404);
            }

            $agendamento->delete();
            return $this->success(null, 'Agendamento deletado com sucesso', 200);
            
        } catch (\Exception $e) {
            
            return $this->error("Não foi possível deletar agendamento de id: $id", 404);
        }

    }

}