---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost:8000/docs/collection.json)

<!-- END_INFO -->

#App
<!-- START_f85b61d1b5d40ce7d2d9a374358365aa -->
## Get all apps
Other query params includes
`?activated=true` which gets only the activated apps
`deleted` which gets the soft deleted apps

> Example request:

```bash
curl -X GET -G "http://localhost:8000/api/v1/apps" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/apps");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "data": [
        {
            "id": "58c0da78-3858-41c5-b010-7c5e84192a65",
            "api_url": "https:\/\/something.com",
            "name": "food service",
            "secret": "6cbebb34bd2ea9311619f443921d7949",
            "test_secret": "cc49f8454eec07301c9c88b05d703da8",
            "app_domain": null,
            "is_active": 0
        },
        {
            "id": "c4e25380-6d4b-4d4f-8169-4ad1c9d6c840",
            "api_url": "https:\/\/something.com\/api\/v1\/efscedf",
            "name": "food service",
            "secret": "b2ea5702df4f1e8a33afd19d13ebd189",
            "test_secret": "697a38940f142aaaa39dfc976509a76b",
            "app_domain": null,
            "is_active": 0
        },
        {
            "id": "ff422ad1-2c88-489d-a0f1-ba60be395eac",
            "api_url": "https:\/\/something.com\/api\/v1",
            "name": "food service",
            "secret": "3dc2b9164e01bb77c071dcbab3b0d1c3",
            "test_secret": "aab2430da0152cffa91fa6e032548904",
            "app_domain": null,
            "is_active": 0
        }
    ],
    "status": "success",
    "status_code": 200,
    "message": "successful"
}
```

### HTTP Request
`GET /api/v1/apps`


<!-- END_f85b61d1b5d40ce7d2d9a374358365aa -->

<!-- START_8dc6dbb9edbde1540ad1811aa47e62d8 -->
## Gets details of a single app using the id

> Example request:

```bash
curl -X GET -G "http://localhost:8000/api/v1/app/{id}" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/app/{id}");

    let params = {
            "id": "gx7boJIeeQ43JtBi",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "data": {
        "id": "58c0da78-3858-41c5-b010-7c5e84192a65",
        "api_url": "https:\/\/something.com",
        "name": "food service",
        "secret": "6cbebb34bd2ea9311619f443921d7949",
        "test_secret": "cc49f8454eec07301c9c88b05d703da8",
        "app_domain": null,
        "is_active": 0
    },
    "status": "success",
    "status_code": 200,
    "message": "successful"
}
```

### HTTP Request
`GET /api/v1/app/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  optional  | string required id of the app

<!-- END_8dc6dbb9edbde1540ad1811aa47e62d8 -->

<!-- START_9b2e19a24b10171f91f138ce1a78de8d -->
## Creates or registers and app or microservice

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/app/create"     -d "name"="UyIVgEPVeu7oCkzF" \
    -d "api_url"="4W5vRnSgWUR38EVV" \
    -d "app_domain"="6ranS9YycLI7ww7Z" \
    -d "secret"="Km16IUqGaBKpsjqs" \
    -d "test_secret"="ke9p6PGJaGWX2AWI" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/app/create");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = JSON.stringify({
    "name": "UyIVgEPVeu7oCkzF",
    "api_url": "4W5vRnSgWUR38EVV",
    "app_domain": "6ranS9YycLI7ww7Z",
    "secret": "Km16IUqGaBKpsjqs",
    "test_secret": "ke9p6PGJaGWX2AWI",
})

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "data": {
        "id": "58c0da78-3858-41c5-b010-7c5e84192a65",
        "api_url": "https:\/\/something.com",
        "name": "food service",
        "secret": "6cbebb34bd2ea9311619f443921d7949",
        "test_secret": "cc49f8454eec07301c9c88b05d703da8",
        "app_domain": null,
        "is_active": 0
    },
    "status": "success",
    "status_code": 200,
    "message": "successful"
}
```

### HTTP Request
`POST /api/v1/app/create`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | name of the app
    api_url | url |  required  | api endpoint of the app
    app_domain | string |  optional  | optional domain of the app
    secret | string |  optional  | optional domain of the app
    test_secret | string |  optional  | optional domain of the app

<!-- END_9b2e19a24b10171f91f138ce1a78de8d -->

