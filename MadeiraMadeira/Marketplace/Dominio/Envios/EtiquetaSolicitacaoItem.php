<?php

namespace MadeiraMadeira\Marketplace\Dominio\Envios;

use \MadeiraMadeira\Marketplace\Dominio;

/**
 * Description of EtiquetaSolicitacaoItem
 *
 * @author Maicon Sasse
 */
class EtiquetaSolicitacaoItem extends Dominio\AbstractModel
{

    protected $id;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

}
