<?php

namespace MadeiraMadeira\Marketplace\Dominio\Pedido;

use \MadeiraMadeira\Marketplace\Dominio;

/**
 * Description of PedidoItem
 *
 * @author Maicon Sasse
 */
class PedidoItem extends Dominio\AbstractModel
{

    protected $sku;
    protected $nome;
    protected $total;
    protected $skuseller;
    protected $quantidade;
    protected $valor_unitario;
    protected $frete;
    protected $id_pedido_item;
    protected $madeira_envios;

    public function getSku()
    {
        return $this->sku;
    }

    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function setTotal($total)
    {
        $this->total = $total;
    }

    public function getSkuseller()
    {
        return $this->skuseller;
    }

    public function setSkuseller($skuseller)
    {
        $this->skuseller = $skuseller;
    }

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
    }

    public function getValorUnitario()
    {
        return $this->valor_unitario;
    }

    public function setValorUnitario($valorUnitario)
    {
        $this->valor_unitario = $valorUnitario;
    }

    public function getFrete()
    {
        return $this->frete;
    }

    public function setFrete($frete)
    {
        $this->frete = $frete;
    }

    public function getIdPedidoItem()
    {
        return $this->id_pedido_item;
    }

    public function setIdPedidoItem($idPedidoItem)
    {
        $this->id_pedido_item = $idPedidoItem;
    }

    public function getMadeiraEnvios()
    {
        return $this->madeira_envios;
    }

    public function setMadeiraEnvios($madeiraEnvios)
    {
        $this->madeira_envios = $madeiraEnvios;
    }

}