<!-- START_0b3e3a1a04fe5ac37d203b1d7134562b -->
## Edits record of a given app
Send as x-www-form-urlencoded

> Example request:

```bash
curl -X PATCH "http://localhost:8000/api/v1/app/edit/{id}" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/app/edit/{id}");

    let params = {
            "name": "Sug61kbXVq1ljG6Z",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "data": {
        "id": "58c0da78-3858-41c5-b010-7c5e84192a65",
        "api_url": "https:\/\/something.com",
        "name": "food service",
        "secret": "6cbebb34bd2ea9311619f443921d7949",
        "test_secret": "cc49f8454eec07301c9c88b05d703da8",
        "app_domain": null,
        "is_active": 0
    },
    "status": "success",
    "status_code": 200,
    "message": "successful"
}
```

### HTTP Request
`PATCH /api/v1/app/edit/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    name |  optional  | string required id of the app

<!-- END_0b3e3a1a04fe5ac37d203b1d7134562b -->

<!-- START_3b0028616bd08869feb00e89507bf1b4 -->
## Deletes app from database

> Example request:

```bash
curl -X DELETE "http://localhost:8000/api/v1/app/delete/{id}" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/app/delete/{id}");

    let params = {
            "id": "DsEhMhPXkdEPfKxi",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "status": "success",
    "status_code": 200,
    "message": "App(s) deleted"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "App not found"
}
```
> Example response (409):

```json
{
    "status": "failed",
    "status_code": 409,
    "message": "Apps does not exist"
}
```

### HTTP Request
`DELETE /api/v1/app/delete/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  optional  | string required Id of the app

<!-- END_3b0028616bd08869feb00e89507bf1b4 -->

<!-- START_598e9dfccfb4cd8c371577d49fa05885 -->
## Deletes multiple apps from database
Send as x-www-form-urlencoded

> Example request:

```bash
curl -X DELETE "http://localhost:8000/api/v1/apps/delete"     -d "apps"="[]" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/apps/delete");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = JSON.stringify({
    "apps": "[]",
})

fetch(url, {
    method: "DELETE",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "status": "success",
    "status_code": 200,
    "message": "App(s) deleted"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "App not found"
}
```

### HTTP Request
`DELETE /api/v1/apps/delete`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    apps | array |  required  | An array of id's of apps to be deleted

<!-- END_598e9dfccfb4cd8c371577d49fa05885 -->

<!-- START_09cb154a5d1565d29d82cfc4c29b043a -->
## Restore soft deleted app from database

> Example request:

```bash
curl -X PATCH "http://localhost:8000/api/v1/app/restore/{id}" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/app/restore/{id}");

    let params = {
            "id": "DE02A05sVGOCi6PP",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "status": "success",
    "status_code": 200,
    "message": "App(s) restored"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "App not found"
}
```
> Example response (409):

```json
{
    "status": "failed",
    "status_code": 409,
    "message": "Could not restore App(s)"
}
```

### HTTP Request
`PATCH /api/v1/app/restore/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  optional  | string required Id of the app

<!-- END_09cb154a5d1565d29d82cfc4c29b043a -->

<!-- START_1962b47bb8d42b64ea0c64bf86abc0a6 -->
## Restores multiple soft deleted apps from database
Send as x-www-form-urlencoded

> Example request:

```bash
curl -X PATCH "http://localhost:8000/api/v1/apps/restore"     -d "apps"="[]" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/apps/restore");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = JSON.stringify({
    "apps": "[]",
})

