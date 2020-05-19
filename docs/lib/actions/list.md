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

| Key     | Required | Type      | Description                                      |
|---------|----------|-----------|--------------------------------------------------|
| `query` | false    | string    | A fuzzy search to filter down entities           |
| `after` | false    | timestamp | A timestamp to list entities updated after       |
| `page`  | false    | int       | The page number to load the current results from |

<br />
<br />

When a `page` is passed then an array is returned. The first element being the current
dataset and the second element being the last page.

If no `page` is passed then the library loops through all available pages and returns
the whole collected dataset at the end.
