<?php

namespace MadeiraMadeira\Marketplace;

/**
 * Description of ProdutoSender
 *
 * @author Maicon Sasse
 */
class ProdutoSender extends CategoriaSender
{

    /**
     * Envia um ou mais produtos
     * @param Dominio\Lote $lote
     * @return Dominio\LoteResponse
     */
    public function enviarProdutoLote(Dominio\Lote $lote)
    {
        $this->reset();
        $this->setMethod(self::METHOD_POST);
        $this->setSuccessResponseClass(Dominio\LoteResponse::class);
        $this->setErrorResponseClass(Dominio\LoteResponse::class);
        return $this->send('/produto', $lote);
    }

    /**
     * Atualiza produtos Pendentes para processamento
     * @param Dominio\Lote $lote
     * @return Dominio\LoteResponse
     */
    public function atualizarProdutoLote(Dominio\Lote $lote)
    {
        $this->reset();
        $this->setMethod(self::METHOD_PUT);
        $this->setSuccessResponseClass(Dominio\LoteResponse::class);
        $this->setErrorResponseClass(Dominio\LoteResponse::class);
        return $this->send('/produto', $lote);
    }

    /**
     * Apaga um produto pendente
     * @param string $sku
     * @return Dominio\AbstractModel
     */
    public function deletarProduto($sku)
    {
        $this->reset();
        $this->setMethod(self::METHOD_DELETE);
        $this->setSuccessResponseClass(Dominio\AbstractModel::class);
        return $this->send('/produto/' . $sku);
    }

    /**
     * Busca de produtos com limit e offset
     * @param Dominio\ListFilter $filtro
     * @return Dominio\Produto\ProdutoListResponse
     */
    public function consultarProduto(Dominio\ListFilter $filtro)
    {
        $this->reset();
        $this->setMethod(self::METHOD_GET);
        $this->setSuccessResponseClass(Dominio\Produto\ProdutoListResponse::class);
        return $this->send('/produto/limit=' . $filtro->getLimit() . '&offset=' . $filtro->getOffset());
    }

    /**
     * Consulta de produtos, com redirecionamento conforme o filtro
     * @param Dominio\Produto\ProdutoListFilter $filtro
     * @return Dominio\Produto\ProdutoListResponse
     */
    public function consultarProdutoV2(Dominio\Produto\ProdutoListFilter $filtro)
    {
        if (($filtro->getTipoConsulta() == Dominio\Produto\ProdutoListFilter::TIPO_CONSULTA_PUBLICADO || !$filtro->getTipoConsulta()) && $filtro->getSku()) {
            return $this->consultarProdutoPorSku($filtro->getSku());
        } else if ($filtro->getTipoConsulta() == Dominio\Produto\ProdutoListFilter::TIPO_CONSULTA_PUBLICADO) {
            return $this->consultarPublicados($filtro);
        } else if (($filtro->getTipoConsulta() == Dominio\Produto\ProdutoListFilter::TIPO_CONSULTA_PENDENTE_GERAL) && $filtro->getSku()) {
            return $this->consultarProdutoPorSku($filtro->getSku()); // Não tem filtro de SKU para pendentes...
        } else if ($filtro->getTipoConsulta() == Dominio\Produto\ProdutoListFilter::TIPO_CONSULTA_PENDENTE_GERAL) {
            return $this->consultarPendentes($filtro);
        } else if (($filtro->getTipoConsulta() == Dominio\Produto\ProdutoListFilter::TIPO_CONSULTA_A_PROCESSAR) && $filtro->getSku()) {
            return $this->consultarAProcessarPorSku($filtro->getSku());
        } else if ($filtro->getTipoConsulta() == Dominio\Produto\ProdutoListFilter::TIPO_CONSULTA_A_PROCESSAR) {
            return $this->consultarAProcessar($filtro);
        } else if (($filtro->getTipoConsulta() == Dominio\Produto\ProdutoListFilter::TIPO_CONSULTA_REPROVADO) && $filtro->getSku()) {
            return $this->consultarReprovadoPorSku($filtro->getSku());
        } else if ($filtro->getTipoConsulta() == Dominio\Produto\ProdutoListFilter::TIPO_CONSULTA_REPROVADO) {
            return $this->consultarReprovado($filtro);
        } else if (($filtro->getTipoConsulta() == Dominio\Produto\ProdutoListFilter::TIPO_CONSULTA_DIVERGENTE) && $filtro->getSku()) {
            return $this->consultarDivergentePorSku($filtro->getSku());
        } else if ($filtro->getTipoConsulta() == Dominio\Produto\ProdutoListFilter::TIPO_CONSULTA_DIVERGENTE) {
            return $this->consultarDivergente($filtro);
        } else if (($filtro->getTipoConsulta() == Dominio\Produto\ProdutoListFilter::TIPO_CONSULTA_A_CONFIRMAR) && $filtro->getSku()) {
            return $this->consultarAConfirmarPorSku($filtro->getSku());
        } else if ($filtro->getTipoConsulta() == Dominio\Produto\ProdutoListFilter::TIPO_CONSULTA_A_CONFIRMAR) {
            return $this->consultarAConfirmar($filtro);
        } else if (($filtro->getTipoConsulta() == Dominio\Produto\ProdutoListFilter::TIPO_CONSULTA_AGUARDANDO_APROVACAO) && $filtro->getSku()) {
            return $this->consultarAguardandoPorSku($filtro->getSku());
        } else if ($filtro->getTipoConsulta() == Dominio\Produto\ProdutoListFilter::TIPO_CONSULTA_AGUARDANDO_APROVACAO) {
            return $this->consultarAguardando($filtro);
        }
    }

