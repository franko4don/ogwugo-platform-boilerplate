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
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#Auth
<!-- START_3a9158108fb8966a09bf885f6a2b5854 -->
## Creates a user in the database

> Example request:

```bash
curl -X POST "http://localhost/api/v1/auth/signup"     -d "firstname"="xlSPvWWsVpGbsdFL" \
    -d "lastname"="dSn1gei023G2a2ch" \
    -d "email"="z9MQf2XDvSbmphg0" \
    -d "password"="0VcZAWmDa80THoFh" 
```

```javascript
const url = new URL("http://localhost/api/v1/auth/signup");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = JSON.stringify({
    "firstname": "xlSPvWWsVpGbsdFL",
    "lastname": "dSn1gei023G2a2ch",
    "email": "z9MQf2XDvSbmphg0",
    "password": "0VcZAWmDa80THoFh",
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
curl -X POST "http://localhost/api/v1/auth/login"     -d "email"="gtojHlPSGHnzb93H" \
    -d "password"="Uei5BBPppvCzHkdB" 
```

```javascript
const url = new URL("http://localhost/api/v1/auth/login");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = JSON.stringify({
    "email": "gtojHlPSGHnzb93H",
    "password": "Uei5BBPppvCzHkdB",
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
curl -X POST "http://localhost/api/v1/auth/recovery" 
```

```javascript
const url = new URL("http://localhost/api/v1/auth/recovery");

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
curl -X POST "http://localhost/api/v1/auth/reset" 
```

```javascript
const url = new URL("http://localhost/api/v1/auth/reset");

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
curl -X POST "http://localhost/api/v1/auth/logout" 
```

```javascript
const url = new URL("http://localhost/api/v1/auth/logout");

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
curl -X POST "http://localhost/api/v1/auth/refresh" 
```

```javascript
const url = new URL("http://localhost/api/v1/auth/refresh");

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
`POST /api/v1/auth/refresh`


<!-- END_b591815eb7298ac67431a28c5c83b415 -->

#general
<!-- START_35a709dd24ddef4c2e871719f80f0c39 -->
## Get the authenticated User

> Example request:

```bash
curl -X GET -G "http://localhost/api/v1/auth/me" 
```

```javascript
const url = new URL("http://localhost/api/v1/auth/me");

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


