<?php

namespace MadeiraMadeira\Marketplace\Dominio\Frete\Callback;

use \MadeiraMadeira\Marketplace\Dominio;

/**
 * Description of FreteRequest
 *
 * @author Maicon Sasse
 */
class FreteRequest extends Dominio\AbstractModel
{

    protected $destinationZip;

    /**
     * @var FreteRequestItem[]
     */
    protected $volumes;

    /**
     * Mapeamento de propriedades que sao objetos ou arrays
     * @var array
     */
    protected $_mapper = array(
        'volumes' => FreteRequestItem::class
    );

    public function getDestinationZip()
    {
        return $this->destinationZip;
    }

    public function setDestinationZip($destinationZip)
    {
        $this->destinationZip = $destinationZip;
    }

    public function getVolumes()
    {
        return $this->volumes;
    }

    public function setVolumes(array $volumes = null)
    {
        $this->volumes = $volumes;
    }

}
