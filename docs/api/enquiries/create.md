<h1 align="center">
  <br />
  <br />
  Create Enquiry
  <br />
  <br />
  <br />
</h1>

<h6 align="center">
  <br />
  <code>POST /api/enquiries</code>
  <br />
  <br />
  <br />
  <br />
</h6>

Calling this endpoint will return the ID of a newly created enquiry.

<br />
<br />

Expected data:

| Key           | Required | Type     | Description                                       |
|---------------|----------|----------|---------------------------------------------------|
| `name`        | true     | string   | Name of the person enquiring                      |
| `email`       | false    | email    | Email of the person enquiring                     |
| `phone`       | false    | string   | Phone number of the person enquiring              |
| `description` | true     | longtext | Comments/Description of the enquiry               |
| `product_id`  | false    | int      | The ID of a product the person is enquiring about |

<br />
<br />

Expected response:
```json
{
  "status": 201,
  "success": true,
  "error": null,
  "data": "cjsc2",
  "meta": null
}
```
<br>
<sup>Note: There is currently no way to list all enquiries, so store this ID somewhere.</sup>
