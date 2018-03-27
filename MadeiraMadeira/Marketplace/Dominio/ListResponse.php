<?php

namespace MadeiraMadeira\Marketplace\Dominio;

/**
 * Description of ListResponse
 *
 * @author Maicon Sasse
 */
class ListResponse extends AbstractModel
{

    protected $data;

    /**
     * @var Meta
     */
    protected $meta;

    /**
     * Mapeamento de propriedades que sao objetos ou arrays
     * @var array
     */
    protected $_mapper = array(
        'meta' => Meta::class
    );

    public function getData()
    {
        return ($this->data) ? $this->data : array();
    }

    public function getMeta()
    {
        return $this->meta;
    }

    public function getCount()
    {
        return ($this->getMeta()) ? $this->getMeta()->getCount() : null;
    }

    public function setData($data)
    {
        // data deve ter sempre um array, então se o valor setado não é array traforma-o
        if ($data !== null && !is_array($data)) {
            $data = array($data);
        }
        $this->data = $data;
    }

    public function addData($item)
    {
        $data = ($this->getData()) ? $this->getData() : array();
        $data[] = $item;
        $this->setData($data);
    }

    public function setMeta(Meta $meta = null)
    {
        $this->meta = $meta;
    }

    public function setMapperData($className)
    {
        $this->_mapper['data'] = $className;
    }

}
