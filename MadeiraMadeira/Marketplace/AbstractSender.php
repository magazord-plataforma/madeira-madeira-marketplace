<?php

namespace MadeiraMadeira\Marketplace;

/**
 * Description of AbstractSender
 *
 * @author Maicon Sasse
 */
abstract class AbstractSender
{

    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_DELETE = 'DELETE';
    const ENDPOINT_PROD = 'https://marketplace.madeiramadeira.com.br';
    const ENDPOINT_SANDBOX = 'https://war-machine-sandbox.madeiramadeira.com.br';

    /**
     * Url base da API
     * @var string
     */
    private $endpoint;

    /**
     * Versão da API
     * @var string
     */
    private $versao = '/v1';

    /**
     * Token de acesso
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $url;

    /**
     *
     * @var string
     */
    private $method;

    /**
     * Requisição (objeto)
     * @var Dominio\AbstractModel
     */
    private $request;

    /**
     * Requisição
     * @var string
     */
    private $requestString;

    /**
     * Modelo contendo a resposta decodificada
     * @var Dominio\AbstractModel
     */
    private $response;

    /**
     * Classe de Resposta em caso de sucesso
     * @var string
     */
    private $successResponseClass;

    /**
     * Classe de Resposta em caso de erro
     * @var string
     */
    private $errorResponseClass;

    /**
     * Resposta
     * @var string
     */
    private $responseString;

    /**
     * Resposta da classe \Httpful\Request
     * @var \Httpful\Response
     */
    private $responseHttp;

    /**
     * Funcão de log de requisições
     * @var \Closure
     */
    private $logger;

    public function __construct($endpoint, $token)
    {
        $this->setEndpoint($endpoint);
        $this->setToken($token);
    }

    public function getEndpoint()
    {
        return $this->endpoint;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function getVersao()
    {
        return $this->versao;
    }

    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    public function setToken($user)
    {
        $this->token = $user;
    }

    public function setVersao($versao)
    {
        $this->versao = $versao;
    }

    /**
     * @param string $path
     * @param Dominio\AbstractModel $body
     * @param array $params
     * @return Dominio\AbstractModel|Dominio\Error
     */
    protected function send($path, Dominio\AbstractModel $body = null, array $params = null)
    {
        $this->url = $this->getEndpoint() . $this->getVersao() . $path;
        $this->url .= ($params) ? '?' . http_build_query($params) : '';
        switch ($this->method) {
            case self::METHOD_GET:
                $http = \Httpful\Request::get($this->url);
                break;
            case self::METHOD_POST:
                $http = \Httpful\Request::post($this->url);
                break;
            case self::METHOD_PUT:
                $http = \Httpful\Request::put($this->url);
                break;
            case self::METHOD_DELETE:
                $http = \Httpful\Request::delete($this->url);
                break;
        }
        $http->addHeader('TOKENMM', $this->getToken());
        $http->auto_parse = false;
        if ($body) {
            $this->request = $body;
            $this->requestString = $body->asString();
            $http->body($this->requestString, 'application/json');
        }
        try {
            if ($this->responseHttp = $http->send()) {
                $this->processResponse();
            }
        } catch (\Exception $e) {
            $this->response = new Dominio\Erro();
            $this->response->setHttpResponseCode(0);
            $this->response->setResponseString($e->getMessage());
        }
        if ($this->logger) {
            call_user_func($this->logger, $this);
        }
        return $this->response;
    }

    protected function processResponse()
    {
        $this->responseString = $this->responseHttp->raw_body;
        if ($this->responseHttp->code >= 200 && $this->responseHttp->code <= 204) {
            $this->response = new $this->successResponseClass();
            $this->response->setHttpResponseCode($this->responseHttp->code);
        }
        // Consultas de listagem que não retornaram nenhum registro, retornamos como sucesso...
        else if (($this->responseHttp->code == 404) && (strpos($this->url, 'limit=') !== false)) {
            $this->response = new $this->successResponseClass();
            $this->response->setHttpResponseCode(200);
        } else {
            $this->response = new $this->errorResponseClass();
            $this->response->setHttpResponseCode($this->responseHttp->code);
        }
        $this->response->setResponseString($this->responseString);
        $responseData = null;
        if ($this->responseHttp->content_type == 'application/json' && $this->responseString) {
            if (($decoded = json_decode($this->responseString)) !== null) {
                $responseData = $decoded;
            }
        }
        if (!$responseData && $this->responseString) {
            $responseData = $this->responseString;
        }
        if ($responseData) {
            $this->response->unserialize($responseData);
        }
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getRequestString()
    {
        return $this->requestString;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function getResponseString()
    {
        return $this->responseString;
    }

    protected function setMethod($method)
    {
        $this->method = $method;
    }

    protected function setRequest(Dominio\AbstractModel $request = null)
    {
        $this->request = $request;
    }

    protected function setRequestString($requestString)
    {
        $this->requestString = $requestString;
    }

    protected function setResponse(Dominio\AbstractModel $response = null)
    {
        $this->response = $response;
    }

    protected function setResponseString($responseString)
    {
        $this->responseString = $responseString;
    }

    protected function getSuccessResponseClass()
    {
        return $this->successResponseClass;
    }

    protected function getErrorResponseClass()
    {
        return $this->errorResponseClass;
    }

    protected function setSuccessResponseClass($successResponseClass)
    {
        $this->successResponseClass = $successResponseClass;
    }

    protected function setErrorResponseClass($errorResponseClass)
    {
        $this->errorResponseClass = $errorResponseClass;
    }

    public function getLogger()
    {
        return $this->logger;
    }

    public function setLogger(\Closure $logger = null)
    {
        $this->logger = $logger;
    }

    /**
     * Limpar as variáveis
     */
    protected function reset()
    {
        $this->url = null;
        $this->method = null;
        $this->request = null;
        $this->requestString = null;
        $this->successResponseClass = Dominio\AbstractModel::class;
        $this->errorResponseClass = Dominio\Erro::class;
        $this->response = null;
        $this->responseHttp = null;
        $this->responseString = null;
    }

}
