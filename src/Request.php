<?php

namespace Optimus;

use GuzzleHttp\Client;
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

    public function __construct()
    {
        $this->handler = new Client;
    }

    /**
     * Set the endpoint
     *
     * @param string $endpoint
     * @return $this
     * @internal
     */
    public function endpoint(string $endpoint): Request
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
    public function page(int $page): Request
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
    public function search(string $search = null): Request
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
    public function filter(array $filters = []): Request
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
    public function get(string $url, array $query = [], array $headers = [])
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
    public function post(string $url, array $data = [], array $headers = [])
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
        $endpoint = strpos($endpoint, '/') !== 0 ? '/' . $endpoint : $endpoint;

        return 'http://optimus-laravel.loc/api' . $endpoint;
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
            'authorization' => "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImV4cCI6bnVsbH0.5LYUGGjMbf3O_wqnOd1dQSNL47M0BCnKXNSEz_tJm4Y",
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
    protected function convertData(array $data, string $parent = '')
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
                    'name' => $key,
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
