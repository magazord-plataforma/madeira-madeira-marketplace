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
     * @param Dominio\Categoria\CategoriaListFilter $filtro
     * @return Dominio\Categoria\CategoriaListResponse
     */
    public function consultarCategorias(Dominio\Categoria\CategoriaListFilter $filtro)
    {
        $this->reset();
        $this->setMethod(self::METHOD_GET);
        $this->setSuccessResponseClass(Dominio\Categoria\CategoriaListResponse::class);
        $path = '/categoria/limit=' . $filtro->getLimit() . '&offset=' . $filtro->getOffset();
        if ($filtro->getNome()) {
            $path .= '&nome=' . urlencode($filtro->getNome());
        }
        return $this->send($path);
    }

}
