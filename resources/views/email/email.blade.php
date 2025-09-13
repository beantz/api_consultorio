<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orçamento Odontológico</title>
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
            <h1>Orçamento Odontológico</h1>
            <p>Clínica Sorriso Perfeito</p>
        </div>

        <div class="content">
            <h2>Olá, {{ $orcamento->agendamento->users->nome }}!</h2>
            <p>Seu orçamento foi gerado em: <strong>{{ $orcamento->agendamento->data_consulta }}</strong></p>
            
            <hr>
            
            <h3>📋 Procedimentos Propostos:</h3>
            
            <div class="orcamento">
                <p>{{ $orcamento->relatorio }}</p>
                <p class="valor">R$ {{ number_format($orcamento->valor_total, 2, ',', '.') }}</p>
            </div>

            <h3>ℹ️ Informações Importantes:</h3>
            <ul>
                <li>Orçamento válido por 30 dias</li>
                <li>Formas de pagamento: à vista, cartão ou parcelado</li>
                <li>Agendamento sujeito à disponibilidade</li>
            </ul>

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