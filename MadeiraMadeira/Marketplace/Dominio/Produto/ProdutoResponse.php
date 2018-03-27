<?php

namespace MadeiraMadeira\Marketplace\Dominio\Produto;

/**
 * Description of ProdutoResponse
 *
 * @author Maicon Sasse
 */
class ProdutoResponse extends Produto
{

    // Status para produtos "Pendentes"
    const STATUS_A_PROCESSAR = 0;
    const STATUS_AGUARDANDO_APROVACAO = 1;
    const STATUS_DIVERGENCIA_INFORMACAO = 2;
    const STATUS_REPROVADO = 3;
    const STATUS_AGUARDANDO_CONFIRMACAO = 4;
    // Status para produtos "Publicados"
    const STATUS_INATIVO = 0;
    const STATUS_ATIVO = 1;

    protected $id_produto_fila;
    protected $id_seller;
    protected $status;
    protected $tipo_atualizacao;
    protected $historico_validacao;
    protected $datahora_criacao;
    protected $datahora_alteracao;
    protected $url;

    public function getIdProdutoFila()
    {
        return $this->id_produto_fila;
    }

    public function setIdProdutoFila($idProdutoFila)
    {
        $this->id_produto_fila = $idProdutoFila;
    }

    public function getIdSeller()
    {
        return $this->id_seller;
    }

    public function setIdSeller($idSeller)
    {
        $this->id_seller = $idSeller;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getTipoAtualizacao()
    {
        return $this->tipo_atualizacao;
    }

    public function setTipoAtualizacao($tipoAtualizacao)
    {
        $this->tipo_atualizacao = $tipoAtualizacao;
    }

    public function getHistoricoValidacao()
    {
        return $this->historico_validacao;
    }

    public function setHistoricoValidacao($historicoValidacao)
    {
        $this->historico_validacao = $historicoValidacao;
    }

    public function getDatahoraCriacao()
    {
        return $this->datahora_criacao;
    }

    public function setDatahoraCriacao($datahoraCriacao)
    {
        $this->datahora_criacao = $datahoraCriacao;
    }

    public function getDatahoraAlteracao()
    {
        return $this->datahora_alteracao;
    }

    public function setDatahoraAlteracao($datahoraAlteracao)
    {
        $this->datahora_alteracao = $datahoraAlteracao;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

}
