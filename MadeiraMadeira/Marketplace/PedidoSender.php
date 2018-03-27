<?php

namespace MadeiraMadeira\Marketplace;

/**
 * Description of PedidoSender
 *
 * @author Maicon Sasse
 */
class PedidoSender extends AbstractSender
{

    /**
     * Lista de todos os pedidos
     * @param Dominio\ListFilter $filtro
     * @return Dominio\Pedido\PedidoListResponse
     */
    public function consultarPedido(Dominio\ListFilter $filtro)
    {
        $this->reset();
        $this->setMethod(self::METHOD_GET);
        $this->setSuccessResponseClass(Dominio\Pedido\PedidoListResponse::class);
        return $this->send('/pedido/limit=' . $filtro->getLimit() . '&offset=' . $filtro->getOffset());
    }

    /**
     * Consulta de pedidos, com redirecionamento conforme o filtro
     * @param Dominio\Pedido\PedidoListFilter $filtro
     * @return Dominio\Pedido\PedidoListResponse
     */
    public function consultarPedidoV2(Dominio\Pedido\PedidoListFilter $filtro)
    {
        if ($filtro->getIdPedido()) {
            return $this->consultarPedidoPorId($filtro->getIdPedido());
        } else if ($filtro->getStatus()) {
            if ($filtro->getStatus() == Dominio\Pedido\Pedido::STATUS_NOVO) {
                return $this->consultarPedidoNovo($filtro);
            } else if ($filtro->getStatus() == Dominio\Pedido\Pedido::STATUS_APROVADO) {
                return $this->consultarPedidoAprovado($filtro);
            } else if ($filtro->getStatus() == Dominio\Pedido\Pedido::STATUS_RECEBIDO) {
                return $this->consultarPedidoRecebido($filtro);
            } else if ($filtro->getStatus() == Dominio\Pedido\Pedido::STATUS_NF_EMITIDA) {
                return $this->consultarPedidoNfEmitida($filtro);
            } else if ($filtro->getStatus() == Dominio\Pedido\Pedido::STATUS_ENVIADO) {
                return $this->consultarPedidoEnviado($filtro);
            } else if ($filtro->getStatus() == Dominio\Pedido\Pedido::STATUS_ENTREGUE) {
                return $this->consultarPedidoEntregue($filtro);
            } else if ($filtro->getStatus() == Dominio\Pedido\Pedido::STATUS_CANCELADO_4 || $filtro->getStatus() == Dominio\Pedido\Pedido::STATUS_CANCELADO_5) {
                return $this->consultarPedidoCancelado($filtro);
            }
        }
        // Consulta geral
        return $this->consultarPedido($filtro);
    }

    /**
     * Consulta pedido por ID
     * @param string $id
     * @return Dominio\Pedido\PedidoListResponse
     */
    public function consultarPedidoPorId($id)
    {
        $this->reset();
        $this->setMethod(self::METHOD_GET);
        $this->setSuccessResponseClass(Dominio\Pedido\PedidoListResponse::class);
        return $this->send('/pedido/id/' . $id);
    }

    /**
     * Lista todos os pedidos entre datas
     * @param string $de
     * @param string $ate
     * @param Dominio\ListFilter $filtro
     * @return Dominio\Pedido\PedidoListResponse
     */
    public function consultarPedidoPorData($de, $ate, Dominio\ListFilter $filtro)
    {
        $this->reset();
        $this->setMethod(self::METHOD_GET);
        $this->setSuccessResponseClass(Dominio\Pedido\PedidoListResponse::class);
        return $this->send('/pedido/from=' . urlencode($de) . '&to=' . urlencode($ate) . '&limit=' . $filtro->getLimit() . '&offset=' . $filtro->getOffset());
    }

    /**
     * Consulta lista de pedidos novos
     * @param Dominio\ListFilter $filtro
     * @return Dominio\Pedido\PedidoListResponse
     */
    public function consultarPedidoNovo(Dominio\ListFilter $filtro)
    {
        $this->reset();
        $this->setMethod(self::METHOD_GET);
        $this->setSuccessResponseClass(Dominio\Pedido\PedidoListResponse::class);
        return $this->send('/pedido/new/limit=' . $filtro->getLimit() . '&offset=' . $filtro->getOffset());
    }

    /**
     * Consulta lista de pedidos aprovados
     * @param Dominio\ListFilter $filtro
     * @return Dominio\Pedido\PedidoListResponse
     */
    public function consultarPedidoAprovado(Dominio\ListFilter $filtro)
    {
        $this->reset();
        $this->setMethod(self::METHOD_GET);
        $this->setSuccessResponseClass(Dominio\Pedido\PedidoListResponse::class);
        return $this->send('/pedido/approved/limit=' . $filtro->getLimit() . '&offset=' . $filtro->getOffset());
    }

