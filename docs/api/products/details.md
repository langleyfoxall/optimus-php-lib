<h1 align="center">
  <br />
  <br />
  Product Details
  <br />
  <br />
  <br />
</h1>

<h6 align="center">
  <br />
  <code>GET /api/products/{id}</code>
  <br />
  <br />
  <br />
  <br />
</h6>

Calling this endpoint will return the details of a specified product.
A product ID can be retrieved from [listing all products](./list.md).

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
    "supplier": "Thomas Inc",
    "categories": [
      {
        "id": 1,
        "name": "Category A"
      }
    ],
    "thumbnail": "<...>\/media\/1\/conversions\/IMG_20190512_155620-thumbnail.jpg?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIA6KCXVJ6XVH34FXMD%2F20200427%2Feu-west-2%2Fs3%2Faws4_request&X-Amz-Date=20200427T104237Z&X-Amz-SignedHeaders=host&X-Amz-Expires=300&X-Amz-Signature=daa6301b19af1dbc74e8a7b46192743220ff7e9a1e1594a357ab46a2f12e2ffd",
    "media": [
      {
        "thumbnail": "<...>\/media\/1\/IMG_20190512_155620.jpg?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIA6KCXVJ6XVH34FXMD%2F20200427%2Feu-west-2%2Fs3%2Faws4_request&X-Amz-Date=20200427T104237Z&X-Amz-SignedHeaders=host&X-Amz-Expires=3600&X-Amz-Signature=a0cfe244789bb2c50762bfe541638ec02ce36ad06776b7b79d872b09381ab3aa",
        "url": "<...>\/media\/1\/IMG_20190512_155620.jpg?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIA6KCXVJ6XVH34FXMD%2F20200427%2Feu-west-2%2Fs3%2Faws4_request&X-Amz-Date=20200427T104237Z&X-Amz-SignedHeaders=host&X-Amz-Expires=3600&X-Amz-Signature=a0cfe244789bb2c50762bfe541638ec02ce36ad06776b7b79d872b09381ab3aa"
      },
      {
        "thumbnail": "<...>\/media\/2\/received_312383769637874.jpeg?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIA6KCXVJ6XVH34FXMD%2F20200427%2Feu-west-2%2Fs3%2Faws4_request&X-Amz-Date=20200427T104237Z&X-Amz-SignedHeaders=host&X-Amz-Expires=3600&X-Amz-Signature=0b1b823089a0850681eded5e43d7a0ea0b9690fbaa9f2b571bc92954bad0bdf1",
        "url": "<...>\/media\/2\/received_312383769637874.jpeg?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIA6KCXVJ6XVH34FXMD%2F20200427%2Feu-west-2%2Fs3%2Faws4_request&X-Amz-Date=20200427T104237Z&X-Amz-SignedHeaders=host&X-Amz-Expires=3600&X-Amz-Signature=0b1b823089a0850681eded5e43d7a0ea0b9690fbaa9f2b571bc92954bad0bdf1"
      }
    ],
    "pricing": [
      {
        "quantity": 75,
        "price": 4.95
      },
      {
        "quantity": 300,
        "price": 4.39
      },
      {
        "quantity": 500,
        "price": 4.69
      },
      {
        "quantity": 5000,
        "price": 3.09
      },
      {
        "quantity": 15000,
        "price": 4.54
      }
    ],
    "name": "quis quod nihil",
    "sku": "9100067798573",
    "reference": "14993480",
    "catalogue_reference": "72869215",
    "description": "accusamus molestiae quo rem nobis maiores quod maiores eum cum",
    "is_eco_product": false,
    "information_eco_qualities": "Assumenda fuga consectetur quam molestiae quae voluptas.",
    "information_print_specification": "Pariatur expedita est ducimus et cumque amet.",
    "information_web_link": "<...>\/sed-ea-commodi-neque-alias-et-cumque",
    "information_web_link_description": "Ullam error qui voluptatem expedita dolores ratione non ea.",
    "information_catalogue_description": "Inventore nobis non consequatur voluptatem mollitia vel.",
    "information_colours": "Error aut modi et magnam non.",
    "information_packaging": "Aut magnam qui et voluptas cumque omnis ut rerum.",
    "lead_time_standard": 7,
    "lead_time_express": 5,
    "is_lead_time_express_chargable": true,
    "maximum_number_of_colours": 3,
    "slug": null,
    "title": null,
    "meta_title": null,
    "subtitle": null,
    "seo_description": null,
    "keywords": null
  },
  "meta": null
}
```
<br>
<sup>Note: Not all products will have categories or media.</sup>
