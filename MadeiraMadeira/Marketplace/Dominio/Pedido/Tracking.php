<?php

namespace MadeiraMadeira\Marketplace\Dominio\Pedido;

use \MadeiraMadeira\Marketplace\Dominio;

/**
 * Description of Tracking
 *
 * @author Maicon Sasse
 */
class Tracking extends Dominio\AbstractModel
{

    protected $id_pedido;
    protected $faturamento;
    protected $envio;
    protected $entrega;

    /**
     * Mapeamento de propriedades que sao objetos ou arrays
     * @var array
     */
    protected $_mapper = array(
        'faturamento' => TrackingFaturado::class,
        'envio' => TrackingEnvio::class,
        'entrega' => TrackingEntregue::class
    );

    public function getIdPedido()
    {
        return $this->id_pedido;
    }

    public function setIdPedido($idPedido)
    {
        $this->id_pedido = $this->floatValue($idPedido); // Usamos o float pois o número do pedido pode ser grande...
    }

    public function getFaturamento()
    {
        return $this->faturamento;
    }

    public function setFaturamento(array $faturamento = null)
    {
        $this->faturamento = $faturamento;
    }

    public function getEnvio()
    {
        return $this->envio;
    }

    public function setEnvio(array $envio = null)
    {
        $this->envio = $envio;
    }

    public function getEntrega()
    {
        return $this->entrega;
    }

    public function setEntrega(array $entrega = null)
    {
        $this->entrega = $entrega;
    }

}
