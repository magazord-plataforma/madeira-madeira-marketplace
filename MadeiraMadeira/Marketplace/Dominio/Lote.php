<?php

namespace MadeiraMadeira\Marketplace\Dominio;

/**
 * Description of Lote
 *
 * @author Maicon Sasse
 */
class Lote extends AbstractModel
{

    /**
     * @var AbstractModel[]
     */
    protected $_lista;

    public function getLista()
    {
        return $this->_lista;
    }

    public function setLista(array $lista = null)
    {
        $this->_lista = $lista;
    }

    public function add($item)
    {
        $lista = $this->getLista() ? $this->getLista() : array();
        $lista[] = $item;
        $this->setLista($lista);
    }

    public function serialize()
    {
        $result = null;
        if ($lista = $this->getLista()) {
            $result = array();
            foreach ($lista as $index => $value) {
                if ($value instanceof AbstractModel) {
                    $result[$index] = $value->serialize();
                } else {
                    $result[$index] = $value;
                }
            }
        }
        return $result;
    }

}