fetch(url, {
    method: "PATCH",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "status": "success",
    "status_code": 200,
    "message": "App(s) restored"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "App not found"
}
```

### HTTP Request
`PATCH /api/v1/apps/restore`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    apps | array |  required  | an array of Id's of apps to be deleted

<!-- END_1962b47bb8d42b64ea0c64bf86abc0a6 -->

<!-- START_274ce6680e0ed3f3a56c3222f1c1c6eb -->
## Ractivate app in database

> Example request:

```bash
curl -X PATCH "http://localhost:8000/api/v1/app/activate/{id}" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/app/activate/{id}");

    let params = {
            "id": "mXy0JwBbeDJrI7XG",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "status": "success",
    "status_code": 200,
    "message": "App(s) restored"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "App not found"
}
```
> Example response (409):

```json
{
    "status": "failed",
    "status_code": 409,
    "message": "Could not restore App(s)"
}
```

### HTTP Request
`PATCH /api/v1/app/activate/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  optional  | string required Id of the app

<!-- END_274ce6680e0ed3f3a56c3222f1c1c6eb -->

<!-- START_1d3fd76f9089f10b062524e401fec36d -->
## Ractivate app in database

> Example request:

```bash
curl -X PATCH "http://localhost:8000/api/v1/app/deactivate/{id}" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/app/deactivate/{id}");

    let params = {
            "id": "jtEOlloaPCICQ2Ng",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "status": "success",
    "status_code": 200,
    "message": "App(s) restored"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "App not found"
}
```
> Example response (409):

```json
{
    "status": "failed",
    "status_code": 409,
    "message": "Could not restore App(s)"
}
```

### HTTP Request
`PATCH /api/v1/app/deactivate/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  optional  | string required Id of the app

<!-- END_1d3fd76f9089f10b062524e401fec36d -->

<!-- START_7c61d611b6bc191b9e10534a721bd1a0 -->
## Activate multiple apps
Send as x-www-form-urlencoded

> Example request:

```bash
curl -X PATCH "http://localhost:8000/api/v1/apps/activate"     -d "apps"="[]" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/apps/activate");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = JSON.stringify({
    "apps": "[]",
})

fetch(url, {
    method: "PATCH",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "status": "success",
    "status_code": 200,
    "message": "App(s) restored"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "App not found"
}
```

### HTTP Request
`PATCH /api/v1/apps/activate`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    apps | array |  required  | an array of Id's of apps to be activated

<!-- END_7c61d611b6bc191b9e10534a721bd1a0 -->

<!-- START_e69ed36905ec1c8571982b5a41ffb2f3 -->
## Deactivate multiple apps
Send as x-www-form-urlencoded

> Example request:

```bash
curl -X PATCH "http://localhost:8000/api/v1/apps/deactivate"     -d "apps"="[]" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/apps/deactivate");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = JSON.stringify({
    "apps": "[]",
})

fetch(url, {
    method: "PATCH",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "status": "success",
    "status_code": 200,
    "message": "App(s) restored"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "App not found"
}
```

### HTTP Request
`PATCH /api/v1/apps/deactivate`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    apps | array |  required  | an array of Id's of apps to be deactivated

<!-- END_e69ed36905ec1c8571982b5a41ffb2f3 -->

#Auth
<!-- START_3a9158108fb8966a09bf885f6a2b5854 -->
## Creates a user in the database

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/auth/signup"     -d "firstname"="zl88pipYQdajylmH" \
    -d "lastname"="wVkAJu4rbsJC21if" \
    -d "email"="HZcXebh1DQZ13Bqe" \
    -d "password"="S5Ia7Zvti4qWgH3Z" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/auth/signup");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = JSON.stringify({
    "firstname": "zl88pipYQdajylmH",
    "lastname": "wVkAJu4rbsJC21if",
    "email": "HZcXebh1DQZ13Bqe",
    "password": "S5Ia7Zvti4qWgH3Z",
})

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "status": "ok",
    "token": "fdsvgdrufsversdubfvgydrsfhewjrdvsfvsetdvbfwredsfvywehrdvsyveasdgrgcwasjgvdwwsd",
    "expires_in": 345653
}
```

### HTTP Request
`POST /api/v1/auth/signup`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    firstname | string |  required  | The firstname of user.
    lastname | string |  required  | The lastname of user.
    email | string |  optional  | The email of user.
    password | string |  optional  | The password of user

<!-- END_3a9158108fb8966a09bf885f6a2b5854 -->

<!-- START_f76cc718539c2362f0d0a7069100319e -->
## Log the user in

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/auth/login"     -d "email"="27YWbyt35sj4eCZG" \
    -d "password"="1pA0vDSwIr7Ivmye" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/auth/login");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = JSON.stringify({
    "email": "27YWbyt35sj4eCZG",
    "password": "1pA0vDSwIr7Ivmye",
})

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "status": "ok",
    "token": "fdsvgdrufsversdubfvgydrsfhewjrdvsfvsetdvbfwredsfvywehrdvsyveasdgrgcwasjgvdwwsd",
    "expires_in": 345653
}
```

### HTTP Request
`POST /api/v1/auth/login`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | string |  required  | The email of user.
    password | string |  required  | The password of user.

<!-- END_f76cc718539c2362f0d0a7069100319e -->

<!-- START_a74630f31659c578c0a95bd6fd851140 -->
## send reset password email

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/auth/recovery" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/auth/recovery");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`POST /api/v1/auth/recovery`


<!-- END_a74630f31659c578c0a95bd6fd851140 -->

<!-- START_5e62b96a0004f7f8322743d3df4c272f -->
## Resets user password

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/auth/reset" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/auth/reset");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`POST /api/v1/auth/reset`


<!-- END_5e62b96a0004f7f8322743d3df4c272f -->

<!-- START_6554a1e034cb490af2ee054f889cc32b -->
## Log the user out (Invalidate the token)

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/auth/logout" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/auth/logout");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`POST /api/v1/auth/logout`


<!-- END_6554a1e034cb490af2ee054f889cc32b -->

<!-- START_b591815eb7298ac67431a28c5c83b415 -->
## Refresh a token.

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/auth/refresh" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/auth/refresh");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "status": "ok",
    "token": "fdsvgdrufsversdubfvgydrsfhewjsyveasdgrgcwasjgvdwwsd",
    "expires_in": 345653
}
```

