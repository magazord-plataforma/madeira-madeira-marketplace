<?php

namespace MadeiraMadeira\Marketplace\Dominio\Categoria;

use \MadeiraMadeira\Marketplace\Dominio;

/**
 * Description of CategoriaList
 *
 * @author Maicon Sasse
 */
class CategoriaListResponse extends Dominio\ListResponse
{

    /**
     * Mapeamento de propriedades que sao objetos ou arrays
     * @var array
     */
    protected $_mapper = array(
        'data' => Categoria::class,
        'meta' => Dominio\Meta::class
    );

    /**
     * @param int $idCategoria
     * @return Categoria
     */
    public function findByIdCategoria($idCategoria)
    {
        if ($this->getData()) {
            foreach ($this->getData() as $categoria) {
                if ($categoria->getIdCategoria() == $idCategoria) {
                    return $categoria;
                }
            }
        }
        return null;
    }

}
