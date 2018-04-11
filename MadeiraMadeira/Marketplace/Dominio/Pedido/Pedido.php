<?php

namespace MadeiraMadeira\Marketplace\Dominio\Pedido;

use \MadeiraMadeira\Marketplace\Dominio;

/**
 * Description of Pedido
 *
 * @author Maicon Sasse
 */
class Pedido extends Dominio\AbstractModel
{

    const STATUS_NOVO = 1; // Pedido realizado pelo cliente, pagamento ainda não autorizado.
    const STATUS_APROVADO = 3; // Pedido com o pagamento autorizado.
    const STATUS_RECEBIDO = 2; // Pedido capturado pela loja.
    const STATUS_NF_EMITIDA = 6; // Pedido faturado/nota fiscal emitida pela loja.
    const STATUS_ENVIADO = 7; //Pedido enviado para o cliente.
    const STATUS_ENTREGUE = 8; //Pedido entregue ao cliente.
    const STATUS_CANCELADO_4 = 4; //Pedido cancelado.
    const STATUS_CANCELADO_5 = 5; //Pedido cancelado.

    protected $id_pedido;
    protected $id_seller;
    protected $pedido_wd;
    protected $comissao;
    protected $data_criacao;
    protected $datahora_aprovacao;
    protected $ultima_atualizacao;
    protected $status;

    /**
     * @var PedidoItem[]
     */
    protected $skus;

    /**
     * @var Comprador
     */
    protected $comprador;

    /**
     * @var DadosEntrega
     */
    protected $dados_entrega;

    /**
     * @var TrackingEntregue[]
     */
    protected $entrega;
    protected $subtotal;
    protected $frete;
    protected $total;

    /**
     * @var Pagamento[]
     */
    protected $pagamento;

    /**
     * @var TrackingFaturado[]
     */
    protected $faturamento;

    /**
     * @var TrackingEnvio[]
     */
    protected $envio;
    protected $pesquisa_satisfacao;
    protected $datahora_confirmacao;
    protected $datahora_cancelamento;
    protected $datahora_faturamento;
    protected $datahora_rastreamento;
    protected $data_previsao_entrega;
    protected $datahora_entrega;
    protected $pedido_mm;

    /**
     * Mapeamento de propriedades que sao objetos ou arrays
     * @var array
     */
    protected $_mapper = array(
        'skus' => PedidoItem::class,
        'comprador' => Comprador::class,
        'dados_entrega' => DadosEntrega::class,
        'pagamento' => Pagamento::class,
        'faturamento' => TrackingFaturado::class,
        'envio' => TrackingEnvio::class,
        'entrega' => TrackingEntregue::class
    );

    public function getIdPedido()
    {
        return $this->id_pedido;
    }

    public function setIdPedido($idPedido)
    {
        $this->id_pedido = $idPedido;
    }

    public function getIdSeller()
    {
        return $this->id_seller;
    }

    public function setIdSeller($idSeller)
    {
        $this->id_seller = $idSeller;
    }

    public function getPedidoWd()
    {
        return $this->pedido_wd;
    }

    public function setPedidoWd($pedidoWd)
    {
        $this->pedido_wd = $pedidoWd;
    }

    public function getComissao()
    {
        return $this->comissao;
    }

    public function setComissao($comissao)
    {
        $this->comissao = $comissao;
    }

    public function getDataCriacao()
    {
        return $this->data_criacao;
    }

    public function setDataCriacao($dataCriacao)
    {
        $this->data_criacao = $dataCriacao;
    }

    public function getDatahoraAprovacao()
    {
        return $this->datahora_aprovacao;
    }

    public function setDatahoraAprovacao($datahoraAprovacao)
    {
        $this->datahora_aprovacao = $datahoraAprovacao;
    }

    public function getUltimaAtualizacao()
    {
        return $this->ultima_atualizacao;
    }