### HTTP Request
`POST /api/v1/auth/refresh`


<!-- END_b591815eb7298ac67431a28c5c83b415 -->

#Organization
<!-- START_2d865154f0c0b040fe167af9c0eec4af -->
## Get all organizations
Other query params includes
`?activated=true` which gets only the activated organizations
`deleted` which gets the soft deleted organizations

> Example request:

```bash
curl -X GET -G "http://localhost:8000/api/v1/organizations" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/organizations");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "data": [
        {
            "id": "7b842a5c-2c4c-4ce9-bcb8-814d1b6d7222",
            "name": "Vincels Investment",
            "motto": null,
            "logo": null,
            "domain_name": "https:\/\/something.ng",
            "is_active": false,
            "user": {
                "id": "372e95a7-7ce1-4c17-80da-bc49fcbaba64",
                "firstname": "Franklin",
                "lastname": "Nwanze",
                "phone": null,
                "email": "franko4don@gmail.com",
                "verification_code": "uU8ZZLgSwQkZ0xndqfwDjEFq",
                "is_active": 1,
                "is_verified": 0
            }
        }
    ],
    "status": "success",
    "status_code": 200,
    "message": "successful"
}
```

### HTTP Request
`GET /api/v1/organizations`


<!-- END_2d865154f0c0b040fe167af9c0eec4af -->

<!-- START_bffb040ffb9ea131914a3475036520cb -->
## Gets details of a single organization using the id

> Example request:

```bash
curl -X GET -G "http://localhost:8000/api/v1/organization/{id}" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/organization/{id}");

    let params = {
            "id": "y9ilFmU3NL20XjR9",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "data": {
        "id": "7b842a5c-2c4c-4ce9-bcb8-814d1b6d7222",
        "name": "Vincels Investment",
        "motto": null,
        "logo": null,
        "domain_name": "https:\/\/something.ng",
        "is_active": false,
        "user": {
            "id": "372e95a7-7ce1-4c17-80da-bc49fcbaba64",
            "firstname": "Franklin",
            "lastname": "Nwanze",
            "phone": null,
            "email": "franko4don@gmail.com",
            "verification_code": "uU8ZZLgSwQkZ0xndqfwDjEFq",
            "is_active": 1,
            "is_verified": 0
        }
    },
    "status": "success",
    "status_code": 200,
    "message": "successful"
}
```

### HTTP Request
`GET /api/v1/organization/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  optional  | string required id of the organization

<!-- END_bffb040ffb9ea131914a3475036520cb -->

<!-- START_2e18aa5ffdc8eba17a81d816e0c2fb80 -->
## Creates or registers and organization

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/organization/create"     -d "name"="j0HzPbNNzgqF3RkC" \
    -d "domain_name"="8yB7IBOWgm45PLCr" \
    -d "motto"="b4bNVoepv1Y0Vqec" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/organization/create");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = JSON.stringify({
    "name": "j0HzPbNNzgqF3RkC",
    "domain_name": "8yB7IBOWgm45PLCr",
    "motto": "b4bNVoepv1Y0Vqec",
})

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "data": {
        "id": "7b842a5c-2c4c-4ce9-bcb8-814d1b6d7222",
        "name": "Vincels Investment",
        "motto": null,
        "logo": null,
        "domain_name": "https:\/\/something.ng",
        "is_active": false,
        "user": {
            "id": "372e95a7-7ce1-4c17-80da-bc49fcbaba64",
            "firstname": "Franklin",
            "lastname": "Nwanze",
            "phone": null,
            "email": "franko4don@gmail.com",
            "verification_code": "uU8ZZLgSwQkZ0xndqfwDjEFq",
            "is_active": 1,
            "is_verified": 0
        }
    },
    "status": "success",
    "status_code": 200,
    "message": "successful"
}
```

