<?php

namespace MadeiraMadeira\Marketplace\Dominio;

/**
 * Description of ListFilter
 *
 * @author Maicon Sasse
 */
class ListFilter extends AbstractModel
{

    protected $limit = 50;
    protected $offset = 0;

    public function getLimit()
    {
        return $this->limit;
    }

    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

    public function getOffset()
    {
        return $this->offset;
    }

    public function setOffset($offset)
    {
        $this->offset = $offset;
    }

}
