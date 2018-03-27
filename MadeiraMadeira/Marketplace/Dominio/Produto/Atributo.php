<?php

namespace MadeiraMadeira\Marketplace\Dominio\Produto;

use \MadeiraMadeira\Marketplace\Dominio;

/**
 * Description of Atributo
 *
 * @author Maicon Sasse
 */
class Atributo extends Dominio\AbstractModel
{

    protected $nome;
    protected $valor;

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    public function getValor()
    {
        return $this->valor;
    }

}
