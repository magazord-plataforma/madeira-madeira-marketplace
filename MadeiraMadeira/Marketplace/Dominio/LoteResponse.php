<?php

namespace MadeiraMadeira\Marketplace\Dominio;

/**
 * Description of LoteResponse
 *
 * @author Maicon Sasse
 */
class LoteResponse extends AbstractModel
{

    protected $meta;
    protected $data;
    protected $errors;

    /**
     * Mapeamento de propriedades que sao objetos ou arrays
     * @var array
     */
    protected $_mapper = array(
        'meta' => Meta::class
    );

    public function getMeta()
    {
        return $this->meta;
    }

    public function setMeta($meta)
    {
        $this->meta = $meta;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function setErrors($errors)
    {
        $this->errors = $errors;
    }

}
