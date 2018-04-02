<?php

namespace MadeiraMadeira\Marketplace\Dominio\Pedido\Callback;

use \MadeiraMadeira\Marketplace\Dominio;

/**
 * Description of Notificacao
 *
 * @author Maicon Sasse
 */
class Notificacao extends Dominio\AbstractModel
{

    protected $order;
    protected $status;
    protected $time;

    public function getOrder()
    {
        return $this->order;
    }

    public function setOrder($order)
    {
        $this->order = $order;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function setTime($time)
    {
        $this->time = $time;
    }

}