    /**
     * Busca um produto por sku
     * @param string $sku
     * @return Dominio\Produto\ProdutoListResponse
     */
    public function consultarProdutoPorSku($sku)
    {
        $this->reset();
        $this->setMethod(self::METHOD_GET);
        $this->setSuccessResponseClass(Dominio\Produto\ProdutoListResponse::class);
        return $this->send('/produto/' . $sku);
    }

    /**
     * Busca produtos por uma lista de sku
     * @param array $sku
     * @return Dominio\Produto\ProdutoListResponse
     */
    public function consultarProdutoPorSkus(array $sku)
    {
        $this->reset();
        $this->setMethod(self::METHOD_GET);
        $this->setSuccessResponseClass(Dominio\Produto\ProdutoListResponse::class);
        return $this->send('/produto/sku/skus=' . implode(',', $sku));
    }

    /**
     * Busca todos os produtos pendentes
     * @param Dominio\ListFilter $filtro
     * @return Dominio\Produto\ProdutoListResponse
     */
    public function consultarPendentes(Dominio\ListFilter $filtro)
    {
        $this->reset();
        $this->setMethod(self::METHOD_GET);
        $this->setSuccessResponseClass(Dominio\Produto\ProdutoListResponse::class);
        return $this->send('/produto/situacao/pendentes/limit=' . $filtro->getLimit() . '&offset=' . $filtro->getOffset());
    }

    /**
     * Busca todos os produtos pendentes
     * @param Dominio\ListFilter $filtro
     * @return Dominio\Produto\ProdutoListResponse
     */
    public function consultarPublicados(Dominio\ListFilter $filtro)
    {
        $this->reset();
        $this->setMethod(self::METHOD_GET);
        $this->setSuccessResponseClass(Dominio\Produto\ProdutoListResponse::class);
        return $this->send('/produto/situacao/publicados/limit=' . $filtro->getLimit() . '&offset=' . $filtro->getOffset());
    }

    /**
     * Busca produtos aguardando processamento com limmit e offset
     * @param Dominio\ListFilter $filtro
     * @return Dominio\Produto\ProdutoListResponse
     */
    public function consultarAProcessar(Dominio\ListFilter $filtro)
    {
        $this->reset();
        $this->setMethod(self::METHOD_GET);
        $this->setSuccessResponseClass(Dominio\Produto\ProdutoListResponse::class);
        return $this->send('/produto/aprocessar/limit=' . $filtro->getLimit() . '&offset=' . $filtro->getOffset());
    }