    /**
     * Consulta lista de pedidos recebidos
     * @param Dominio\ListFilter $filtro
     * @return Dominio\Pedido\PedidoListResponse
     */
    public function consultarPedidoRecebido(Dominio\ListFilter $filtro)
    {
        $this->reset();
        $this->setMethod(self::METHOD_GET);
        $this->setSuccessResponseClass(Dominio\Pedido\PedidoListResponse::class);
        return $this->send('/pedido/received/limit=' . $filtro->getLimit() . '&offset=' . $filtro->getOffset());
    }

    /**
     * Notifica que vários pedidos foram recebidos
     * @param Dominio\Lote $lote
     * @return Dominio\LoteResponse
     */
    public function atualizarPedidoRecebidoLote(Dominio\Lote $lote)
    {
        $this->reset();
        $this->setMethod(self::METHOD_PUT);
        $this->setSuccessResponseClass(Dominio\LoteResponse::class);
        $this->setErrorResponseClass(Dominio\LoteResponse::class);
        return $this->send('/pedido/received', $lote);
    }

    /**
     * Consulta lista de pedidos com NF emitida
     * @param Dominio\ListFilter $filtro
     * @return Dominio\Pedido\PedidoListResponse
     */
    public function consultarPedidoNfEmitida(Dominio\ListFilter $filtro)
    {
        $this->reset();
        $this->setMethod(self::METHOD_GET);
        $this->setSuccessResponseClass(Dominio\Pedido\PedidoListResponse::class);
        return $this->send('/pedido/invoiced/limit=' . $filtro->getLimit() . '&offset=' . $filtro->getOffset());
    }

    /**
     * Notifica que vários pedidos tiveram nota fiscal emitida
     * @param Dominio\Lote $lote
     * @return Dominio\LoteResponse
     */
    public function atualizarPedidoNfEmitidaLote(Dominio\Lote $lote)
    {
        $this->reset();
        $this->setMethod(self::METHOD_PUT);
        $this->setSuccessResponseClass(Dominio\LoteResponse::class);
        $this->setErrorResponseClass(Dominio\LoteResponse::class);
        return $this->send('/pedido/invoiced', $lote);
    }

    /**
     * Consulta lista de pedidos enviados
     * @param Dominio\ListFilter $filtro
     * @return Dominio\Pedido\PedidoListResponse
     */
    public function consultarPedidoEnviado(Dominio\ListFilter $filtro)
    {
        $this->reset();
        $this->setMethod(self::METHOD_GET);
        $this->setSuccessResponseClass(Dominio\Pedido\PedidoListResponse::class);
        return $this->send('/pedido/shipped/limit=' . $filtro->getLimit() . '&offset=' . $filtro->getOffset());
    }

    /**
     * Notifica que vários pedidos foram enviados
     * @param Dominio\Lote $lote
     * @return Dominio\LoteResponse
     */
    public function atualizarPedidoEnviadoLote(Dominio\Lote $lote)
    {
        $this->reset();
        $this->setMethod(self::METHOD_PUT);
        $this->setSuccessResponseClass(Dominio\LoteResponse::class);
        $this->setErrorResponseClass(Dominio\LoteResponse::class);
        return $this->send('/pedido/shipped', $lote);
    }

    /**
     * Consulta lista de pedidos entregues
     * @param Dominio\ListFilter $filtro
     * @return Dominio\Pedido\PedidoListResponse
     */
    public function consultarPedidoEntregue(Dominio\ListFilter $filtro)
    {
        $this->reset();
        $this->setMethod(self::METHOD_GET);
        $this->setSuccessResponseClass(Dominio\Pedido\PedidoListResponse::class);
        return $this->send('/pedido/delivered/limit=' . $filtro->getLimit() . '&offset=' . $filtro->getOffset());
    }

    /**
     * Notifica que vários pedidos foram entregues
     * @param Dominio\Lote $lote
     * @return Dominio\LoteResponse
     */
    public function atualizarPedidoEntregueLote(Dominio\Lote $lote)
    {
        $this->reset();
        $this->setMethod(self::METHOD_PUT);
        $this->setSuccessResponseClass(Dominio\LoteResponse::class);
        $this->setErrorResponseClass(Dominio\LoteResponse::class);
        return $this->send('/pedido/delivered', $lote);
    }

    /**
     * Consulta lista de pedidos cancelados
     * @param Dominio\ListFilter $filtro
     * @return Dominio\Pedido\PedidoListResponse
     */
    public function consultarPedidoCancelado(Dominio\ListFilter $filtro)
    {
        $this->reset();
        $this->setMethod(self::METHOD_GET);
        $this->setSuccessResponseClass(Dominio\Pedido\PedidoListResponse::class);
        return $this->send('/pedido/cancelled/limit=' . $filtro->getLimit() . '&offset=' . $filtro->getOffset());
    }

}
