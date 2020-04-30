<?php

namespace Optimus;

use Optimus\Exceptions\UnexpectedDataException;
use Optimus\Helpers\Arr;
use Psr\Http\Message\ResponseInterface;

class Response
{
    /** @var ResponseInterface $handler */
    protected $handler;

    /**
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->handler = $response;
    }

    /**
     * Get the response content.
     *
     * @return array
     */
    public function response()
    {
        return json_decode($this->handler->getBody()->getContents(), true);
    }

    /**
     * Get the data from the response.
     *
     * @return array
     */
    public function data()
    {
        $response = $this->response();

        if (!array_key_exists('data', $response)) {
            return null;
        }

        if (is_array($response['data']) && array_key_exists('data', $response['data'])) {
            return $response['data']['data'];
        }

        return $response['data'];
    }

    /**
     * Convert the raw response data into an entity.
     *
     * @param string $entity
     * @return AbstractEntity
     * @throws UnexpectedDataException
     */
    public function convertTo(string $entity)
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
    public function convertToMany(string $entity)
    {
        $data = $this->data();

        if (is_null($data) || empty($data)) {
            return [];
        }

        if (!Arr::isNotAssoc($data)) {
            throw new UnexpectedDataException;
        }

        return array_map(function (array $data) use ($entity) {
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
    protected function convert(string $entity, array $data)
    {
        if (Arr::isNotAssoc($data)) {
            throw new UnexpectedDataException;
        }

        return call_user_func_array([$entity, 'make'], [$data]);
    }
}
