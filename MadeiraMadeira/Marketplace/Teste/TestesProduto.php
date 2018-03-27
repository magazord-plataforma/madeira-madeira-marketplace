<?php

namespace MadeiraMadeira\Marketplace\Teste;

use \MadeiraMadeira\Marketplace\Dominio;

/**
 * Description of Produto
 *
 * @author Maicon Sasse
 */
class TestesProduto extends AbstractTestes
{

    /**
     * @var \MadeiraMadeira\Marketplace\ProdutoSender
     */
    protected $sender;

    protected function getSender()
    {
        if (!$this->sender) {
            $this->sender = new \MadeiraMadeira\Marketplace\ProdutoSender($this->endpoint, $this->token);
            // Função de Log (opcional)
            $this->sender->setLogger($this->getLogger());
        }
        return $this->sender;
    }

    public function consultaCategoria()
    {
        $sender = $this->getSender();
        $filtro = new Dominio\ListFilter();
        $filtro->setLimit(100);
        $filtro->setOffset(0);
        do {
            $repeat = false;
            $lista = $sender->consultarCategorias($filtro);
            if ($lista->isSuccess()) {
                $contPagina = 0;
                /* @var $categoria Dominio\Categoria\Categoria */
                foreach ($lista->getData() as $categoria) {
                    echo $categoria->getIdCategoria() . ' -> ' . $categoria->getDescricao() . PHP_EOL;
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

    public function enviarProdutos()
    {
        $produto = new Dominio\Produto\Produto();
        $produto->setSku('15586');
        $produto->setNome('Suporte de Parede Articulado ELG para TV de 50" a 60" F500 Preto');
        $produto->setDescricao('Suporte de Parede Articulado ELG para TV de 50" a 60" F500 Preto excelente para sua TV bla bla bla...');
        $produto->setIdCategoria('245'); // Suportes Para TV < Suportes < Ferragens
        $produto->setEan('7898378705916');
        $produto->setMarca('ELG');
        $produto->setPrecoDe(149.99);
        $produto->setPrecoPor(129);
        $produto->setEstoque(0);
        $produto->setAltura(44);
        $produto->setLargura(34);
        $produto->setProfundidade(87.5);
        $produto->setPeso(4.5);
        // Imagens
        $produto->addImagem('http://static-img.cissamagazine.com.br/img/2017/07/produto/51616/suporte-de-parede-elg-para-tv-de-50-a-60-f500-preto.jpg');
        // Atributos
        $produto->addAtributo('Cor', 'Preto');
        $produto->addAtributo('Suporte - Ajuste de Inclinação', '8° à -7°');
        $produto->addAtributo('Características - Material', 'Alumínio');
        $produto->addAtributo('Suporte - Aplicação', 'Parede');
        $produto->addAtributo('Suporte - Giro Horizontal', '180° (Esquerda / Direita - Limitado ao Tamanho da Tela da TV)');
        $produto->addAtributo('Suporte - Rotação de Tela', '3° à -3°');
        $produto->addAtributo('Características - Ajustável', 'Sim');
        $produto->addAtributo('Suporte - Regulagem de Altura', 'Sim');
        $produto->addAtributo('Suporte - Compatibilidade', 'TVs Plasma/3D/LCD/LED;');
        $produto->addAtributo('Suporte - Carga Máxima', 'Suporta Até 14 a 23 kg para Cada TV;');

        $lote = new Dominio\Lote();
        $lote->add($produto);
        $sender = $this->getSender();
        $envio = $sender->enviarProdutoLote($lote);
        if ($envio->isSuccess()) {
            echo 'Registros Enviado!' . PHP_EOL;
        } else {
            echo 'ERRO : ' . $envio->getResponseString() . PHP_EOL;
        }
    }

    public function confirmarProdutos()
    {
        $sender = $this->getSender();
        $filtro = new Dominio\ListFilter();
        $filtro->setLimit(100);
        $filtro->setOffset(0);
        do {
            $repeat = false;
            $lista = $sender->consultarAConfirmar($filtro);
            if ($lista->isSuccess()) {

                $lote = new Dominio\Lote();

                $contPagina = 0;
                /* @var $produto Dominio\Produto\ProdutoResponse */
                foreach ($lista->getData() as $produto) {
                    echo $produto->getSku() . PHP_EOL;
                    $contPagina++;
                    // Adicionar o SKU para confirmação
                    $itemLote = new Dominio\Produto\Produto();
                    $itemLote->setSku($produto->getSku());
                    $lote->add($itemLote);
                }

                // Confirmar o lote
                if (count($lote->getLista()) > 0) {

                    $confirmacao = $sender->atualizarAConfirmar($lote);
                    if ($confirmacao->isSuccess()) {
                        echo 'Registros confirmados!' . PHP_EOL;
                    } else {
                        echo 'ERRO CONFIRMACAO: ' . $lista . PHP_EOL;
                    }
                }

                if ($contPagina >= $filtro->getLimit()) {
                    $repeat = true;
                    // $filtro->setOffset($filtro->getOffset() + $filtro->getLimit());
                }
            } else {
                echo 'ERRO: ' . $lista->getResponseString() . PHP_EOL;
            }
        } while ($repeat);
    }

}
