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
            "id": "gmHkqFQXrwbblCdY",
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
curl -X POST "http://localhost:8000/api/v1/app/create"     -d "name"="ISe6ULHa26lKcpqn" \
    -d "api_url"="ZvVibgoPqdW9TUEK" \
    -d "app_domain"="NHZgaPFq26rbsJSR" \
    -d "secret"="hGAYf85UYIHnchis" \
    -d "test_secret"="R18qtfM8mtQbeY6J" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/app/create");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = JSON.stringify({
    "name": "ISe6ULHa26lKcpqn",
    "api_url": "ZvVibgoPqdW9TUEK",
    "app_domain": "NHZgaPFq26rbsJSR",
    "secret": "hGAYf85UYIHnchis",
    "test_secret": "R18qtfM8mtQbeY6J",
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
            "name": "oPGVct9w5Xfsih4G",
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
            "id": "n8CrqRoL9IwbA8Il",
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
    "message": "App(s) Deleted"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "App(s) not found"
}
```
> Example response (409):

```json
{
    "status": "failed",
    "status_code": 409,
    "message": "Could not delete App(s)"
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
    "message": "5 App(s) Deleted"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "App(s) not found"
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
            "id": "6cJekqxJvQDMFlFy",
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
    "message": "App Restored"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "App(s) not found"
}
```
> Example response (409):

```json
{
    "status": "failed",
    "status_code": 409,
    "message": "Could not delete App(s)"
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
    "message": "5 App Restored"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "App(s) not found"
}
```
> Example response (409):

```json
{
    "status": "failed",
    "status_code": 409,
    "message": "Could not delete App(s)"
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
            "id": "arHkjNAsdG8ZGEB0",
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
    "message": "App Restored"
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
    "message": "Could not reactivate App"
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
## Deactivate app in database

> Example request:

```bash
curl -X PATCH "http://localhost:8000/api/v1/app/deactivate/{id}" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/app/deactivate/{id}");

    let params = {
            "id": "WLwTdkmnBU3VZeEg",
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
    "message": "App deactivated"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "App(s) not found"
}
```
> Example response (409):

```json
{
    "status": "failed",
    "status_code": 409,
    "message": "Could not deactivate found"
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
    "message": "5 Apps Activated"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "App(s) not found"
}
```
> Example response (409):

```json
{
    "status": "failed",
    "status_code": 409,
    "message": "Could not activate App"
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
    "message": "5 Apps deactivated"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "App(s) not found"
}
```
> Example response (409):

```json
{
    "status": "failed",
    "status_code": 409,
    "message": "Could not activate Apps"
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
curl -X POST "http://localhost:8000/api/v1/auth/signup"     -d "firstname"="koY1l25RXtVriWRV" \
    -d "lastname"="c4ExjbYWCk1ot3hf" \
    -d "email"="KJ42V1JVvAUZXmyc" \
    -d "password"="awaJK9Qc80z0ZSdk" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/auth/signup");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = JSON.stringify({
    "firstname": "koY1l25RXtVriWRV",
    "lastname": "c4ExjbYWCk1ot3hf",
    "email": "KJ42V1JVvAUZXmyc",
    "password": "awaJK9Qc80z0ZSdk",
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

<!-- START_0a3f560c3b32c7f7a0a011fc15783ba8 -->
## Creates a user in the database from organizations

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/auth/signup/from-organization"     -d "firstname"="Y6GaBjlxjNa7lzzd" \
    -d "lastname"="WsPWqYvI8NalDiZF" \
    -d "email"="s0GKn3NeSRYx6yeL" \
    -d "password"="qQxkRuN6tYWnqrkD" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/auth/signup/from-organization");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = JSON.stringify({
    "firstname": "Y6GaBjlxjNa7lzzd",
    "lastname": "WsPWqYvI8NalDiZF",
    "email": "s0GKn3NeSRYx6yeL",
    "password": "qQxkRuN6tYWnqrkD",
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
`POST /api/v1/auth/signup/from-organization`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    firstname | string |  required  | The firstname of user.
    lastname | string |  required  | The lastname of user.
    email | string |  optional  | The email of user.
    password | string |  optional  | The password of user

<!-- END_0a3f560c3b32c7f7a0a011fc15783ba8 -->

<!-- START_f76cc718539c2362f0d0a7069100319e -->
## Log the user in

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/auth/login"     -d "email"="yPXgr6MAKbopp0Pc" \
    -d "password"="nJC0TNgNi6lZ3KUT" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/auth/login");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = JSON.stringify({
    "email": "yPXgr6MAKbopp0Pc",
    "password": "nJC0TNgNi6lZ3KUT",
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

<!-- START_c6e90c30915f5763f5ff8302eff98f2c -->
## Log the user in from organization

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/auth/login/from-organization"     -d "email"="keauEr9mOye9efvn" \
    -d "password"="wSnm40vcuYG5XM42" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/auth/login/from-organization");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = JSON.stringify({
    "email": "keauEr9mOye9efvn",
    "password": "wSnm40vcuYG5XM42",
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
`POST /api/v1/auth/login/from-organization`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | string |  required  | The email of user.
    password | string |  required  | The password of user.

<!-- END_c6e90c30915f5763f5ff8302eff98f2c -->

<!-- START_a74630f31659c578c0a95bd6fd851140 -->
## Send reset password email

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

#Feature
<!-- START_2104a3c3f77e9888281bed9b191c66fb -->
## Get all Features
Other query params includes
`?activated=true` which gets only the activated Features
`deleted` which gets the soft deleted Features

> Example request:

```bash
curl -X GET -G "http://localhost:8000/api/v1/features" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/features");

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
`GET /api/v1/features`


<!-- END_2104a3c3f77e9888281bed9b191c66fb -->

<!-- START_ee5266029421554c5008a30608409b36 -->
## Gets details of a single Feature using the id

> Example request:

```bash
curl -X GET -G "http://localhost:8000/api/v1/feature/{id}" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/feature/{id}");

    let params = {
            "id": "sM63X4zeXtnNv0zw",
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
`GET /api/v1/feature/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  optional  | string required id of the Feature

<!-- END_ee5266029421554c5008a30608409b36 -->

<!-- START_3294c5a22a97e86dd75d79769594d593 -->
## Creates or registers Feature

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/feature/create"     -d "name"="VfCvXYaSAAf3tcEq" \
    -d "description"="WVkuvwDxgnDZtm15" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/feature/create");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = JSON.stringify({
    "name": "VfCvXYaSAAf3tcEq",
    "description": "WVkuvwDxgnDZtm15",
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
`POST /api/v1/feature/create`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | name of the Feature
    description | string |  required  | Description of the Feature

<!-- END_3294c5a22a97e86dd75d79769594d593 -->

<!-- START_56d645c64899c1ec4596c057356d4d8c -->
## Edits record of a given Feature
Send as x-www-form-urlencoded

> Example request:

```bash
curl -X PATCH "http://localhost:8000/api/v1/feature/edit/{id}" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/feature/edit/{id}");

    let params = {
            "name": "qGHUqxeDffEMOPI9",
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
`PATCH /api/v1/feature/edit/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    name |  optional  | string required id of the Feature

<!-- END_56d645c64899c1ec4596c057356d4d8c -->

<!-- START_3e48f143cdc14a798a84447c66356b15 -->
## Deletes Feature from database

> Example request:

```bash
curl -X DELETE "http://localhost:8000/api/v1/feature/delete/{id}" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/feature/delete/{id}");

    let params = {
            "id": "8wghrMOwS5pickqT",
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
    "message": "Feature Deleted"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "Feature not found"
}
```
> Example response (409):

```json
{
    "status": "failed",
    "status_code": 409,
    "message": "Could not delete Feature"
}
```

### HTTP Request
`DELETE /api/v1/feature/delete/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  optional  | string required Id of the Feature

<!-- END_3e48f143cdc14a798a84447c66356b15 -->

<!-- START_c3a5201be30062fb7a17e3c9aa9409a9 -->
## Deletes multiple Features from database
Send as x-www-form-urlencoded

> Example request:

```bash
curl -X DELETE "http://localhost:8000/api/v1/features/delete"     -d "features"="[]" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/features/delete");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = JSON.stringify({
    "features": "[]",
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
    "message": "5 Features Deleted"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "Feature(s) not found"
}
```
> Example response (409):

```json
{
    "status": "failed",
    "status_code": 409,
    "message": "Could not delete Feature(s)"
}
```

### HTTP Request
`DELETE /api/v1/features/delete`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    features | array |  required  | An array of id's of Features to be deleted

<!-- END_c3a5201be30062fb7a17e3c9aa9409a9 -->

<!-- START_67a1e6bb2377f2735b68b92cbfa72b91 -->
## Restore soft deleted Feature from database

> Example request:

```bash
curl -X PATCH "http://localhost:8000/api/v1/feature/restore/{id}" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/feature/restore/{id}");

    let params = {
            "id": "TMJTbv124z2xf4bc",
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
    "message": "Feature Restore"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "Feature not found"
}
```
> Example response (409):

```json
{
    "status": "failed",
    "status_code": 409,
    "message": "Could not restore Feature"
}
```

### HTTP Request
`PATCH /api/v1/feature/restore/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  optional  | string required Id of the Feature

<!-- END_67a1e6bb2377f2735b68b92cbfa72b91 -->

<!-- START_ac75364c5b67e4bc15de7469258240cc -->
## Restores multiple soft deleted Features from database
Send as x-www-form-urlencoded

> Example request:

```bash
curl -X PATCH "http://localhost:8000/api/v1/features/restore"     -d "Features"="[]" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/features/restore");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = JSON.stringify({
    "Features": "[]",
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
    "message": "5 Feature Restored"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "Feature(s) not found"
}
```
> Example response (409):

```json
{
    "status": "failed",
    "status_code": 409,
    "message": "Could not restore Feature(s)"
}
```

### HTTP Request
`PATCH /api/v1/features/restore`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    Features | array |  required  | an array of Id's of Features to be restored

<!-- END_ac75364c5b67e4bc15de7469258240cc -->

<!-- START_e44bb777c17011fe9f2ab7e515213f8f -->
## Ractivate Feature in database

> Example request:

```bash
curl -X PATCH "http://localhost:8000/api/v1/feature/activate/{id}" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/feature/activate/{id}");

    let params = {
            "id": "ya02lN1JXwdgala3",
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
    "message": "Feature Activated"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "Feature not found"
}
```
> Example response (409):

```json
{
    "status": "failed",
    "status_code": 409,
    "message": "Could not activate Feature"
}
```

### HTTP Request
`PATCH /api/v1/feature/activate/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  optional  | string required Id of the Feature

<!-- END_e44bb777c17011fe9f2ab7e515213f8f -->

<!-- START_682a4a09ab87c7ba6c54348e11d2165d -->
## Ractivate Feature in database

> Example request:

```bash
curl -X PATCH "http://localhost:8000/api/v1/feature/deactivate/{id}" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/feature/deactivate/{id}");

    let params = {
            "id": "ST1rxUdMi1mfQwMV",
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
    "message": "Feature Deactivated"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "Feature not found"
}
```
> Example response (409):

```json
{
    "status": "failed",
    "status_code": 409,
    "message": "Could not deactivate Feature"
}
```

### HTTP Request
`PATCH /api/v1/feature/deactivate/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  optional  | string required Id of the Feature

<!-- END_682a4a09ab87c7ba6c54348e11d2165d -->

<!-- START_207f3e2a0d4ea831f4997dae2ce3f440 -->
## Activate multiple Features
Send as x-www-form-urlencoded

> Example request:

```bash
curl -X PATCH "http://localhost:8000/api/v1/features/activate"     -d "Features"="[]" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/features/activate");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = JSON.stringify({
    "Features": "[]",
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
    "message": "5 Features Activated"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "Feature(s) not found"
}
```
> Example response (409):

```json
{
    "status": "failed",
    "status_code": 409,
    "message": "Could not activate Feature(s)"
}
```

### HTTP Request
`PATCH /api/v1/features/activate`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    Features | array |  required  | an array of Id's of Features to be activated

<!-- END_207f3e2a0d4ea831f4997dae2ce3f440 -->

<!-- START_a8cd953e6b501a3066cba5756257bfb6 -->
## Deactivate multiple Features
Send as x-www-form-urlencoded

> Example request:

```bash
curl -X PATCH "http://localhost:8000/api/v1/features/deactivate"     -d "Features"="[]" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/features/deactivate");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = JSON.stringify({
    "Features": "[]",
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
    "message": "5 Features Deactivated"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "Feature(s) not found"
}
```
> Example response (409):

```json
{
    "status": "failed",
    "status_code": 409,
    "message": "Could not deactivate Feature(s)"
}
```

### HTTP Request
`PATCH /api/v1/features/deactivate`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    Features | array |  required  | an array of Id's of Features to be deactivated

<!-- END_a8cd953e6b501a3066cba5756257bfb6 -->

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
            "id": "0p9yBWAOlOvLqsfJ",
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
curl -X POST "http://localhost:8000/api/v1/organization/create"     -d "name"="6L19JWcChAdJJQ9M" \
    -d "domain_name"="HRozVPhHKuAbnm2R" \
    -d "motto"="CaOoaef57yYrkFVr" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/organization/create");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = JSON.stringify({
    "name": "6L19JWcChAdJJQ9M",
    "domain_name": "HRozVPhHKuAbnm2R",
    "motto": "CaOoaef57yYrkFVr",
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
            "name": "xIMvYFRF041aPCqk",
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
            "id": "KeKgKHVoJmDkZ4Ib",
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
    "message": "Organization Deleted"
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
    "message": "Could not delete Organization"
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
    "message": "5 Organizations Deleted"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "Organization(s) not found"
}
```
> Example response (409):

```json
{
    "status": "failed",
    "status_code": 409,
    "message": "Could not delete Organization(s)"
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
            "id": "kqNAjlPp0CFmG6fZ",
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
    "message": "Organization Restored"
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
    "message": "Could not restore Organization"
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
    "message": "5 Organizations Restored"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "Organization(s) not found"
}
```
> Example response (409):

```json
{
    "status": "failed",
    "status_code": 409,
    "message": "Could not restore (s)"
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
## Activate organization in database

> Example request:

```bash
curl -X PATCH "http://localhost:8000/api/v1/organization/activate/{id}" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/organization/activate/{id}");

    let params = {
            "id": "5A0h4vNQs7BBmrQ5",
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
    "message": "Organization Activated"
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
    "message": "Could not activate Organization"
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
## deactivate organization in database

> Example request:

```bash
curl -X PATCH "http://localhost:8000/api/v1/organization/deactivate/{id}" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/organization/deactivate/{id}");

    let params = {
            "id": "gQg6tnWsNhxNraKV",
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
    "message": "Organization Deactivated"
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
    "message": "Could not deactivate Organization"
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
    "message": "5 Organization Activated"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "Organization(s) not found"
}
```
> Example response (409):

```json
{
    "status": "failed",
    "status_code": 409,
    "message": "Could not activate Organization(s)"
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
    "message": "5 Organization Deactivated"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "Organization(s) not found"
}
```
> Example response (409):

```json
{
    "status": "failed",
    "status_code": 409,
    "message": "Could not deactivate Organization(s)"
}
```

### HTTP Request
`PATCH /api/v1/organizations/deactivate`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    organizations | array |  required  | an array of Id's of organizations to be deactivated

<!-- END_4e7179b885297209c8d45939d13ee068 -->

#Subscription
<!-- START_8b2d5f0620d38573ccce051974a129c2 -->
## Get all Subscriptions
Other query params includes
`?activated=true` which gets only the activated Subscriptions
`deleted` which gets the soft deleted Subscriptions

> Example request:

```bash
curl -X GET -G "http://localhost:8000/api/v1/subscriptions" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/subscriptions");

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
`GET /api/v1/subscriptions`


<!-- END_8b2d5f0620d38573ccce051974a129c2 -->

<!-- START_ef665351ccabe0090ffac191c4033ca1 -->
## Gets details of a single Subscription using the id

> Example request:

```bash
curl -X GET -G "http://localhost:8000/api/v1/subscription/{id}" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/subscription/{id}");

    let params = {
            "id": "YrhSMeLjavmdIuPQ",
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
`GET /api/v1/subscription/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  optional  | string required id of the Subscription

<!-- END_ef665351ccabe0090ffac191c4033ca1 -->

<!-- START_28ff3b07f226550cfbcfe1898aa82f19 -->
## Creates or registers and Subscription

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/subscription/create"     -d "name"="CiYdQtk1p5lSyCue" \
    -d "domain_name"="ZjNF8t7B5ACacDq4" \
    -d "motto"="SEBdSTE6U3KIASLT" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/subscription/create");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = JSON.stringify({
    "name": "CiYdQtk1p5lSyCue",
    "domain_name": "ZjNF8t7B5ACacDq4",
    "motto": "SEBdSTE6U3KIASLT",
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
`POST /api/v1/subscription/create`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | name of the Subscription
    domain_name | string |  required  | Domain name of the Subscription
    motto | string |  optional  | optional motto of the Subscription

<!-- END_28ff3b07f226550cfbcfe1898aa82f19 -->

<!-- START_869edca8f7bb6a33cd642c70e7001d7a -->
## Edits record of a given Subscription
Send as x-www-form-urlencoded

> Example request:

```bash
curl -X PATCH "http://localhost:8000/api/v1/subscription/edit/{id}" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/subscription/edit/{id}");

    let params = {
            "name": "yzpapvcsOPcVzK9V",
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
`PATCH /api/v1/subscription/edit/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    name |  optional  | string required id of the Subscription

<!-- END_869edca8f7bb6a33cd642c70e7001d7a -->

<!-- START_ee3a7a511ff9905e32c4602ddf1c7063 -->
## Deletes Subscription from database

> Example request:

```bash
curl -X DELETE "http://localhost:8000/api/v1/subscription/delete/{id}" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/subscription/delete/{id}");

    let params = {
            "id": "mUc4n3qmzXWvA6QI",
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
    "message": "Subscription Deleted"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "Subscription not found"
}
```
> Example response (409):

```json
{
    "status": "failed",
    "status_code": 409,
    "message": "Could not delete Subscription"
}
```

### HTTP Request
`DELETE /api/v1/subscription/delete/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  optional  | string required Id of the Subscription

<!-- END_ee3a7a511ff9905e32c4602ddf1c7063 -->

<!-- START_4983383e7073719bee5fa94f97b8cbf5 -->
## Deletes multiple Subscriptions from database
Send as x-www-form-urlencoded

> Example request:

```bash
curl -X DELETE "http://localhost:8000/api/v1/subscriptions/delete"     -d "Subscriptions"="[]" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/subscriptions/delete");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = JSON.stringify({
    "Subscriptions": "[]",
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
    "message": "5 Subscriptions Deleted"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "Subscription(s) not found"
}
```
> Example response (409):

```json
{
    "status": "failed",
    "status_code": 409,
    "message": "Could not delete Subscription(s)"
}
```

### HTTP Request
`DELETE /api/v1/subscriptions/delete`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    Subscriptions | array |  required  | An array of id's of Subscriptions to be deleted

<!-- END_4983383e7073719bee5fa94f97b8cbf5 -->

<!-- START_38bfd1fdf0f730bae65bebe397c5d62c -->
## Restore soft deleted Subscription from database

> Example request:

```bash
curl -X PATCH "http://localhost:8000/api/v1/subscription/restore/{id}" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/subscription/restore/{id}");

    let params = {
            "id": "Q2Ih3B5UPu3xTllk",
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
    "message": "Subscription Restored"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "Subscription not found"
}
```
> Example response (409):

```json
{
    "status": "failed",
    "status_code": 409,
    "message": "Could not restore Subscription"
}
```

### HTTP Request
`PATCH /api/v1/subscription/restore/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  optional  | string required Id of the Subscription

<!-- END_38bfd1fdf0f730bae65bebe397c5d62c -->

<!-- START_153c8993caf413493d00f928ab0bb2d6 -->
## Restores multiple soft deleted Subscriptions from database
Send as x-www-form-urlencoded

> Example request:

```bash
curl -X PATCH "http://localhost:8000/api/v1/subscriptions/restore"     -d "Subscriptions"="[]" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/subscriptions/restore");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = JSON.stringify({
    "Subscriptions": "[]",
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
    "message": "5 Subscriptions restored"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "Subscription(s) not found"
}
```
> Example response (409):

```json
{
    "status": "failed",
    "status_code": 409,
    "message": "Could not restore Subscription(s)"
}
```

### HTTP Request
`PATCH /api/v1/subscriptions/restore`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    Subscriptions | array |  required  | an array of Id's of Subscriptions to be restored

<!-- END_153c8993caf413493d00f928ab0bb2d6 -->

<!-- START_f21b3d886a4385d0b4d7e1fea5dec725 -->
## Ractivate Subscription in database

> Example request:

```bash
curl -X PATCH "http://localhost:8000/api/v1/subscription/activate/{id}" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/subscription/activate/{id}");

    let params = {
            "id": "395qv2i18NW32n6C",
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
    "message": "Subscription activated"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "Subscription not found"
}
```
> Example response (409):

```json
{
    "status": "failed",
    "status_code": 409,
    "message": "Could not activate Subscription"
}
```

### HTTP Request
`PATCH /api/v1/subscription/activate/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  optional  | string required Id of the Subscription

<!-- END_f21b3d886a4385d0b4d7e1fea5dec725 -->

<!-- START_ee4bad1b088832044911e1a351149cd7 -->
## Ractivate Subscription in database

> Example request:

```bash
curl -X PATCH "http://localhost:8000/api/v1/subscription/deactivate/{id}" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/subscription/deactivate/{id}");

    let params = {
            "id": "hUjdA4kuArihwKDO",
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
    "message": "Subscription deactivated"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "Subscription not found"
}
```
> Example response (409):

```json
{
    "status": "failed",
    "status_code": 409,
    "message": "Could not deactivate Subscription"
}
```

### HTTP Request
`PATCH /api/v1/subscription/deactivate/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  optional  | string required Id of the Subscription

<!-- END_ee4bad1b088832044911e1a351149cd7 -->

<!-- START_2eecd1df60e4c6bccab4291875178782 -->
## Activate multiple Subscriptions
Send as x-www-form-urlencoded

> Example request:

```bash
curl -X PATCH "http://localhost:8000/api/v1/subscriptions/activate"     -d "Subscriptions"="[]" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/subscriptions/activate");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = JSON.stringify({
    "Subscriptions": "[]",
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
    "message": "5 Subscriptions activated"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "Subscription(s) not found"
}
```
> Example response (409):

```json
{
    "status": "failed",
    "status_code": 409,
    "message": "Could not activate Subscription"
}
```

### HTTP Request
`PATCH /api/v1/subscriptions/activate`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    Subscriptions | array |  required  | an array of Id's of Subscriptions to be activated

<!-- END_2eecd1df60e4c6bccab4291875178782 -->

<!-- START_6a989a456db4d01b441e309d15519553 -->
## Deactivate multiple Subscriptions
Send as x-www-form-urlencoded

> Example request:

```bash
curl -X PATCH "http://localhost:8000/api/v1/subscriptions/deactivate"     -d "Subscriptions"="[]" 
```

```javascript
const url = new URL("http://localhost:8000/api/v1/subscriptions/deactivate");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = JSON.stringify({
    "Subscriptions": "[]",
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
    "message": "5 Subscriptions deactivated"
}
```
> Example response (404):

```json
{
    "status": "failed",
    "status_code": 404,
    "message": "Subscription(s) not found"
}
```
> Example response (409):

```json
{
    "status": "failed",
    "status_code": 409,
    "message": "Could not deactivate Subscription(s)"
}
```

### HTTP Request
`PATCH /api/v1/subscriptions/deactivate`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    Subscriptions | array |  required  | an array of Id's of Subscriptions to be deactivated

<!-- END_6a989a456db4d01b441e309d15519553 -->

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


