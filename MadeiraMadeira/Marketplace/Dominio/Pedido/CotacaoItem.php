<?php

namespace MadeiraMadeira\Marketplace\Dominio\Pedido;

use \MadeiraMadeira\Marketplace\Dominio;

/**
 * Description of CotacaoItem
 *
 * @author Maicon Sasse
 */
class CotacaoItem extends Dominio\AbstractModel
{

    protected $sku;
    protected $id_cotacao;
    protected $metodo_transporte_id;
    protected $metodo_transporte;
    protected $metodo_transporte_display;
    protected $estivativa_transporte_id;

    public function getSku()
    {
        return $this->sku;
    }

    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    public function getIdCotacao()
    {
        return $this->id_cotacao;
    }

    public function setIdCotacao($idCotacao)
    {
        $this->id_cotacao = $idCotacao;
    }

    public function getMetodoTransporteId()
    {
        return $this->metodo_transporte_id;
    }

    public function setMetodoTransporteId($metodoTransporteId)
    {
        $this->metodo_transporte_id = $metodoTransporteId;
    }

    public function getMetodoTransporte()
    {
        return $this->metodo_transporte;
    }

    public function setMetodoTransporte($metodoTransporte)
    {
        $this->metodo_transporte = $metodoTransporte;
    }

    public function getMetodoTransporteDisplay()
    {
        return $this->metodo_transporte_display;
    }

    public function setMetodoTransporteDisplay($metodoTransporteDisplay)
    {
        $this->metodo_transporte_display = $metodoTransporteDisplay;
    }

    public function getEstivativaTransporteId()
    {
        return $this->estivativa_transporte_id;
    }

    public function setEstivativaTransporteId($estivativaTransporteId)
    {
        $this->estivativa_transporte_id = $estivativaTransporteId;
    }

}
