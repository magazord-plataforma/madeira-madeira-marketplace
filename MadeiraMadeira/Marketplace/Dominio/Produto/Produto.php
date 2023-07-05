<?php

namespace MadeiraMadeira\Marketplace\Dominio\Produto;

use \MadeiraMadeira\Marketplace\Dominio;

/**
 * Description of Produto
 *
 * @author Maicon Sasse
 */
class Produto extends Dominio\AbstractModel
{

    /**
     * SKU do produto definido pelo seller
     * @var string
     */
    protected $sku;

    /**
     * Nome do produto
     * @var string
     */
    protected $nome;

    /**
     * Descrição do produto que será exibida no site.
     * Não deve conter mais de 1000 caracteres.
     * Lembrando que caracteres especiais contam como 2 caracteres. (á,é,í,ó,ú,etc)
     * @var string
     */
    protected $descricao;

    /**
     * ID do de-para de categoria, consultar rota /categoria
     * @var int
     */
    protected $id_categoria;

    /**
     * EAN do produto
     * @var string
     */
    protected $ean;

    /**
     * Marca do produto
     * @var string
     */
    protected $marca;

    /**
     * Preço original do produto
     * @var float
     */
    protected $preco_de;

    /**
     * Preço do produto com desconto (preço de venda)
     * @var float
     */
    protected $preco_por;

    /**
     * Estoque disponível do produto
     * @var int
     */
    protected $estoque;

    /**
     * Altura do produto (em centímetros)
     * @var float
     */
    protected $altura;

    /**
     * Largura do produto (em centímetros)
     * @var float
     */
    protected $largura;

    /**
     * Profundidade/Comprimento do produto (em centímetros)
     * @var float
     */
    protected $profundidade;

    /**
     * Peso do produto (em kg)
     * @var float
     */
    protected $peso;

    /**
     * Lista de imagens do produto
     * @var array
     */
    protected $imagens;

    /**
     * Link para vídeo do produto no youtube
     * @var string
     */
    protected $video;

    /**
     * Lista de atributos do produto.
     * @var Atributo[]
     */
    protected $atributos;

    /**
     * Tipo de entrega definido previamente na tabela de frete
     * @var string
     */
    protected $tipo_entrega;
    
    protected $prazo_expedicao;

    /**
     * Mapeamento de propriedades que sao objetos ou arrays
     * @var array
     */
    protected $_mapper = array(
        'atributos' => Atributo::class
    );

    public function getSku()
    {
        return $this->sku;
    }

    public function setSku($sku)
    {
        $this->sku = $this->stringValue($sku);
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function getIdCategoria()
    {
        return $this->id_categoria;
    }

    public function setIdCategoria($idCategoria)
    {
        $this->id_categoria = $this->intValue($idCategoria);
    }

    public function getEan()
    {
        return $this->ean;
    }

    public function setEan($ean)
    {
        $this->ean = $this->stringValue($ean);
    }

    public function getMarca()
    {
        return $this->marca;
    }

    public function setMarca($marca)
    {
        $this->marca = $marca;
    }

    public function getPrecoDe()
    {
        return $this->preco_de;
    }

    public function setPrecoDe($precoDe)
    {
        $this->preco_de = $this->floatValue($precoDe);
    }

    public function getPrecoPor()
    {
        return $this->preco_por;
    }

    public function setPrecoPor($precoPor)
    {
        $this->preco_por = $this->floatValue($precoPor);
    }

    public function getEstoque()
    {
        return $this->estoque;
    }

    public function setEstoque($estoque)
    {
        $this->estoque = $this->intValue($estoque);
    }

    public function getAltura()
    {
        return $this->altura;
    }

    public function setAltura($altura)
    {
        $this->altura = $this->floatValue($altura);
    }

    public function getLargura()
    {
        return $this->largura;
    }

    public function setLargura($largura)
    {
        $this->largura = $this->floatValue($largura);
    }

    public function getProfundidade()
    {
        return $this->profundidade;
    }

    public function setProfundidade($profundidade)
    {
        $this->profundidade = $this->floatValue($profundidade);
    }

    public function getPeso()
    {
        return $this->peso;
    }

    public function setPeso($peso)
    {
        $this->peso = $this->floatValue($peso);
    }

    public function getImagens()
    {
        return $this->imagens;
    }

    public function setImagens(array $imagens = null)
    {
        $this->imagens = $imagens;
    }

    public function addImagem($url)
    {
        $imagens = $this->getImagens() ? $this->getImagens() : array();
        $imagens[] = $url;
        $this->setImagens($imagens);
    }

    public function getVideo()
    {
        return $this->video;
    }

    public function setVideo($video)
    {
        $this->video = $video;
    }

    /**
     * @return Atributo[]
     */
    public function getAtributos()
    {
        return $this->atributos;
    }

    public function setAtributos(array $atributos = null)
    {
        $this->atributos = $atributos;
    }

    public function addAtributo($nome, $valor)
    {
        $atributos = $this->getAtributos() ? $this->getAtributos() : array();
        $atributo = new Atributo();
        $atributo->setNome($nome);
        $atributo->setValor($valor);
        $atributos[] = $atributo;
        $this->setAtributos($atributos);
    }

    public function getTipoEntrega()
    {
        return $this->tipo_entrega;
    }

    public function setTipoEntrega($tipoEntrega)
    {
        $this->tipo_entrega = $tipoEntrega;
    }
    
    public function getPrazoExpedicao()
    {
        return $this->prazo_expedicao;
    }

    public function setPrazoExpedicao($prazoExpedicao)
    {
        $this->prazo_expedicao = $prazoExpedicao;
    }

}
