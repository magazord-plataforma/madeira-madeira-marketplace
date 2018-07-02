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
    protected $nivel_1;
    protected $nivel_2;
    protected $nivel_3;
    protected $nivel_4;
    protected $nivel_5;
    protected $nivel_6;
    protected $nivel_7;
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

    public function getNivel1()
    {
        return $this->nivel_1;
    }

    public function setNivel1($nivel1)
    {
        $this->nivel_1 = $nivel1;
    }

    public function getNivel2()
    {
        return $this->nivel_2;
    }

    public function setNivel2($nivel2)
    {
        $this->nivel_2 = $nivel2;
    }

    public function getNivel3()
    {
        return $this->nivel_3;
    }

    public function setNivel3($nivel3)
    {
        $this->nivel_3 = $nivel3;
    }

    public function getNivel4()
    {
        return $this->nivel_4;
    }

    public function setNivel4($nivel4)
    {
        $this->nivel_4 = $nivel4;
    }

    public function getNivel5()
    {
        return $this->nivel_5;
    }

    public function setNivel5($nivel5)
    {
        $this->nivel_5 = $nivel5;
    }

    public function getNivel6()
    {
        return $this->nivel_6;
    }

    public function setNivel6($nivel6)
    {
        $this->nivel_6 = $nivel6;
    }

    public function getNivel7()
    {
        return $this->nivel_7;
    }

    public function setNivel7($nivel7)
    {
        $this->nivel_7 = $nivel7;
    }

    public function getDescricaoCategoria()
    {
        $descricao = array();
        if ($this->getNivel7()) {
            $descricao[] = $this->getNivel7();
        }
        if ($this->getNivel6()) {
            $descricao[] = $this->getNivel6();
        }
        if ($this->getNivel5()) {
            $descricao[] = $this->getNivel5();
        }
        if ($this->getNivel4()) {
            $descricao[] = $this->getNivel4();
        }
        if ($this->getNivel3()) {
            $descricao[] = $this->getNivel3();
        }
        if ($this->getNivel2()) {
            $descricao[] = $this->getNivel2();
        }
        if ($this->getNivel1()) {
            $descricao[] = $this->getNivel1();
        }
        return implode(' < ', $descricao);
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
