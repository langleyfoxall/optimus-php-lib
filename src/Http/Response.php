<?php

namespace Optimus\Http;

use Optimus\Entities\AbstractEntity;
use Optimus\Exceptions\UnexpectedDataException;
use Optimus\Helpers\Arr;
use Psr\Http\Message\ResponseInterface;

class Response
{
    /** @var ResponseInterface $handler */
    protected $handler;

    /** @var string $response */
    protected $response;

    /**
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->handler = $response;
        $this->response = $this->handler->getBody()->getContents();
    }

    /**
     * Get the response content.
     *
     * @return array
     */
    public function response()
    {
        return json_decode($this->response, true);
    }

    /**
     * Get the data from the response.
     *
     * @return array
     */
    public function data()
    {
        $response = $this->response();

        if (!is_array($response) || !array_key_exists('data', $response)) {
            return null;
        }

        if ($this->isPaginated()) {
            return $response['data']['data'];
        }

        return $response['data'];
    }

    /**
     * Return the current page of the response.
     *
     * @return null|int
     */
    public function currentPage()
    {
        if ($this->isPaginated()) {
            $response = $this->response();
            $body = $response['data'];

            return $body['current_page'];
        }

        return null;
    }

    /**
     * Return the last page of the response.
     *
     * @return null|int
     */
    public function lastPage()
    {
        if ($this->isPaginated()) {
            $response = $this->response();
            $body = $response['data'];

            return $body['last_page'];
        }

        return null;
    }

    /**
     * Convert the raw response data into an entity.
     *
     * @param string $entity
     * @return AbstractEntity
     * @throws UnexpectedDataException
     */
    public function convertTo($entity)
    {
        return $this->convert($entity, $this->data());
    }

    /**
     * Convert the raw response data into many entities.
     *
     * @param string $entity
     * @return array|AbstractEntity[]
     * @throws UnexpectedDataException
     */
    public function convertToMany($entity)
    {
        $data = $this->data();

        if (is_null($data) || empty($data)) {
            return [];
        }

        if (!Arr::isNotAssoc($data)) {
            throw new UnexpectedDataException;
        }

        return array_map(function ($data) use ($entity) {
            return $this->convert($entity, $data);
        }, $data);
    }

    /**
     * Convert data into an entity.
     *
     * @param string $entity
     * @param array  $data
     * @return AbstractEntity
     * @throws UnexpectedDataException
     * @internal
     */
    protected function convert($entity, $data)
    {
        if (Arr::isNotAssoc($data)) {
            throw new UnexpectedDataException;
        }

        return call_user_func_array([$entity, 'make'], [$data]);
    }

    /**
     * Check if the response is paginated or not.
     *
     * @return bool
     */
    protected function isPaginated()
    {
        $response = $this->response();

        if (!is_array($response)) {
            return false;
        }

        return array_key_exists('data', $response)
            && is_array($response['data'])
            && array_key_exists('data', $response['data']);
    }
}
