<?php

namespace MadeiraMadeira\Marketplace\Dominio\Pedido;

use \MadeiraMadeira\Marketplace\Dominio;

/**
 * Description of PedidoListFilter
 *
 * @author Maicon Sasse
 */
class PedidoListFilter extends Dominio\ListFilter
{

    protected $_id_pedido;
    protected $_status;

    public function getIdPedido()
    {
        return $this->_id_pedido;
    }

    public function getStatus()
    {
        return $this->_status;
    }

    public function setIdPedido($idPedido)
    {
        $this->_id_pedido = $idPedido;
    }

    public function setStatus($status)
    {
        $this->_status = $status;
    }

}
