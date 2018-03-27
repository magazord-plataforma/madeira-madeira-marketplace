<?php

namespace MadeiraMadeira\Marketplace\Dominio\Produto;

use \MadeiraMadeira\Marketplace\Dominio;

/**
 * Description of ProdutoList
 *
 * @author Maicon Sasse
 */
class ProdutoListResponse extends Dominio\ListResponse
{

    /**
     * Mapeamento de propriedades que sao objetos ou arrays
     * @var array
     */
    protected $_mapper = array(
        'data' => ProdutoResponse::class,
        'meta' => Dominio\Meta::class
    );

}
