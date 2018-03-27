<?php

namespace MadeiraMadeira\Marketplace\Dominio\Produto;

use \MadeiraMadeira\Marketplace\Dominio;

/**
 * Description of ProdutoListFilter
 *
 * @author Maicon Sasse
 */
class ProdutoListFilter extends Dominio\ListFilter
{

    const TIPO_CONSULTA_PUBLICADO = '/situacao/publicados';
    const TIPO_CONSULTA_PENDENTE_GERAL = '/situacao/pendentes';
    const TIPO_CONSULTA_A_PROCESSAR = '/aprocessar';
    const TIPO_CONSULTA_REPROVADO = '/reprovado';
    const TIPO_CONSULTA_DIVERGENTE = '/divergente';
    const TIPO_CONSULTA_A_CONFIRMAR = '/aconfirmar';
    const TIPO_CONSULTA_AGUARDANDO_APROVACAO = '/aguardando';

    protected $_sku;
    protected $_tipoConsulta = self::TIPO_CONSULTA_PUBLICADO;

    public function getSku()
    {
        return $this->_sku;
    }

    public function getTipoConsulta()
    {
        return $this->_tipoConsulta;
    }

    static public function getTipoConsultaLista()
    {
        return array(
            self::TIPO_CONSULTA_PUBLICADO => 'Publicado',
            self::TIPO_CONSULTA_PENDENTE_GERAL => 'Pendentes (Geral)',
            self::TIPO_CONSULTA_A_PROCESSAR => 'Aguardando Processamento',
            self::TIPO_CONSULTA_REPROVADO => 'Reprovado',
            self::TIPO_CONSULTA_DIVERGENTE => 'Com divergência de match',
            self::TIPO_CONSULTA_A_CONFIRMAR => 'A Confirmar (Processados)',
            self::TIPO_CONSULTA_AGUARDANDO_APROVACAO => 'Aguardando Aprovação'
        );
    }

    public function setSku($sku)
    {
        $this->_sku = $sku;
    }

    public function setTipoConsulta($tipoConsulta)
    {
        $this->_tipoConsulta = $tipoConsulta;
    }

}