### HTTP Request
`POST /api/v1/organization/create`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | name of the organization
    domain_name | string |  required  | Domain name of the organization
    motto | string |  optional  | optional motto of the organization

<!-- END_2e18aa5ffdc8eba17a81d816e0c2fb80 -->

<!-- START_42ab0c626a3f8426d5b8c35092ac99ce -->
## Edits record of a given organization
Send as x-www-form-urlencoded

> Example request:

```bash
curl -X PATCH "http://localhost:8000/api/v1/organization/edit/{id}" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/organization/edit/{id}");

    let params = {
            "name": "IoFpUhp77WOFDUuZ",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "data": {
        "id": "7b842a5c-2c4c-4ce9-bcb8-814d1b6d7222",
        "name": "Vincels Investment",
        "motto": null,
        "logo": null,
        "domain_name": "https:\/\/something.ng",
        "is_active": false,
        "user": {
            "id": "372e95a7-7ce1-4c17-80da-bc49fcbaba64",
            "firstname": "Franklin",
            "lastname": "Nwanze",
            "phone": null,
            "email": "franko4don@gmail.com",
            "verification_code": "uU8ZZLgSwQkZ0xndqfwDjEFq",
            "is_active": 1,
            "is_verified": 0
        }
    },
    "status": "success",
    "status_code": 200,
    "message": "successful"
}
```

### HTTP Request
`PATCH /api/v1/organization/edit/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    name |  optional  | string required id of the organization

<!-- END_42ab0c626a3f8426d5b8c35092ac99ce -->

<!-- START_560a4a669ef926cfcec10b517eee7e95 -->
## Deletes organization from database

> Example request:

```bash
curl -X DELETE "http://localhost:8000/api/v1/organization/delete/{id}" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/organization/delete/{id}");

    let params = {
            "id": "oRDVtn3Mn7LVI3YP",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "status": "success",
    "status_code": 200,
    "message": "Organization(s) deleted"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "Organization not found"
}
```
> Example response (409):

```json
{
    "status": "failed",
    "status_code": 409,
    "message": "Organizations does not exist"
}
```

### HTTP Request
`DELETE /api/v1/organization/delete/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  optional  | string required Id of the organization

<!-- END_560a4a669ef926cfcec10b517eee7e95 -->

<!-- START_b57583cea228e9625171d1f01dcd7e0a -->
## Deletes multiple organizations from database
Send as x-www-form-urlencoded

> Example request:

```bash
curl -X DELETE "http://localhost:8000/api/v1/organizations/delete"     -d "organizations"="[]" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/organizations/delete");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = JSON.stringify({
    "organizations": "[]",
})

fetch(url, {
    method: "DELETE",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "status": "success",
    "status_code": 200,
    "message": "Organization(s) deleted"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "Organization not found"
}
```

### HTTP Request
`DELETE /api/v1/organizations/delete`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    organizations | array |  required  | An array of id's of organizations to be deleted

<!-- END_b57583cea228e9625171d1f01dcd7e0a -->

<!-- START_80380858fdd1984de861d172e0e7dc99 -->
## Restore soft deleted organization from database

> Example request:

```bash
curl -X PATCH "http://localhost:8000/api/v1/organization/restore/{id}" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/organization/restore/{id}");

    let params = {
            "id": "PTl6Dc6zcEJGwV9M",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "status": "success",
    "status_code": 200,
    "message": "Organization(s) restored"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "Organization not found"
}
```
> Example response (409):

```json
{
    "status": "failed",
    "status_code": 409,
    "message": "Could not restore Organization(s)"
}
```

