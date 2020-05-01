<?php

namespace Optimus\Entities;

use Optimus\Constants\EndpointType;

class Enquiry extends AbstractEntity
{
    /** @var string[] $endpoint */
    protected static $endpoint = [
        EndpointType::CREATE  => '/enquiries',
        EndpointType::DETAILS => '/enquiries/{id}',
    ];
}
