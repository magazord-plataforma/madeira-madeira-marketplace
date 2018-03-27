<?php

namespace MadeiraMadeira\Marketplace;

/**
 * Description of CategoriaSender
 *
 * @author Maicon Sasse
 */
class CategoriaSender extends AbstractSender
{

    /**
     * Consulta árvore de categorias
     * @param Dominio\ListFilter $filtro
     * @return Dominio\Categoria\CategoriaListResponse
     */
    public function consultarCategorias(Dominio\ListFilter $filtro)
    {
        $this->reset();
        $this->setMethod(self::METHOD_GET);
        $this->setSuccessResponseClass(Dominio\Categoria\CategoriaListResponse::class);
        return $this->send('/categoria/limit=' . $filtro->getLimit() . '&offset=' . $filtro->getOffset());
    }

}
