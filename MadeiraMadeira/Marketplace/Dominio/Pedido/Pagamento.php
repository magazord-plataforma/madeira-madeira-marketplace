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
    protected $metodo;
    protected $bandeira;
    protected $parcelas;

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function getMetodo()
    {
        return $this->metodo;
    }

    public function setMetodo($metodo)
    {
        $this->metodo = $metodo;
    }

    public function getBandeira()
    {
        return $this->bandeira;
    }

    public function setBandeira($bandeira)
    {
        $this->bandeira = $bandeira;
    }

    public function getParcelas()
    {
        return $this->parcelas;
    }

    public function setParcelas($parcelas)
    {
        $this->parcelas = $parcelas;
    }

}
