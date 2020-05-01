<h1 align="center">
  <br />
  <br />
  Details Action
  <br />
  <br />
  <br />
</h1>

<h6 align="center">
  <br />
  <code>Entity::find()</code>
  <br />
  <br />
  <br />
  <br />
</h6>

When wanting to return details for an item of a given entity
type you can statically call the `find` method on supported entities:

* [Categories](../categories/details.md)
* [Products](../products/details.md)
* [Enquiries](../enquiries/details.md)

<br />
<br />

Expected arguments:

| Key  | Required | Type          | Description                  |
|------|----------|---------------|------------------------------|
| `id` | true     | int or string | The ID of the current entity |

<br>
<sup>Note: This method also supports an associative array to pass named IDs. But no entity current requires this.</sup>
