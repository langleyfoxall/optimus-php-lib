<h1 align="center">
  <br />
  <br />
  List Action
  <br />
  <br />
  <br />
</h1>

<h6 align="center">
  <br />
  <code>Entity::all()</code>
  <br />
  <br />
  <br />
  <br />
</h6>

When wanting to return every available item of a given entity
type you can statically call the `all` method on supported entities:

* [Categories](../entities/categories.md)
* [Products](../entities/products.md)

<br />
<br />

Expected arguments:

| Key     | Required | Type   | Description                                      |
|---------|----------|--------|--------------------------------------------------|
| `query` | false    | string | A fuzzy search to filter down entities           |
| `page`  | false    | int    | The page number to load the current results from |

<br />
<br />
