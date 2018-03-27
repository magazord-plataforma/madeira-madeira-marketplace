<?php

namespace MadeiraMadeira\Marketplace\Dominio\Pedido;

/**
 * Description of TrackingEntregue
 *
 * @author Maicon Sasse
 */
class TrackingEntregue extends TrackingItem
{

    protected $data_entrega;

    public function getDataEntrega()
    {
        return $this->data_entrega;
    }

    public function setDataEntrega($dataEntrega)
    {
        $this->data_entrega = $dataEntrega;
    }

}
