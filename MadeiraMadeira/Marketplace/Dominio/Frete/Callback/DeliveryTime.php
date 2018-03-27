<?php

namespace MadeiraMadeira\Marketplace\Dominio\Frete\Callback;

use \MadeiraMadeira\Marketplace\Dominio;

/**
 * Description of DeliveryTime
 *
 * @author Maicon Sasse
 */
class DeliveryTime extends Dominio\AbstractModel
{

    protected $expedition;
    protected $transit;
    protected $total;

    public function getExpedition()
    {
        return $this->expedition;
    }

    public function setExpedition($expedition)
    {
        $this->expedition = $this->intValue($expedition);
    }

    public function getTransit()
    {
        return $this->transit;
    }

    public function setTransit($transit)
    {
        $this->transit = $this->intValue($transit);
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function setTotal($total)
    {
        $this->total = $this->intValue($total);
    }

}
