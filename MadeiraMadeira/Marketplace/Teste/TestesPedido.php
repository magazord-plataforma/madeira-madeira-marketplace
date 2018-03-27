<?php

namespace MadeiraMadeira\Marketplace\Teste;

use \MadeiraMadeira\Marketplace\Dominio;

/**
 * Description of TestesPedido
 *
 * @author Maicon Sasse
 */
class TestesPedido extends AbstractTestes
{

    /**
     * @var \MadeiraMadeira\Marketplace\PedidoSender
     */
    protected $sender;

    protected function getSender()
    {
        if (!$this->sender) {
            $this->sender = new \MadeiraMadeira\Marketplace\PedidoSender($this->endpoint, $this->token);
            // Função de Log (opcional)
            $this->sender->setLogger($this->getLogger());
        }
        return $this->sender;
    }

    public function consultarPedidos()
    {
        $sender = $this->getSender();
        $filtro = new Dominio\ListFilter();
        $filtro->setLimit(50);
        $filtro->setOffset(0);
        do {
            $repeat = false;
            $lista = $sender->consultarPedido($filtro, Dominio\Pedido\Pedido::STATUS_CANCELADO_4);
            if ($lista->isSuccess()) {
                $contPagina = 0;
                /* @var $pedido Dominio\Pedido\Pedido */
                foreach ($lista->getData() as $pedido) {
                    echo $pedido->getIdPedido() . ' -> ' . $pedido->getPedidoWd() . PHP_EOL;
                    $contPagina++;
                }
                if ($contPagina >= $filtro->getLimit()) {
                    $repeat = true;
                    $filtro->setOffset($filtro->getOffset() + $filtro->getLimit());
                }
            } else {
                echo 'ERRO: ' . $lista->getResponseString() . PHP_EOL;
            }
        } while ($repeat);
    }

    public function consultarPedidoId()
    {
        $sender = $this->getSender();
        $pedido = $sender->consultarPedidoPorId(197);
        if ($pedido->isSuccess()) {
            echo $pedido->getIdPedido() . ' -> ' . $pedido->getPedidoWd() . PHP_EOL;
        } else {
            echo 'ERRO: ' . $pedido->getResponseString() . PHP_EOL;
        }
    }

    public function atualizaPedidoRecebido()
    {
        $sender = $this->getSender();

        $tracking = new Dominio\Pedido\Tracking();
        $tracking->setIdPedido(197);

        $lote = new Dominio\Lote();
        $lote->add($tracking);

        $result = $sender->atualizarPedidoRecebidoLote($lote);
        if ($result->isSuccess()) {
            echo 'OK' . PHP_EOL;
        } else {
            echo 'ERRO: ' . $result->getResponseString() . PHP_EOL;
        }
    }

    public function atualizaPedidoFaturado()
    {
        $sender = $this->getSender();

        $tracking = new Dominio\Pedido\Tracking();
        $tracking->setIdPedido(197);
        $trackingItem = new Dominio\Pedido\TrackingFaturado();
        $trackingItem->setSku('15586');
        $trackingItem->setQuantidade(5);
        $trackingItem->setChaveAcesso('42180312687276000179550010026926671001955444');
        $trackingItem->setDataEmissao('27/03/2018');
        $trackingItem->setValor(656.9);
        $tracking->setFaturamento(array($trackingItem));

        $lote = new Dominio\Lote();
        $lote->add($tracking);

        $result = $sender->atualizarPedidoNfEmitidaLote($lote);
        if ($result->isSuccess()) {
            echo 'OK' . PHP_EOL;
        } else {
            echo 'ERRO: ' . $result->getResponseString() . PHP_EOL;
        }
    }

}