    public function setUltimaAtualizacao($ultimaAtualizacao)
    {
        $this->ultima_atualizacao = $ultimaAtualizacao;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getStatusDescricao()
    {
        $lista = self::getStatusLista();
        if ($this->getStatus() && isset($lista[$this->getStatus()])) {
            return $lista[$this->getStatus()];
        }
        return $this->getStatus();
    }

    static public function getStatusLista()
    {
        return array(
            self::STATUS_NOVO => 'Novo',
            self::STATUS_APROVADO => 'Aprovado',
            self::STATUS_RECEBIDO => 'Recebido pelo lojista',
            self::STATUS_NF_EMITIDA => 'Faturado',
            self::STATUS_ENVIADO => 'Enviado',
            self::STATUS_ENTREGUE => 'Entregue',
            self::STATUS_CANCELADO_4 => 'Cancelado (4)',
            self::STATUS_CANCELADO_5 => 'Cancelado (5)'
        );
    }

    public function setStatus($status)
    {
        $this->status = $this->intValue($status);
    }

    public function getSkus()
    {
        return $this->skus;
    }

    public function setSkus(array $skus = null)
    {
        $this->skus = $skus;
    }

    public function getComprador()
    {
        return $this->comprador;
    }

    public function setComprador(Comprador $comprador = null)
    {
        $this->comprador = $comprador;
    }

    public function getDadosEntrega()
    {
        return $this->dados_entrega;
    }

    public function setDadosEntrega(DadosEntrega $dadosEntrega = null)
    {
        $this->dados_entrega = $dadosEntrega;
    }

    public function getEntrega()
    {
        return $this->entrega;
    }

    public function setEntrega($entrega)
    {
        $this->entrega = $entrega;
    }

    public function getSubtotal()
    {
        return $this->subtotal;
    }

    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;
    }

    public function getFrete()
    {
        return $this->frete;
    }

    public function setFrete($frete)
    {
        $this->frete = $frete;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function setTotal($total)
    {
        $this->total = $total;
    }

    public function getPagamento()
    {
        return $this->pagamento;
    }

    public function setPagamento($pagamento)
    {
        $this->pagamento = $pagamento;
    }

    public function getFaturamento()
    {
        return $this->faturamento;
    }

    public function setFaturamento($faturamento)
    {
        $this->faturamento = $faturamento;
    }

    public function getEnvio()
    {
        return $this->envio;
    }

    public function setEnvio($envio)
    {
        $this->envio = $envio;
    }

    public function getPesquisaSatisfacao()
    {
        return $this->pesquisa_satisfacao;
    }

    public function setPesquisaSatisfacao($pesquisaSatisfacao)
    {
        $this->pesquisa_satisfacao = $pesquisaSatisfacao;
    }

    public function getDatahoraConfirmacao()
    {
        return $this->datahora_confirmacao;
    }

    public function setDatahoraConfirmacao($datahoraConfirmacao)
    {
        $this->datahora_confirmacao = $datahoraConfirmacao;
    }

    public function getDatahoraCancelamento()
    {
        return $this->datahora_cancelamento;
    }

    public function setDatahoraCancelamento($datahoraCancelamento)
    {
        $this->datahora_cancelamento = $datahoraCancelamento;
    }

    public function getDatahoraFaturamento()
    {
        return $this->datahora_faturamento;
    }

    public function setDatahoraFaturamento($datahoraFaturamento)
    {
        $this->datahora_faturamento = $datahoraFaturamento;
    }

    public function getDatahoraRastreamento()
    {
        return $this->datahora_rastreamento;
    }

    public function setDatahoraRastreamento($datahoraRastreamento)
    {
        $this->datahora_rastreamento = $datahoraRastreamento;
    }

    public function getDataPrevisaoEntrega()
    {
        return $this->data_previsao_entrega;
    }

    public function setDataPrevisaoEntrega($dataPrevisaoEntrega)
    {
        $this->data_previsao_entrega = $dataPrevisaoEntrega;
    }

    public function getDatahoraEntrega()
    {
        return $this->datahora_entrega;
    }

    public function setDatahoraEntrega($datahoraEntrega)
    {
        $this->datahora_entrega = $datahoraEntrega;
    }

    public function getPedidoMm()
    {
        return $this->pedido_mm;
    }

    public function setPedidoMm($pedidoMm)
    {
        $this->pedido_mm = $pedidoMm;
    }

}
