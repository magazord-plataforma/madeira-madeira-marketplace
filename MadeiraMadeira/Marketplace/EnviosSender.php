<?php

namespace MadeiraMadeira\Marketplace;

/**
 * Description of EnviosSender
 *
 * @author Maicon Sasse
 */
class EnviosSender extends AbstractSender
{

    /**
     * @param Dominio\Envios\EtiquetaSolicitacao $lote
     * @return Dominio\Envios\EtiquetaResponse
     */
    public function solicitarEtiqueta(Dominio\Envios\EtiquetaSolicitacao $lote)
    {
        $this->reset();
        $this->setMethod(self::METHOD_POST);
        $this->setSuccessResponseClass(Dominio\Envios\EtiquetaResponse::class);
        $this->setErrorResponseClass(Dominio\Envios\EtiquetaResponse::class);
        return $this->send('/madeiraenvios/etiquetas', $lote);
    }

    /**
     * @param string $sro
     * @return Dominio\Envios\EtiquetaResponse
     */
    public function consultaEtiquetaSRO($sro)
    {
        $this->reset();
        $this->setMethod(self::METHOD_GET);
        $this->setSuccessResponseClass(Dominio\Envios\EtiquetaResponse::class);
        $this->setErrorResponseClass(Dominio\Envios\EtiquetaResponse::class);
        return $this->send('/madeiraenvios/etiquetas/' . $sro . '/arquivo');
    }

}
