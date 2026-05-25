<?php

namespace MadeiraMadeira\Marketplace\Dominio;

class ErroLote extends AbstractModel
{

    protected $type;
    protected $sku;
    protected $title;
    protected $detail;
    protected $status;

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getSku()
    {
        return $this->sku;
    }

    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getDetail()
    {
        return $this->detail;
    }

    public function setDetail($detail)
    {
        $this->detail = $detail;
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
        $mensagem = '';
        if ($this->getTitle()) {
            $mensagem .= $this->getTitle() . PHP_EOL;
        }
        if ($this->getDetail()) {
            $mensagem .= $this->getDetail() . PHP_EOL;
        }
        return $mensagem;
    }

}