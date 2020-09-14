<h1 align="center">
  <br />
  <br />
  List Products
  <br />
  <br />
  <br />
</h1>

<h6 align="center">
  <br />
  <code>GET /api/products</code>
  <br />
  <br />
  <br />
  <br />
</h6>

Calling this endpoint will return a list of all available products.

* Products are paginated into groups of 15 to navigate between pages pass the `page` param with a number.
* Products can be fuzzy searched by passing the `search` param with a string.
* Products can be filtered by when they were last updated by passing the `after` param with a timestamp.
* Categories can be filtered by a category by passing the `category` param with a [category](../categories.md) ID.

Expected response:
```json
{
  "status": 200,
  "success": true,
  "error": null,
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 1,
        "name": "quis quod nihil",
        "sku": "9100067798573",
        "catalogue_reference": "PP-12345",
        "thumbnail": "<...>/images\/image-placeholder.svg",
        "deleted_at": null
      }
    ],
    "first_page_url": "<...>/api\/products?page=1",
    "from": 1,
    "last_page": 3,
    "last_page_url": "<...>/api\/products?page=3",
    "next_page_url": "<...>/api\/products?page=2",
    "path": "<...>/api\/products",
    "per_page": 15,
    "prev_page_url": null,
    "to": 15,
    "total": 34
  },
  "meta": null
}
```
<br />
<sup>Note: <code><...></code> hides the service base URI</sup>

<br />
<br />
