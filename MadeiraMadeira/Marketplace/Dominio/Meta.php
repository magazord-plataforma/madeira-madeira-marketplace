<?php

namespace MadeiraMadeira\Marketplace\Dominio;

/**
 * Description of ListResponseMeta
 *
 * @author Maicon Sasse
 */
class Meta extends AbstractModel
{

    protected $count;

    public function getCount()
    {
        return $this->count;
    }

    public function setCount($count)
    {
        $this->count = $count;
    }

}
