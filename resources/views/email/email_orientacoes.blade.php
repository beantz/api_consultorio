<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procedimento Odontológico</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #007bff; color: white; padding: 20px; text-align: center; }
        .content { background: #f9f9f9; padding: 20px; border-radius: 0 0 5px 5px; }
        .footer { text-align: center; margin-top: 20px; font-size: 12px; color: #666; }
        .valor { font-size: 18px; font-weight: bold; color: #007bff; }
        .orcamento { margin-bottom: 10px; padding: 10px; background: white; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Procedimento Odontológico</h1>
            <p>Clínica Sorriso Perfeito</p>
        </div>

        <div class="content">
            <h2>Olá, {{ $agendamento->users->nome }}!</h2>
            <p>Seu agendamento foi gerado em: <strong>{{ $agendamento->data_consulta }}</strong></p>
            
            <hr>
            
            <h3>📋 Procedimentos Necessários:</h3>
            <h4>📋 Informações detalhadas sobre seus Procedimentos:</h4>
            
            <div class="orcamento">
            @foreach ($agendamento->procedimento as $value)
                
            @endforeach
                <p>{{ $value }}</p>
                <p>{{ $value->nome }}</p>
                <p>{{ $value->orientacoes }}</p>
                <p>{{ $value->raio_x ?? ''}}</p>
                <p>{{ $value->medicamento_pre }}</p>
                <p>{{ $value->medicamento_pos }}</p>
            </div>

            <div style="text-align: center; margin: 20px 0;">
                <a href="#" style="background: #007bff; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px; display: inline-block;">
                    ✅ Agendar Procedimentos
                </a>
            </div>
        </div>

        <div class="footer">
            <p>Clínica Sorriso Perfeito</p>
            <p>📍 Endereço: Rua das Flores, 123 - Centro</p>
            <p>📞 Telefone: (11) 9999-9999</p>
            <p>✉️ Email: contato@clinicasorrisoperfeito.com</p>
            <p>⚠️ Este é um e-mail automático, favor não responder</p>
        </div>
    </div>
</body>
</html>