### HTTP Request
`PATCH /api/v1/organization/restore/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  optional  | string required Id of the organization

<!-- END_80380858fdd1984de861d172e0e7dc99 -->

<!-- START_c62f8199e3064a3eb3105766ced8b2a9 -->
## Restores multiple soft deleted organizations from database
Send as x-www-form-urlencoded

> Example request:

```bash
curl -X PATCH "http://localhost:8000/api/v1/organizations/restore"     -d "organizations"="[]" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/organizations/restore");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = JSON.stringify({
    "organizations": "[]",
})

fetch(url, {
    method: "PATCH",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "status": "success",
    "status_code": 200,
    "message": "Organization(s) restored"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "Organization not found"
}
```

### HTTP Request
`PATCH /api/v1/organizations/restore`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    organizations | array |  required  | an array of Id's of organizations to be deleted

<!-- END_c62f8199e3064a3eb3105766ced8b2a9 -->

<!-- START_efd2298f6beeed56edc481b5ff47ecab -->
## Ractivate organization in database

> Example request:

```bash
curl -X PATCH "http://localhost:8000/api/v1/organization/activate/{id}" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/organization/activate/{id}");

    let params = {
            "id": "rB2LsQUFO1Fz2Q5u",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "status": "success",
    "status_code": 200,
    "message": "Organization(s) restored"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "Organization not found"
}
```
> Example response (409):

```json
{
    "status": "failed",
    "status_code": 409,
    "message": "Could not restore Organization(s)"
}
```

### HTTP Request
`PATCH /api/v1/organization/activate/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  optional  | string required Id of the organization

<!-- END_efd2298f6beeed56edc481b5ff47ecab -->

<!-- START_58d454c72c76c2a98a15d83000ee85f8 -->
## Ractivate organization in database

> Example request:

```bash
curl -X PATCH "http://localhost:8000/api/v1/organization/deactivate/{id}" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/organization/deactivate/{id}");

    let params = {
            "id": "C6lrbEPuMwOS8SEQ",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "status": "success",
    "status_code": 200,
    "message": "Organization(s) restored"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "Organization not found"
}
```
> Example response (409):

```json
{
    "status": "failed",
    "status_code": 409,
    "message": "Could not restore Organization(s)"
}
```

### HTTP Request
`PATCH /api/v1/organization/deactivate/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  optional  | string required Id of the organization

<!-- END_58d454c72c76c2a98a15d83000ee85f8 -->

<!-- START_e597f17bce62e9044d3179dc0a57fb70 -->
## Activate multiple organizations
Send as x-www-form-urlencoded

> Example request:

```bash
curl -X PATCH "http://localhost:8000/api/v1/organizations/activate"     -d "organizations"="[]" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/organizations/activate");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = JSON.stringify({
    "organizations": "[]",
})

fetch(url, {
    method: "PATCH",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "status": "success",
    "status_code": 200,
    "message": "Organization(s) restored"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "Organization not found"
}
```

### HTTP Request
`PATCH /api/v1/organizations/activate`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    organizations | array |  required  | an array of Id's of organizations to be activated

<!-- END_e597f17bce62e9044d3179dc0a57fb70 -->

<!-- START_4e7179b885297209c8d45939d13ee068 -->
## Deactivate multiple organizations
Send as x-www-form-urlencoded

> Example request:

```bash
curl -X PATCH "http://localhost:8000/api/v1/organizations/deactivate"     -d "organizations"="[]" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/organizations/deactivate");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = JSON.stringify({
    "organizations": "[]",
})

fetch(url, {
    method: "PATCH",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "status": "success",
    "status_code": 200,
    "message": "Organization(s) restored"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "Organization not found"
}
```

### HTTP Request
`PATCH /api/v1/organizations/deactivate`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    organizations | array |  required  | an array of Id's of organizations to be deactivated

<!-- END_4e7179b885297209c8d45939d13ee068 -->

#general
<!-- START_35a709dd24ddef4c2e871719f80f0c39 -->
## Get the authenticated User

> Example request:

```bash
curl -X GET -G "http://localhost:8000/api/v1/auth/me" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/auth/me");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response:

```json
null
```

### HTTP Request
`GET /api/v1/auth/me`


<!-- END_35a709dd24ddef4c2e871719f80f0c39 -->

<!-- START_ef3ef1493915823823835d4da4eb3f52 -->
## /api/v1/test
> Example request:

```bash
curl -X GET -G "http://localhost:8000/api/v1/test" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/test");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{}
```

### HTTP Request
`GET /api/v1/test`


<!-- END_ef3ef1493915823823835d4da4eb3f52 -->


