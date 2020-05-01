<h1 align="center">
  <br />
  <br />
  Enquiry Details
  <br />
  <br />
  <br />
</h1>

<h6 align="center">
  <br />
  <code>GET /api/enquiries/{id}</code>
  <br />
  <br />
  <br />
  <br />
</h6>

Calling this endpoint will return the status of a specified enquiry.
A enquiry ID will be returned after [creating an enquiry](./create.md).

<br />
<br />

Expected response:
```json
{
  "status": 200,
  "success": true,
  "error": null,
  "data": {
    "id": "cjsc2",
    "status": "open"
  },
  "meta": null
}
```
<br />
<sup>Note: Possible status include: <code>open</code>, <code>closed</code>.</sup>

<br />
<br />
