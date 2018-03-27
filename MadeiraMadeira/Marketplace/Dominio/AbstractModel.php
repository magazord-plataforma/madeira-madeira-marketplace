<?php

namespace MadeiraMadeira\Marketplace\Dominio;

/**
 * Description of AbstractModel
 *
 * @author Maicon Sasse
 */
class AbstractModel
{

    /**
     * Codigo HTTP da resposta da requisição
     * @var integer
     */
    protected $_httpResponseCode;

    /**
     * Conteudo da resposta da requisição
     * @var string
     */
    protected $_responseString;

    /**
     * Formato valores data/hora
     * @var type
     */
    protected $_formatDateTime = 'Y-m-d H:i:s';

    /**
     * Formato valores data
     * @var type
     */
    protected $_formatDate = 'Y-m-d';

    /**
     * Mapeamento de propriedades que sao objetos ou arrays
     * Sobrescrito nos modelos onde é necessário
     * @var array
     */
    protected $_mapper = array();

    public function getHttpResponseCode()
    {
        return $this->_httpResponseCode;
    }

    public function setHttpResponseCode($httpResponseCode)
    {
        $this->_httpResponseCode = $httpResponseCode;
    }

    public function isSuccess()
    {
        return ($this->getHttpResponseCode() == 200 || $this->getHttpResponseCode() == 201 || $this->getHttpResponseCode() == 204);
    }

    public function isNotFound()
    {
        return ($this->getHttpResponseCode() == 404);
    }

    public function getResponseString()
    {
        return $this->_responseString;
    }

    public function getPrettyResponseString()
    {
        $encoded = ($this->getResponseString()) ? json_decode($this->getResponseString()) : null;
        if ($encoded) {
            $encoded = json_encode($encoded, JSON_PRETTY_PRINT);
        }
        return $encoded ? $encoded : $this->getResponseString();
    }

    public function setResponseString($responseString)
    {
        $this->_responseString = $responseString;
    }

    /**
     * Retorna o objeto em formato JSON
     */
    public function serialize()
    {
        $result = null;
        foreach ($this as $property => $value) {
            if ($property[0] == '_') { // Propriedades internas nossas
                continue;
            }
            if (($pos = strpos($property, '_')) !== false) {
                $getter = 'get' . str_replace(' ', '', ucwords(str_replace('_', ' ', $property)));
            } else {
                $getter = 'get' . strtoupper($property[0]) . substr($property, 1);
            }
            $value = $this->$getter();
            if ($value === null) { // Propriedades nulas não envia
                continue;
            } else if ($value instanceof AbstractModel) {
                $value = $value->serialize();
            } else if (is_array($value)) {
                $internal = array();
                foreach ($value as $subProperty => $subValue) {
                    if ($subValue instanceof AbstractModel) {
                        $internal[$subProperty] = $subValue->serialize();
                    } else {
                        $internal[$subProperty] = $subValue;
                    }
                }
                $value = $internal;
            }
            if ($result === null) {
                $result = new \stdClass();
            }
            $result->$property = $value;
        }
        return $result;
    }

    /**
     * Carrega o objeto a partir do json
     * @param mixed $json
     */
    public function unserialize($json)
    {
        $type = gettype($json);
        foreach ($this as $property => $value) {
            if ($property[0] == '_') { // Propriedades internas nossas
                continue;
            }
            if (($pos = strpos($property, '_')) !== false) {
                $setter = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $property)));
            } else {
                $setter = 'set' . strtoupper($property[0]) . substr($property, 1);
            }
            $valueSetter = null;
            if ($type == 'object' && isset($json->$property)) {
                $valueSetter = $json->$property;
            } else if ($type == 'array' && isset($json[$property])) {
                $valueSetter = $json[$property];
            }
            // Propriedades que são objetos
            if (isset($this->_mapper[$property])) {
                if ($valueSetter !== null) {
                    $isArray = (is_array($valueSetter) && (isset($valueSetter[0]) || $valueSetter === array()));
                    if ($isArray) {
                        $internalArray = array();
                        foreach ($valueSetter as $ind => $valueSub) {
                            $internal = new $this->_mapper[$property];
                            $internal->unserialize($valueSub);
                            $internalArray[$ind] = $internal;
                        }
                        $valueSetter = $internalArray;
                    } else {
                        $internal = new $this->_mapper[$property];
                        $internal->unserialize($valueSetter);
                        $valueSetter = $internal;
                    }
                }
            }
            $this->$setter($valueSetter);
        }
    }

    public function asString()
    {
        return json_encode($this->serialize());
    }

    public function __toString()
    {
        $result = $this->asString();
        return (is_string($result)) ? $result : '';
    }

    protected function boolValue($value)
    {
        if ($value !== null) {
            if ($value === 'false') {
                return false;
            } else {
                return ($value) ? true : false;
            }
        }
        return $value;
    }

    protected function intValue($value)
    {
        if ($value !== null) {
            return (int) $value;
        }
        return $value;
    }

    protected function floatValue($value)
    {
        if ($value !== null) {
            return (float) $value;
        }
        return $value;
    }

    protected function stringValue($value)
    {
        if ($value === '') {
            return null;
        } else if ($value !== null) {
            return (string) $value;
        }
        return $value;
    }

    /**
     * Converte a string de data em \DateTime
     * @param string Data no formato especificado
     * @return \DateTime
     */
    public function toDateTime($date)
    {
        if ($date) {
            if (strlen($date) == 10) {
                $date .= ' 00:00:00';
            }
            return \DateTime::createFromFormat($this->_formatDateTime, $date);
        }
        return null;
    }

    /**
     * Retorna a data/hora no formato de envio para o marketplace
     * @param \DateTime $date
     * @return string
     */
    public function toDateTimeString(\DateTime $date = null)
    {
        if ($date) {
            return $date->format($this->_formatDateTime);
        }
        return null;
    }

    /**
     * Retorna a data/hora no formato de envio para o marketplace
     * @param \DateTime $date
     * @return string
     */
    public function toDateString(\DateTime $date = null)
    {
        if ($date) {
            return $date->format($this->_formatDate);
        }
        return null;
    }

}
