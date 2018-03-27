<?php

namespace MadeiraMadeira\Marketplace\Dominio\Frete\Callback;

use \MadeiraMadeira\Marketplace\Dominio;

/**
 * Description of FreteResponse
 *
 * @author Maicon Sasse
 */
class FreteResponse extends Dominio\AbstractModel
{

    /**
     * @var FreteResponseItem[]
     */
    protected $shippingQuotes;

    /**
     * Mapeamento de propriedades que sao objetos ou arrays
     * @var array
     */
    protected $_mapper = array(
        'shippingQuotes' => FreteResponseItem::class
    );

    public function getShippingQuotes()
    {
        return $this->shippingQuotes;
    }

    public function setShippingQuotes(array $shippingQuotes = null)
    {
        $this->shippingQuotes = $shippingQuotes;
    }

    public function addShippingQuote(FreteResponseItem $shippingQuote)
    {
        $shippingQuotes = ($this->getShippingQuotes()) ? $this->getShippingQuotes() : array();
        $shippingQuotes[] = $shippingQuote;
        $this->setShippingQuotes($shippingQuotes);
    }

}
