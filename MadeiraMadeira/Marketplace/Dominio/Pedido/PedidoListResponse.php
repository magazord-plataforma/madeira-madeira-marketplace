<?php

namespace MadeiraMadeira\Marketplace\Dominio\Pedido;

use \MadeiraMadeira\Marketplace\Dominio;

/**
 * Description of PedidoListResponse
 *
 * @author Maicon Sasse
 */
class PedidoListResponse extends Dominio\ListResponse
{

    /**
     * Mapeamento de propriedades que sao objetos ou arrays
     * @var array
     */
    protected $_mapper = array(
        'data' => Pedido::class,
        'meta' => Dominio\Meta::class
    );

}
