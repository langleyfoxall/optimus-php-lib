<?php

namespace Optimus\Entities;

use Optimus\Constants\EndpointType;
use Optimus\Exceptions\NotSupportedException;
use Optimus\Exceptions\UnexpectedDataException;
use Optimus\Http\Request;

/**
 * @property-read int           $id
 * @property-read int           $parent_id
 * @property-read string        $name
 * @property-read string        $description
 * @property-read Subcategory[] $subcategories
 */
class Category extends AbstractEntity
{
    /** @var string[] $endpoint */
    protected static $endpoint = [
        EndpointType::LIST    => '/categories',
        EndpointType::DETAILS => '/categories/{id}',
    ];

    /**
     * Subcategories relation.
     *
     * @return string
     */
    public function subcategories()
    {
        return Subcategory::class;
    }

    /**
     * Get the products for a given category.
     *
     * @return array|Product[]
     * @throws NotSupportedException
     * @throws UnexpectedDataException
     */
    public function products()
    {
        $request = new Request;

        $request->endpoint(Product::endpoint(EndpointType::LIST));
        $request->filter(['category' => $this->id]);

        $response = $request->load();

        return $response->convertToMany(Product::class);
    }
}
