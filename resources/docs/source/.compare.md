---
title: API Reference

language_tabs:
- php

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.

<!-- END_INFO -->

#User


APIs for managing user
<!-- START_3fe85d11bc564d9432f61e61d0e63293 -->
## Create a user account

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://localhost/api/user/store',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'json' => [
            'first_name' => 'ali',
            'last_name' => 'ahmed',
            'country_code' => 'EG',
            'phone_number' => '01011111111',
            'gender' => 'male',
            'birthdate' => '1999-03-01',
            'avatar' => 'illo',
            'email' => 'mail@mail.com',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "id": 1,
    "first_name": "Ahmed",
    "last_name": "Ali",
    "country_code": "EG",
    "phone_number": "01011111111",
    "gender": "male",
    "birthdate": "1999-03-01"
}
```
> Example response (404):

```json
{
    "message": "Sorry Something Went Wrong, Please Try Again Later"
}
```

### HTTP Request
`POST api/user/store`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `first_name` | string |  required  | User first name.
        `last_name` | string |  required  | User last name.
        `country_code` | string |  required  | Country Code.
        `phone_number` | string |  required  | User phone.
        `gender` | string |  required  | User gender.
        `birthdate` | string |  required  | User birth date.
        `avatar` | file |  required  | User profile picture.
        `email` | file |  required  | User email address.
    
<!-- END_3fe85d11bc564d9432f61e61d0e63293 -->

<!-- START_9afee128ed2df86e8bd85950ea0f7b0e -->
## Authenticate User

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://localhost/api/user/auth',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'json' => [
            'phone_number' => '01011111111',
            'password' => 'secret',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "auth_token": "h6unBUTRAWCBihdPxxF6wleQPyrdqnPv"
}
```
> Example response (404):

```json
{
    "message": "Sorry Something Went Wrong, Please Try Again Later"
}
```

### HTTP Request
`POST api/user/auth`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `phone_number` | string |  required  | User phone number.
        `password` | string |  required  | User last name.
    
<!-- END_9afee128ed2df86e8bd85950ea0f7b0e -->

<!-- START_422710614283d725cb83f2d8d551a8dc -->
## Activate User Status

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://localhost/api/user/activate',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'json' => [
            'phone_number' => '01011111111',
            'auth-token' => 'h6unBUTRAWCBihdPxxF6wleQPyrdqnPv',
            'activated' => 1,
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "id": 1,
    "first_name": "Ahmed",
    "last_name": "Ali",
    "country_code": "EG",
    "phone_number": "01011111111",
    "gender": "male",
    "birthdate": "1999-10-24",
    "status": [
        {
            "id": 1,
            "activated": 0,
            "user_id": 1
        }
    ]
}
```
> Example response (404):

```json
{
    "message": "These credentials do not match our records."
}
```

### HTTP Request
`POST api/user/activate`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `phone_number` | string |  required  | User phone number.
        `auth-token` | string |  required  | User token.
        `activated` | integer |  required  | User status.
    
<!-- END_422710614283d725cb83f2d8d551a8dc -->


