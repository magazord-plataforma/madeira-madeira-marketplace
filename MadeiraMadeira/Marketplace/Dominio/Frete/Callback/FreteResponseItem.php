<?php

namespace MadeiraMadeira\Marketplace\Dominio\Frete\Callback;

use \MadeiraMadeira\Marketplace\Dominio;

/**
 * Description of FreteResponseItem
 *
 * @author Maicon Sasse
 */
class FreteResponseItem extends Dominio\AbstractModel
{

    protected $shippingCost;

    /**
     * @var DeliveryTime
     */
    protected $deliveryTime;
    protected $shippingEstimatedId;
    protected $shippingMethodId;
    protected $shippingMethodName;
    protected $shippingMethodDisplayName;

    /**
     * Mapeamento de propriedades que sao objetos ou arrays
     * @var array
     */
    protected $_mapper = array(
        'deliveryTime' => DeliveryTime::class
    );

    public function getShippingCost()
    {
        return $this->shippingCost;
    }

    public function setShippingCost($shippingCost)
    {
        $this->shippingCost = $this->floatValue($shippingCost);
    }

    public function getDeliveryTime()
    {
        return $this->deliveryTime;
    }

    public function setDeliveryTime(DeliveryTime $deliveryTime = null)
    {
        $this->deliveryTime = $deliveryTime;
    }

    public function getShippingEstimatedId()
    {
        return $this->shippingEstimatedId;
    }

    public function setShippingEstimatedId($shippingEstimatedId)
    {
        $this->shippingEstimatedId = $shippingEstimatedId;
    }

    public function getShippingMethodId()
    {
        return $this->shippingMethodId;
    }

    public function setShippingMethodId($shippingMethodId)
    {
        $this->shippingMethodId = $shippingMethodId;
    }

    public function getShippingMethodName()
    {
        return $this->shippingMethodName;
    }

    public function setShippingMethodName($shippingMethodName)
    {
        $this->shippingMethodName = $shippingMethodName;
    }

    public function getShippingMethodDisplayName()
    {
        return $this->shippingMethodDisplayName;
    }

    public function setShippingMethodDisplayName($shippingMethodDisplayName)
    {
        $this->shippingMethodDisplayName = $shippingMethodDisplayName;
    }

}
