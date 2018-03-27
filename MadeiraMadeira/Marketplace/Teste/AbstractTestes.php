<?php

namespace MadeiraMadeira\Marketplace\Teste;

/**
 * Description of AbstractTestes
 *
 * @author Maicon Sasse
 */
abstract class AbstractTestes
{

    protected $endpoint = \MadeiraMadeira\Marketplace\ProdutoSender::ENDPOINT_SANDBOX;
    protected $token;

    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    protected function getLogger()
    {
        $logger = function(\MadeiraMadeira\Marketplace\AbstractSender $sender) {
            echo '----------- ' . PHP_EOL;
            echo 'LOG ' . PHP_EOL;
            echo 'URL: ' . $sender->getUrl() . PHP_EOL;
            echo 'REQUEST: ' . $sender->getRequestString() . PHP_EOL;
            echo 'RESPONSE CODE: ' . ($sender->getResponse() ? $sender->getResponse()->getHttpResponseCode() : null) . PHP_EOL;
            echo 'RESPONSE: ' . $sender->getResponseString() . PHP_EOL;
            echo '----------- ' . PHP_EOL;
        };
        return $logger;
    }

}
