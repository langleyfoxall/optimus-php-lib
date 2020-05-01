<?php

namespace Optimus\Entities;

use Optimus\Constants\EndpointType;
use Optimus\Exceptions\NotSupportedException;
use Optimus\Exceptions\UnexpectedDataException;
use Optimus\Helpers\Arr;
use Optimus\Http\Request;

abstract class AbstractEntity
{
    /** @var array $data */
    protected $data = [];

    /** @var array $relations */
    protected $relations = [];

    /** @var string[] $endpoint */
    protected static $endpoint;

    protected function __construct()
    {
        //
    }

    /**
     * Handling fetching of data.
     *
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

        if (array_key_exists($name, $this->relations)) {
            return $this->relations[$name];
        }

        return null;
    }

    /**
     * Handle setting of data.
     *
     * @param string $name
     * @param mixed  $value
     * @return void
     */
    public function __set($name, $value)
    {
        // Check for class properties
        if (!array_key_exists($name, $this->data) && property_exists($this, $name)) {
            $this->{$name} = $value;
        }

        // Check for relations
        if (!method_exists($this, $name)) {
            $this->setAttribute($name, $value);

            return;
        }

        $this->setRelations($name, $value);
    }

    /**
     * Get all attributes.
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->data;
    }

    /**
     * Set an attribute.
     *
     * @param string $name
     * @param mixed  $value
     * @return $this
     */
    public function setAttribute($name, $value): self
    {
        $this->data[$name] = $value;

        return $this;
    }

    /**
     * Get all relations.
     *
     * @return array
     */
    public function getRelations()
    {
        return $this->relations;
    }

    /**
     * Set a relation.
     *
     * @param $name
     * @param $value
     * @return $this
     */
    public function setRelations($name, $value): self
    {
        if (method_exists($this, $name)) {
            $class = $this->{$name}();

            // Check that relation returns a class
            if (is_string($class) && class_exists($class)) {

                // Check if value contains many relations
                if (is_array($value)) {

                    // Map data to relation entity
                    $value = array_map(function ($value) use ($class) {
                        return call_user_func_array([$class, 'make'], [$value]);
                    }, $value);
                } else {
                    $value = call_user_func_array([$class, 'make'], [$value]);
                }
            }
        }

        $this->relations[$name] = $value;

        return $this;
    }

    /**
     * Merge all attributes and relations to an array.
     *
     * @return array
     */
    public function toArray()
    {
        return array_merge(
            $this->getAttributes(),
            $this->getRelations()
        );
    }

    /**
     * Make an instance of an entity.
     *
     * @param array $data
     * @return static
     */
    public static function make(array $data)
    {
        $entity = new static;

        foreach($data as $attribute => $value) {
            $entity->{$attribute} = $value;
        }

        return $entity;
    }

    /**
     * Get all entities.
     *
     * @param string $query
     * @param int    $after
     * @param int    $page
     * @return array|AbstractEntity[]
     * @throws NotSupportedException
     * @throws UnexpectedDataException
     */
    public static function all(string $query = null, int $after = null, int $page = 1)
    {
        $endpoint = static::endpoint(EndpointType::LIST);
        $request = new Request;

        $request->endpoint($endpoint);
        $request->search($query);
        $request->filter(compact('after'));
        $request->page($page);

        $response = $request->load();

        return $response->convertToMany(static::class);
    }

    /**
     * Get a specific entity.
     *
     * @param array|mixed $id
     * @return AbstractEntity
     * @throws NotSupportedException
     * @throws UnexpectedDataException
     */
    public static function find($id)
    {
        $endpoint = static::endpoint(EndpointType::DETAILS);

        if (is_array($id)) {
            $ids = $id;

            if (Arr::isNotAssoc($ids)) {
                throw new NotSupportedException('An array of IDs must be associative.');
            }

            $regex = array_map(function ($key) {
                return "/\{{$key}\}/";
            }, array_keys($ids));

            $endpoint = preg_replace($regex, $ids, $endpoint);
        } else {
            $endpoint = preg_replace('/\{id\}/', $id, $endpoint);
        }

        $request = new Request;
        $request->endpoint($endpoint);

        $response = $request->load();

        return $response->convertTo(static::class);
    }

    /**
     * @param array $data
     * @return AbstractEntity
     * @throws NotSupportedException
     * @throws UnexpectedDataException
     */
    public static function create(array $data)
    {
        $endpoint = static::endpoint(EndpointType::CREATE);
        $entity = static::make($data);

        $request = new Request;
        $request->endpoint($endpoint);

        $response = $request->create($entity);
        $id = $response->data();

        return static::find($id);
    }

    /**
     * Get the endpoint for a given request type.
     *
     * @param string $type
     * @return string
     * @throws NotSupportedException
     * @internal
     */
    protected static function endpoint(string $type)
    {
        if (!array_key_exists($type, static::$endpoint)) {
            $class = static::class;

            throw new NotSupportedException("The {$type} endpoint is not supported for {$class}.");
        }

        return static::$endpoint[$type];
    }
}
