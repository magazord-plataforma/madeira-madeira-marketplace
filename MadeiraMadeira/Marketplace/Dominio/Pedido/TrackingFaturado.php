<?php

namespace MadeiraMadeira\Marketplace\Dominio\Pedido;

/**
 * Description of TrackingFaturado
 *
 * @author Maicon Sasse
 */
class TrackingFaturado extends TrackingItem
{

    protected $chave_acesso;
    protected $data_emissao;
    protected $valor;

    public function getChaveAcesso()
    {
        return $this->chave_acesso;
    }

    public function setChaveAcesso($chaveAcesso)
    {
        $this->chave_acesso = $chaveAcesso;
    }

    public function getDataEmissao()
    {
        return $this->data_emissao;
    }

    public function setDataEmissao($dataEmissao)
    {
        $this->data_emissao = $dataEmissao;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function setValor($valor)
    {
        $this->valor = $this->floatValue($valor);
    }

}
