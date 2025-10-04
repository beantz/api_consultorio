<?php

namespace App\Services;

use App\Http\Requests\ValidationAgendamentoProcedimento;
use App\Mail\OrcamentoEmail;
use App\Mail\OrientacoesEmail;
use App\Models\Agendamento;
use App\Models\AgendamentoProcedimento;
use App\Repositories\AgendamentoProcedimentoRepositorie;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

    public function registerAppointmentProcedure(ValidationAgendamentoProcedimento $request, $id_procedimento) {

        $request->validated();

        try {

            $newAgendamento = $this->agendamentoProcedimentoRepositorie->create($request, $id_procedimento);
            $emailPatient = $newAgendamento->users->email;

            //encaminhar e-mail para pacientes sobre informações sobre os proocedimento que irâo fazer
            Mail::to($emailPatient)->send(new OrientacoesEmail($newAgendamento));

            return $this->success($newAgendamento, 'Agendamento com procedimento criado', 201);
            
        } catch (\Exception $e) {
            
            return $this->error('Falha ao criar agendamento', 500, $e->getMessage());
        }

    }

    public function findAppointmentProcedure($id) {

        try {
            $agendamento = $this->agendamentoProcedimentoRepositorie->find($id);

            if(is_null($agendamento)){
                return $this->error("Agendamento de id: $id não encontrado!", 404);
                
            }
             
            return $this->success($agendamento, 'Agendamento encontrado', 200);
            
        } catch (\Exception $e) {
            
            return $this->error('Falha ao buscar agendamento', 500, $e->getMessage());
        }
    }

    public function deleteAppointmentProcedure(Request $request, $id_agendamento) {

        $id_procedimento = $request->get('id_procedimento');

        try {
            $agendamento = $this->agendamentoProcedimentoRepositorie->find($id_agendamento);

            if(!$agendamento){
                return $this->error("Agendamento de id: $id_agendamento não encontrado!", 404);
            }

            //verifica se no agendamento especifico possui o procedimento especifico cadastrado
            if(!$agendamento->procedimento->contains('id', $id_procedimento)){

                return $this->error("Agendamento de id: $id_agendamento não possui procedimentos cadastrados!", 500);
            }

            $agendamento->procedimento()->detach($id_procedimento);
            return $this->success(null, "Procedimento do agendamento de id: $id_agendamento deletado com sucesso", 200);
            
        } catch (\Exception $e) {
            
            return $this->error("Não foi possível deletar procedimento de id: $id_procedimento", 404);
        }

    }

}