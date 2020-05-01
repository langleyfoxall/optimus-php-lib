<h1 align="center">
  <br />
  <br />
  Quick Start
  <br />
  <br />
  <br />
</h1>

<h6 align="center">
  <br />
  Get up and running in no time.
  <br />
  <br />
  <br />
  <br />
</h6>

`optimus/php-lib` is made to be as easy as possible to pull categories and products; and push enquiries and check their statuses.

<br />
<br />

##### Set up

To communicate with the API you'll need to know the BASE URI and an API token.
These can be found under `System -> API Tokens`.

Within the initial script of your application you must set your BASE URI and API token
using `Optimus\Helpers\Env` before attempting to communicate with the API.

```php
<?php

use Optimus\Helpers\Env;

Env::setBaseUri($baseUri);
Env::setToken($token);

// ...
```

If these are not set before attempting to communicate with the API you will get a
`EnvironmentVariableNotSetException` which will tell you which variable is not set and how to set it.

<br />
<br />

##### Communicating with the API

Use [entities](./entities.md) to communicate with the API, different entities support different [actions](./actions.md).

```php
<?php

use Optimus\Entities\Category;
use Optimus\Entities\Enquiry;

// Get all categories
$categories = Category::all();

// Get the details of a specific category
$category = Category::find($categories[0]->id);

// Create an enquiry
$enquiry = Enquiry::create([ /* ... */ ]);
```

It's that simple!

<br />
<br />
