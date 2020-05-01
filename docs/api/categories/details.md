<h1 align="center">
  <br />
  <br />
  Category Details
  <br />
  <br />
  <br />
</h1>

<h6 align="center">
  <br />
  <code>GET /api/categories/{id}</code>
  <br />
  <br />
  <br />
  <br />
</h6>

Calling this endpoint will return the details of a specified category.
A category ID can be retrieved from [listing all categories](./list.md).

<br />
<br />

Expected response:
```json
{
  "status": 200,
  "success": true,
  "error": null,
  "data": {
    "id": 1,
    "parent_id": null,
    "name": "Category A",
    "description": null,
    "subcategories": [
      {
        "id": 2,
        "parent_id": 1,
        "name": "Subcategory B"
      }
    ]
  },
  "meta": null
}
```
<br />
<sup>Note: Not all categories will have subcategories.</sup>

<br />
<br />
