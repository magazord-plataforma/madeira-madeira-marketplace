<?php

namespace MadeiraMadeira\Marketplace\Dominio\Pedido;

use \MadeiraMadeira\Marketplace\Dominio;

/**
 * Description of Pagamento
 *
 * @author Maicon Sasse
 */
class Pagamento extends Dominio\AbstractModel
{

    protected $tipo;

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

}