    /**
     * Busca um produto aguardando processamento pelo seu sku
     * @param string $sku
     * @return Dominio\Produto\ProdutoListResponse
     */
    public function consultarAProcessarPorSku($sku)
    {
        $this->reset();
        $this->setMethod(self::METHOD_GET);
        $this->setSuccessResponseClass(Dominio\Produto\ProdutoListResponse::class);
        return $this->send('/produto/aprocessar/' . $sku);
    }

    /**
     * Busca produtos reprovados com limmit e offset
     * @param Dominio\ListFilter $filtro
     * @return Dominio\Produto\ProdutoListResponse
     */
    public function consultarReprovado(Dominio\ListFilter $filtro)
    {
        $this->reset();
        $this->setMethod(self::METHOD_GET);
        $this->setSuccessResponseClass(Dominio\Produto\ProdutoListResponse::class);
        return $this->send('/produto/reprovado/limit=' . $filtro->getLimit() . '&offset=' . $filtro->getOffset());
    }

    /**
     * Busca um produto reprovado pelo seu sku
     * @param string $sku
     * @return Dominio\Produto\ProdutoListResponse
     */
    public function consultarReprovadoPorSku($sku)
    {
        $this->reset();
        $this->setMethod(self::METHOD_GET);
        $this->setSuccessResponseClass(Dominio\Produto\ProdutoListResponse::class);
        return $this->send('/produto/reprovado/' . $sku);
    }

    /**
     * Busca produtos com divergência de informações de match com limmit e offset
     * @param Dominio\ListFilter $filtro
     * @return Dominio\Produto\ProdutoListResponse
     */
    public function consultarDivergente(Dominio\ListFilter $filtro)
    {
        $this->reset();
        $this->setMethod(self::METHOD_GET);
        $this->setSuccessResponseClass(Dominio\Produto\ProdutoListResponse::class);
        return $this->send('/produto/divergente/limit=' . $filtro->getLimit() . '&offset=' . $filtro->getOffset());
    }

    /**
     * Busca um produto com divergência de informação de match pelo seu sku
     * @param string $sku
     * @return Dominio\Produto\ProdutoListResponse
     */
    public function consultarDivergentePorSku($sku)
    {
        $this->reset();
        $this->setMethod(self::METHOD_GET);
        $this->setSuccessResponseClass(Dominio\Produto\ProdutoListResponse::class);
        return $this->send('/produto/divergente/' . $sku);
    }

    /**
     * Busca produtos a serem confirmados com limmit e offset
     * @param Dominio\ListFilter $filtro
     * @return Dominio\Produto\ProdutoListResponse
     */
    public function consultarAConfirmar(Dominio\ListFilter $filtro)
    {
        $this->reset();
        $this->setMethod(self::METHOD_GET);
        $this->setSuccessResponseClass(Dominio\Produto\ProdutoListResponse::class);
        return $this->send('/produto/aconfirmar/limit=' . $filtro->getLimit() . '&offset=' . $filtro->getOffset());
    }

    /**
     * Busca um produto a ser confirmado pelo seu sku
     * @param string $sku
     * @return Dominio\Produto\ProdutoListResponse
     */
    public function consultarAConfirmarPorSku($sku)
    {
        $this->reset();
        $this->setMethod(self::METHOD_GET);
        $this->setSuccessResponseClass(Dominio\Produto\ProdutoListResponse::class);
        return $this->send('/produto/aconfirmar/' . $sku);
    }

    /**
     * Confirma um ou mais produtos
     * @param Dominio\Lote $lote
     * @return Dominio\LoteResponse
     */
    public function atualizarAConfirmar(Dominio\Lote $lote)
    {
        $this->reset();
        $this->setMethod(self::METHOD_PUT);
        $this->setSuccessResponseClass(Dominio\LoteResponse::class);
        $this->setErrorResponseClass(Dominio\LoteResponse::class);
        return $this->send('/produto/aconfirmar', $lote);
    }

