<?php

namespace MadeiraMadeira\Marketplace\Dominio\Categoria;

use \MadeiraMadeira\Marketplace\Dominio;

/**
 * Description of Categoria
 *
 * @author Maicon Sasse
 */
class Categoria extends Dominio\AbstractModel
{

    protected $id_categoria;
    protected $id_nivel_1;
    protected $nivel_1;
    protected $id_nivel_2;
    protected $nivel_2;
    protected $id_nivel_3;
    protected $nivel_3;
    protected $id_nivel_4;
    protected $nivel_4;
    protected $id_nivel_5;
    protected $nivel_5;
    protected $id_nivel_6;
    protected $nivel_6;
    protected $id_nivel_7;
    protected $nivel_7;
    protected $comissionamento;

    public function getIdCategoria()
    {
        return $this->id_categoria;
    }

    public function setIdCategoria($idCategoria)
    {
        $this->id_categoria = $idCategoria;
    }

    public function getIdNivel1()
    {
        return $this->id_nivel_1;
    }

    public function setIdNivel1($idNivel1)
    {
        $this->id_nivel_1 = $idNivel1;
    }

    public function getNivel1()
    {
        return $this->nivel_1;
    }

    public function getDescricao()
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

    public function setNivel1($nivel1)
    {
        $this->nivel_1 = $nivel1;
    }

    public function getIdNivel2()
    {
        return $this->id_nivel_2;
    }

    public function setIdNivel2($idNivel2)
    {
        $this->id_nivel_2 = $idNivel2;
    }

    public function getNivel2()
    {
        return $this->nivel_2;
    }

    public function setNivel2($nivel2)
    {
        $this->nivel_2 = $nivel2;
    }

    public function getIdNivel3()
    {
        return $this->id_nivel_3;
    }

    public function setIdNivel3($idNivel3)
    {
        $this->id_nivel_3 = $idNivel3;
    }

    public function getNivel3()
    {
        return $this->nivel_3;
    }

    public function setNivel3($nivel3)
    {
        $this->nivel_3 = $nivel3;
    }

    public function getIdNivel4()
    {
        return $this->id_nivel_4;
    }

    public function setIdNivel4($idNivel4)
    {
        $this->id_nivel_4 = $idNivel4;
    }

    public function getNivel4()
    {
        return $this->nivel_4;
    }

    public function setNivel4($nivel4)
    {
        $this->nivel_4 = $nivel4;
    }

    public function getIdNivel5()
    {
        return $this->id_nivel_5;
    }

    public function setIdNivel5($idNivel5)
    {
        $this->id_nivel_5 = $idNivel5;
    }

    public function getNivel5()
    {
        return $this->nivel_5;
    }

    public function setNivel5($nivel5)
    {
        $this->nivel_5 = $nivel5;
    }

    public function getIdNivel6()
    {
        return $this->id_nivel_6;
    }

    public function setIdNivel6($idNivel6)
    {
        $this->id_nivel_6 = $idNivel6;
    }

    public function getNivel6()
    {
        return $this->nivel_6;
    }

    public function setNivel6($nivel6)
    {
        $this->nivel_6 = $nivel6;
    }

    public function getIdNivel7()
    {
        return $this->id_nivel_7;
    }

    public function setIdNivel7($idNivel7)
    {
        $this->id_nivel_7 = $idNivel7;
    }

    public function getNivel7()
    {
        return $this->nivel_7;
    }

    public function setNivel7($nivel7)
    {
        $this->nivel_7 = $nivel7;
    }

    public function getComissionamento()
    {
        return $this->comissionamento;
    }

    public function setComissionamento($comissionamento)
    {
        $this->comissionamento = $comissionamento;
    }

}
