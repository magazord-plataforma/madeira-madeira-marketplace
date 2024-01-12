<?php

namespace MadeiraMadeira\Marketplace\Dominio\Envios;

use \MadeiraMadeira\Marketplace\Dominio;

/**
 * Description of EtiquetaSolicitacao
 *
 * @author Maicon Sasse
 */
class EtiquetaSolicitacao extends Dominio\AbstractModel
{

    /**
     * @var EtiquetaSolicitacaoItem[]
     */
    protected $itens;

    public function getItens()
    {
        return $this->itens;
    }

    public function setItens(array $itens = null)
    {
        $this->itens = $itens;
    }

    public function add(EtiquetaSolicitacaoItem $item)
    {
        $itens = $this->getItens() ? $this->getItens() : array();
        $itens[] = $item;
        $this->setItens($itens);
    }

}
