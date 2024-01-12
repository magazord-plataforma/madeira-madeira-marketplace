<?php

namespace MadeiraMadeira\Marketplace\Dominio\Envios;

use \MadeiraMadeira\Marketplace\Dominio;

/**
 * Description of EtiquetaResponse
 *
 * @author Maicon Sasse
 */
class EtiquetaResponse extends Dominio\AbstractModel
{

    protected $success;
    protected $message;
    protected $status;

    public function getSuccess()
    {
        return $this->success;
    }

    public function setSuccess($success)
    {
        $this->success = $success;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }
    
    public function asString()
    {
        return $this->getMessage();
    }    

}
