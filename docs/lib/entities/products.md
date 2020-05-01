<h1 align="center">
  <br />
  <br />
  Product Entity
  <br />
  <br />
  <br />
</h1>

<h6 align="center">
  <br />
  <code>Optimus\Entities\Product</code>
  <br />
  <br />
  <br />
  <br />
</h6>

`Product` is a functional representation of the [product endpoints](../../api/products.md)
from the API.

#### Table of contents

* [Actions](#actions)
* [Mutations](#mutations)

<br />
<br />

##### Actions

The [list](../actions/list.md) and [details](../actions/details.md) actions are supported.

<br />
<br />

##### Mutations

When viewing the details of a given product some elements of the original data become mutated 
into an object.

Find the expected API response data [here](../../api/products/details.md).

<br />

###### `categories`

Each category becomes mutated into a [category](./categories.md) object.

<br />

###### `media`

Each media item becomes mutated into a `Optimus\Entities\Media` object.

<br />

###### `pricing`

Each pricing item becomes mutated into a `Optimus\Entities\Pricing` object.

<br />
<br />


