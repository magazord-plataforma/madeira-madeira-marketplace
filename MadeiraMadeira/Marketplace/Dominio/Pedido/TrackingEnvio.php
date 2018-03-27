<?php

namespace MadeiraMadeira\Marketplace\Dominio\Pedido;

/**
 * Description of TrackingEnvio
 *
 * @author Maicon Sasse
 */
class TrackingEnvio extends TrackingItem
{

    protected $data_transportadora;
    protected $codigo_rastreio;
    protected $nome_transportadora;
    protected $url_rastreio;

    public function getDataTransportadora()
    {
        return $this->data_transportadora;
    }

    public function setDataTransportadora($dataTransportadora)
    {
        $this->data_transportadora = $dataTransportadora;
    }

    public function getCodigoRastreio()
    {
        return $this->codigo_rastreio;
    }

    public function setCodigoRastreio($codigoRastreio)
    {
        $this->codigo_rastreio = $codigoRastreio;
    }

    public function getNomeTransportadora()
    {
        return $this->nome_transportadora;
    }

    public function setNomeTransportadora($nomeTransportadora)
    {
        $this->nome_transportadora = $nomeTransportadora;
    }

    public function getUrlRastreio()
    {
        return $this->url_rastreio;
    }

    public function setUrlRastreio($urlRastreio)
    {
        $this->url_rastreio = $urlRastreio;
    }

}
