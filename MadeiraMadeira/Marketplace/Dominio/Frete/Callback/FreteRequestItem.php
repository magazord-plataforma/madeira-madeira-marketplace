<?php

namespace MadeiraMadeira\Marketplace\Dominio\Frete\Callback;

use \MadeiraMadeira\Marketplace\Dominio;

/**
 * Description of FreteRequestItem
 *
 * @author Maicon Sasse
 */
class FreteRequestItem extends Dominio\AbstractModel
{

    protected $sku;
    protected $quantity;

    public function getSku()
    {
        return $this->sku;
    }

    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

}
