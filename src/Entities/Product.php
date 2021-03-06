<?php

namespace Optimus\Entities;

use Optimus\Constants\EndpointType;

/**
 * @property-read int         $id
 * @property-read string      $supplier
 * @property-read string      $thumbnail
 * @property-read string      $name
 * @property-read string      $sku
 * @property-read string      $reference
 * @property-read string      $catalogue_reference
 * @property-read string      $description
 * @property-read bool        $is_eco_product
 * @property-read string      $information_eco_product
 * @property-read string      $information_print_specification
 * @property-read string      $information_web_link
 * @property-read string      $information_web_link_description
 * @property-read string      $information_catalogue_description
 * @property-read string      $information_colours
 * @property-read string      $information_packaging
 * @property-read string      $information_express_delivery
 * @property-read string      $country_of_origin
 * @property-read int         $lead_time_standard
 * @property-read int|null    $lead_time_express
 * @property-read bool        $is_lead_time_express_chargable
 * @property-read int         $maximum_number_of_colours
 * @property-read string      $slug
 * @property-read string      $title
 * @property-read string      $meta_title
 * @property-read string      $subtitle
 * @property-read string      $seo_description
 * @property-read string      $keywords
 * @property-read Category[]  $categories
 * @property-read Media[]     $media
 * @property-read Pricing[]   $pricing
 * @property-read string|null $deleted_at
 */
class Product extends AbstractEntity
{
    /** @var string[] $endpoint */
    protected static $endpoint = [
        EndpointType::ALL           => '/products',
        EndpointType::DETAILED_ALL  => '/products/detailed',
        EndpointType::DETAILS       => '/products/{id}',
    ];

    /**
     * Categories relation.
     *
     * @return string
     */
    public function categories()
    {
        return Category::class;
    }

    /**
     * Media relation.
     *
     * @return string
     */
    public function media()
    {
        return Media::class;
    }

    /**
     * Pricing relation.
     *
     * @return string
     */
    public function pricing()
    {
        return Pricing::class;
    }

    /**
     * Returns whether the product has been
     * soft-deleted from Optimus
     *
     * @return bool
     */
    public function isArchived()
    {
        return $this->deleted_at !== null;
    }
}