    /**
     * Busca produtos aguardando aprovação com limmit e offset
     * @param Dominio\ListFilter $filtro
     * @return Dominio\Produto\ProdutoListResponse
     */
    public function consultarAguardando(Dominio\ListFilter $filtro)
    {
        $this->reset();
        $this->setMethod(self::METHOD_GET);
        $this->setSuccessResponseClass(Dominio\Produto\ProdutoListResponse::class);
        return $this->send('/produto/aguardando/limit=' . $filtro->getLimit() . '&offset=' . $filtro->getOffset());
    }

    /**
     * Busca um produto aguardando aprovação pelo seu sku
     * @param string $sku
     * @return Dominio\Produto\ProdutoListResponse
     */
    public function consultarAguardandoPorSku($sku)
    {
        $this->reset();
        $this->setMethod(self::METHOD_GET);
        $this->setSuccessResponseClass(Dominio\Produto\ProdutoListResponse::class);
        return $this->send('/produto/aguardando/' . $sku);
    }

    /**
     * Atualiza preço de um ou vários SKUs
     * @param Dominio\Lote $lote
     * @return Dominio\LoteResponse
     */
    public function atualizarPrecoProdutoLote(Dominio\Lote $lote)
    {
        $this->reset();
        $this->setMethod(self::METHOD_PUT);
        $this->setSuccessResponseClass(Dominio\LoteResponse::class);
        $this->setErrorResponseClass(Dominio\LoteResponse::class);
        return $this->send('/produto/preco', $lote);
    }

    /**
     * Consultar preço de sku
     * @param string $sku
     * @return Dominio\Produto\ProdutoListResponse
     */
    public function consultarPrecoProdutoPorSku($sku)
    {
        $this->reset();
        $this->setMethod(self::METHOD_GET);
        $this->setSuccessResponseClass(Dominio\Produto\ProdutoListResponse::class);
        return $this->send('/produto/preco/' . $sku);
    }

    /**
     * Atualiza estoque de um ou vários SKUs
     * @param Dominio\Lote $lote
     * @return Dominio\LoteResponse
     */
    public function atualizarEstoqueProdutoLote(Dominio\Lote $lote)
    {
        $this->reset();
        $this->setMethod(self::METHOD_PUT);
        $this->setSuccessResponseClass(Dominio\LoteResponse::class);
        $this->setErrorResponseClass(Dominio\LoteResponse::class);
        return $this->send('/produto/estoque', $lote);
    }

    /**
     * Consulta Estoque com limit e offset
     * @param Dominio\ListFilter $filtro
     * @return Dominio\Produto\ProdutoListResponse
     */
    public function consultarEstoqueProduto(Dominio\ListFilter $filtro)
    {
        $this->reset();
        $this->setMethod(self::METHOD_GET);
        $this->setSuccessResponseClass(Dominio\Produto\ProdutoListResponse::class);
        return $this->send('/produto/estoque/limit=' . $filtro->getLimit() . '&offset=' . $filtro->getOffset());
    }

    /**
     * Atualiza o status de um ou vários SKUs
     * @param Dominio\Lote $lote
     * @return Dominio\LoteResponse
     */
    public function atualizarStatusProdutoLote(Dominio\Lote $lote)
    {
        $this->reset();
        $this->setMethod(self::METHOD_PUT);
        $this->setSuccessResponseClass(Dominio\LoteResponse::class);
        $this->setErrorResponseClass(Dominio\LoteResponse::class);
        return $this->send('/produto/status', $lote);
    }

    /**
     * Informar tabela de frete por sku
     * @param Dominio\Lote $lote
     * @return Dominio\LoteResponse
     */
    public function atualizarFreteProdutoLote(Dominio\Lote $lote)
    {
        $this->reset();
        $this->setMethod(self::METHOD_PUT);
        $this->setSuccessResponseClass(Dominio\LoteResponse::class);
        $this->setErrorResponseClass(Dominio\LoteResponse::class);
        return $this->send('/produto/frete/sku', $lote);
    }

}
