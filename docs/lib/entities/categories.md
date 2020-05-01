<h1 align="center">
  <br />
  <br />
  Category Entity
  <br />
  <br />
  <br />
</h1>

<h6 align="center">
  <br />
  <code>Optimus\Entities\Category</code>
  <br />
  <br />
  <br />
  <br />
</h6>

`Category` is a functional representation of the [category endpoints](../../api/categories.md)
from the API.

#### Table of contents

* [Actions](#actions)
* [Methods](#methods)
* [Mutations](#mutations)

<br />
<br />

##### Actions

The [list](../actions/list.md) and [details](../actions/details.md) actions are supported.

<br />
<br />

##### Methods

###### `products`

The category entity, once loaded, has a `products` method. This can be used to load all [products](./products.md)
for the current category.

```
$all = Categories::all();
$first = $all[0];

$products = $first->products();
```

<br />
<br />

##### Mutations

###### `subcategories`

When viewing the details of a given category it will sometimes have subcategories.
Rather than just returning an array of data each subcategory become mutated into an object.

The `Optimus\Entities\Subcategory` object simply extends the category object.

<br />
<br />
