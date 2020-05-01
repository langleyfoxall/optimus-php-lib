<h1 align="center">
  <br />
  <br />
  Quick Start
  <br />
  <br />
  <br />
</h1>

<h6 align="center">
  <br />
  Get up and running in no time.
  <br />
  <br />
  <br />
  <br />
</h6>

The API is made to be easy to understand and authenticate with.

<br />
<br />

##### Set up

To communicate with the API you'll need to know the BASE URI and an API token.
These can be found under `System -> API Tokens`.

* Make sure all requests use the BASE URI before the endpoints.
* Within your request make sure to set the `Authorization` header with your API Token.

<br />
<br />

##### Communicating with the API

###### Get all categories

```shell script
curl -i \
    -H "Accept: application/json" \
    -H "Authorization: <TOKEN>" \
    <BASE_URI>/categories
```

<br />

###### Get the details of a specific category

```shell script
curl -i \
    -H "Accept: application/json" \
    -H "Authorization: <TOKEN>" \
    <BASE_URI>/categories/<ID>
```

<br />

###### Create an enquiry

```shell script
curl -i \
    -H "Accept: application/json" \
    -H "Authorization: <TOKEN>" \
    --data "<DATA>" \
    <BASE_URI>/enquiries
```

<br />

It's that simple!

<br />
<br />
