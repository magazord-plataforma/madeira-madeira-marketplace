<?php

namespace MadeiraMadeira\Marketplace\Dominio\Pedido;

use \MadeiraMadeira\Marketplace\Dominio;

/**
 * Description of TrackingItem
 *
 * @author Maicon Sasse
 */
abstract class TrackingItem extends Dominio\AbstractModel
{

    protected $sku;
    protected $quantidade;

    /**
     * Formato valores data
     * @var type
     */
    protected $_formatDate = 'd/m/Y';

    public function getSku()
    {
        return $this->sku;
    }

    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
    }

}
