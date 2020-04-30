<h1 align="center">
  <br />
  <br />
  List Categories
  <br />
  <br />
  <br />
</h1>

<h6 align="center">
  <br />
  <code>GET /api/categories</code>
  <br />
  <br />
  <br />
  <br />
</h6>

Calling this endpoint will return a list of all available categories.

* Categories are paginated into groups of 15 to navigate between pages pass the `page` param with a number.
* Categories can be fuzzy searched by passing the `search` param with a string.
* Categories can be filtered by when they were last updated by passing the `after` param with a timestamp.

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
        "parent_id": null,
        "name": "Category A"
      }
    ],
    "first_page_url": "<...>/api\/categories?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "<...>/api\/categories?page=1",
    "next_page_url": null,
    "path": "<...>/api\/categories",
    "per_page": 15,
    "prev_page_url": null,
    "to": 1,
    "total": 1
  },
  "meta": null
}
```
<br>
<sup><code><...></code> hides the service base URI</sup>
