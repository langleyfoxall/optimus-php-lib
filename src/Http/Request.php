<?php

namespace Optimus\Http;

use GuzzleHttp\Client;
use Optimus\Entities\AbstractEntity;
use Optimus\Exceptions\EnvironmentVariableNotSetException;
use Optimus\Helpers\Env;
use Optimus\Helpers\File;

class Request
{
    /** @var Client $handler */
    protected $handler;

    /** @var string $endpoint */
    protected $endpoint;

    /** @var int $page */
    protected $page = 1;

    /** @var array $filters */
    protected $filters = [];

    /** @var string $search */
    protected $search;

    /**
     * @throws EnvironmentVariableNotSetException
     */
    public function __construct()
    {
        $this->handler = new Client;

        $this->bootstrap();
    }

    /**
     * Prepare request.
     *
     * @throws EnvironmentVariableNotSetException
     * @return void
     */
    protected function bootstrap()
    {
        if (empty(Env::getBaseUri())) {
            throw new EnvironmentVariableNotSetException('The base URI is not set. Use Env::setBaseUri to set it.');
        }

        if (empty(Env::getToken())) {
            throw new EnvironmentVariableNotSetException('The token is not set. Use Env::setToken to set it.');
        }
    }

    /**
     * Set the endpoint
     *
     * @param string $endpoint
     * @return $this
     * @internal
     */
    public function endpoint($endpoint)
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * Set the current page.
     *
     * @param int $page
     * @return $this
     * @internal
     */
    public function page($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Set the search term.
     *
     * @param string $search
     * @return $this
     * @internal
     */
    public function search($search = null)
    {
        $this->search = $search;

        return $this;
    }

    /**
     * Set the filters.
     *
     * @param array $filters
     * @return $this
     */
    public function filter(array $filters = [])
    {
        $this->filters = $filters;

        return $this;
    }

    /**
     * Call a GET request.
     *
     * @param string $url
     * @param array  $query
     * @param array  $headers
     * @return Response
     * @internal
     */
    public function get($url, $query = [], $headers = [])
    {
        $response = $this->handler->get($url, [
            'query'   => $query,
            'headers' => array_merge(
                $headers,
                $this->headers()
            ),
        ]);

        return new Response($response);
    }

    /**
     * Call a POST request.
     *
     * @param string $url
     * @param array  $data
     * @param array  $headers
     * @return Response
     * @internal
     */
    public function post($url, $data = [], $headers = [])
    {
        $response = $this->handler->post($url, [
            'multipart' => $this->convertData($data),
            'headers'   => array_merge(
                $headers,
                $this->headers()
            ),
        ]);

        return new Response($response);
    }

    /**
     * Call a given endpoint with set a set querystring.
     *
     * @return Response
     * @see      AbstractEntity::find()
     * @see      AbstractEntity::all()
     * @internal Used internally for loading entities from the API.
     */
    public function load()
    {
        return $this->get($this->url(), $this->query());
    }

    /**
     * Call a given endpoint with set data from a given entity.
     *
     * @param AbstractEntity $entity
     * @return Response
     * @see      AbstractEntity::create()
     * @internal Used internally for storing an entity against the remote system.
     */
    public function create(AbstractEntity $entity)
    {
        return $this->post($this->url(), $entity->toArray());
    }

    /**
     * Build the url to be used in the request.
     *
     * @return string
     */
    protected function url()
    {
        $endpoint = $this->endpoint;

        // Add prefix
        $endpoint = strpos($endpoint, '/') !== 0 ? '/' . $endpoint : $endpoint;

        $baseUri = Env::getBaseUri();

        // Strip trailing slash
        $baseUri = substr($baseUri, strlen($baseUri) - 1) === '/' ? substr($baseUri, 0, -1) : $baseUri;

        // Add suffix
        $baseUri = strpos($baseUri, '/api') !== 0 ? $baseUri . '/api' : $baseUri;

        return $baseUri . $endpoint;
    }

    /**
     * Build headers array to be used in the request.
     *
     * @return array
     */
    protected function headers()
    {
        return [
            'accept'        => 'application/json',
            'authorization' => Env::getToken(),
        ];
    }

    /**
     * Build query array to be used in the request.
     *
     * @return array
     */
    protected function query()
    {
        return array_merge(
            $this->filters,
            [
                'page'   => $this->page,
                'search' => $this->search,
            ]
        );
    }

    /**
     * Convert data ready for POST request
     *
     * @param array  $data
     * @param string $parent
     * @return array
     */
    protected function convertData($data, $parent = '')
    {
        $tmp = [];

        foreach ($data as $key => $value) {
            if (!empty($parent)) {
                $key = $parent . '[' . $key . ']';
            }

            if (is_array($value)) {
                $tmp = array_merge(
                    $tmp,
                    $this->convertData($value, $key)
                );

                continue;
            }

            if (is_a($value, File::class)) {

                /** @var File $value */
                $tmp[$key] = [
                    'name'     => $key,
                    'contents' => $value->content(),
                    'filename' => $value->filename(),
                ];

                continue;
            }

            if (is_a($value, AbstractEntity::class)) {
                $tmp = array_merge(
                    $tmp,
                    $this->convertData($value->getAttributes(), $key),
                    $this->convertData($value->getRelations(), $key)
                );

                continue;
            }

            $tmp[] = [
                'name'     => $key,
                'contents' => $value,
            ];
        }

        return $tmp;
    }
}
