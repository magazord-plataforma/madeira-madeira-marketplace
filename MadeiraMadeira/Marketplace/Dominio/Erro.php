<?php

namespace MadeiraMadeira\Marketplace\Dominio;

/**
 * Description of Erro
 *
 * @author Maicon Sasse
 */
class Erro extends AbstractModel
{

    protected $_errorMessages = array(
        401 => 'Ausência de um dos Tokens no header ou token não existe',
        403 => 'Token revogado ou inválido',
        404 => 'Registro não encontrado',
        405 => 'Método de requisição, inválido. (Quando um endpoint não aceita o método em questão)',
        400 => 'Erro no JSON enviado (Verificar estrutura e enviar novamente)',
        500 => 'Erro interno de servidor, solicitar suporte para a equipe da Madeira Madeira'
    );

    public function getMensagem()
    {
        $result = '';
        if ($msgResposta = $this->getMensagemResposta()) {
            $result = 'Resposta inválida do servidor do marketplace. ' . $msgResposta . '. HttpCode: ' . $this->getHttpResponseCode();
        } else if ($this->getHttpResponseCode() && isset($this->_errorMessages[$this->getHttpResponseCode()])) {
            $result = $this->_errorMessages[$this->getHttpResponseCode()] . '. HttpCode: ' . $this->getHttpResponseCode();
        } else {
            $result = 'Resposta inválida do servidor do marketplace. HttpCode: ' . $this->getHttpResponseCode();
        }
        return $result;
    }

    protected function getMensagemResposta()
    {
        $mensagem = '';
        $decoded = ($this->getResponseString()) ? json_decode($this->getResponseString(), true) : null;
        if ($decoded && isset($decoded['errors']) && isset($decoded['errors']['detail'])) {
            $detail = $decoded['errors']['detail'];
            if (isset($detail['message'])) {
                $mensagem = $detail['message'];
            }
            if (isset($detail[0]) && isset($detail[0]['message'])) {
                $mensagem = $detail[0]['message'];
            }
            if (isset($detail[0]) && isset($detail[0][0]) && isset($detail[0][0]['message'])) {
                $mensagem = $detail[0][0]['message'];
            }
        }
        return $mensagem;
    }

    public function asString()
    {
        return $this->getMensagem();
    }

}
