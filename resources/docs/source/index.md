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
[Get Postman Collection](http://rumu.top/docs/collection.json)

<!-- END_INFO -->

#Banner 管理


APIs for managing banners
<!-- START_400fb4764df1b01a1c10c5790a4e4f40 -->
## banner 列表

> Example request:

```bash
curl -X GET \
    -G "http://rumu.top/api/banners" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://rumu.top/api/banners"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

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
    "code": 1,
    "message": "",
    "data": [
        {
            "url": "http:\/\/rumu.top\/images\/d968056e630e50cd44f35d09be88b9b6.jpeg",
            "sort": 1
        },
        {
            "url": "http:\/\/rumu.top\/images\/0c21a129f37e0dc449151eeb4618c6c3.jpeg",
            "sort": 2
        },
        {
            "url": "http:\/\/rumu.top\/images\/0f20e90caecba31b7b19d27a8848a7b6.jpeg",
            "sort": 3
        },
        {
            "url": "http:\/\/rumu.top\/images\/85f793740bd8a5d2aa2ede66d243afdb.jpeg",
            "sort": 4
        }
    ]
}
```

### HTTP Request
`GET api/banners`


<!-- END_400fb4764df1b01a1c10c5790a4e4f40 -->

#团购

APIs for managing 团购
<!-- START_79c4340bc520ba7faf55fc7c0d013cc1 -->
## 获取团购分类

> Example request:

```bash
curl -X GET \
    -G "http://rumu.top/api/group/category/at" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://rumu.top/api/group/category/at"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

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
    "code": 1,
    "message": "",
    "data": {
        "id": 7,
        "issue": 7,
        "start_at": "2020-04-12 23:14:07",
        "end_at": "2020-04-15 23:14:13",
        "status": 1,
        "category": [
            {
                "category": "龙钞补号"
            },
            {
                "category": "渣打150"
            },
            {
                "category": "航天号"
            },
            {
                "category": "荷花钞"
            }
        ]
    }
}
```

### HTTP Request
`GET api/group/category/{group_id?}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `group_id` |  optional  | 团购 ID，不传则为当前团购的ID

<!-- END_79c4340bc520ba7faf55fc7c0d013cc1 -->

<!-- START_cd0989d58a35300421075d377cb10925 -->
## 获取最近一个小时后开始或者正在进行中的的团购

> Example request:

```bash
curl -X GET \
    -G "http://rumu.top/api/group?page=mollitia&limit=perferendis&category=sit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://rumu.top/api/group"
);

let params = {
    "page": "mollitia",
    "limit": "perferendis",
    "category": "sit",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

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
    "code": 1,
    "message": "",
    "data": {
        "current_page": 1,
        "list": [
            {
                "id": 145,
                "group_id": 7,
                "sn": "U9T0069000",
                "category": "龙钞补号",
                "score": " 67E",
                "sn_no": "豹子号",
                "low_price": 20000,
                "top_price": 40000,
                "bid": {
                    "user_id": 2,
                    "nickname": "zzz",
                    "price": 36002
                }
            },
            {
                "id": 146,
                "group_id": 7,
                "sn": "U9T0069001",
                "category": "龙钞补号",
                "score": " 68E",
                "sn_no": "豹子号",
                "low_price": 20100,
                "top_price": 40100,
                "bid": {
                    "user_id": 3,
                    "nickname": "yyy",
                    "price": 35102
                }
            }
        ],
        "total": 12,
        "joined": [
            {
                "id": 5,
                "user_id": 2,
                "group_id": 7,
                "goods_id": 145,
                "price": 36002,
                "status": 1,
                "goods": {
                    "id": 145,
                    "group_id": 7,
                    "sn": "U9T0069000",
                    "category": "龙钞补号",
                    "score": " 67E",
                    "sn_no": "豹子号",
                    "low_price": 20000,
                    "top_price": 40000,
                    "bid": {
                        "user_id": 2,
                        "nickname": "zzz",
                        "price": 36002
                    }
                }
            },
            {
                "id": 8,
                "user_id": 2,
                "group_id": 7,
                "goods_id": 146,
                "price": 35101,
                "status": 2,
                "goods": {
                    "id": 146,
                    "group_id": 7,
                    "sn": "U9T0069001",
                    "category": "龙钞补号",
                    "score": " 68E",
                    "sn_no": "豹子号",
                    "low_price": 20100,
                    "top_price": 40100,
                    "bid": {
                        "user_id": 3,
                        "nickname": "yyy",
                        "price": 35102
                    }
                }
            }
        ]
    }
}
```

### HTTP Request
`GET api/group`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `page` |  required  | string  页码
    `limit` |  required  | string  每页展示数量，默认15
    `category` |  required  | string 商品分类

<!-- END_cd0989d58a35300421075d377cb10925 -->

<!-- START_574eb03c7487fd3b774a8fdd1b988fc9 -->
## 参与竞价

> Example request:

```bash
curl -X POST \
    "http://rumu.top/api/group" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"goods_id":17,"group_id":7,"price":5}'

```

```javascript
const url = new URL(
    "http://rumu.top/api/group"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "goods_id": 17,
    "group_id": 7,
    "price": 5
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/group`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `goods_id` | integer |  required  | 商品 ID
        `group_id` | integer |  required  | 团购 ID
        `price` | integer |  required  | 出价（分）
    
<!-- END_574eb03c7487fd3b774a8fdd1b988fc9 -->

<!-- START_9bfd1aa1092fc96c4aadc47e16b5e31f -->
## 获取该商品当前团购价(分)

> Example request:

```bash
curl -X GET \
    -G "http://rumu.top/api/group/current/price/eum" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://rumu.top/api/group/current/price/eum"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

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
    "code": 1,
    "message": "",
    "data": 36002
}
```

### HTTP Request
`GET api/group/current/price/{goods_id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `goods_id` |  required  | int 商品 ID

<!-- END_9bfd1aa1092fc96c4aadc47e16b5e31f -->

<!-- START_fbd217206b7ff0dd4115c12269ae3546 -->
## 我参与的团购

> Example request:

```bash
curl -X GET \
    -G "http://rumu.top/api/group/my?page=libero&limit=inventore" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://rumu.top/api/group/my"
);

let params = {
    "page": "libero",
    "limit": "inventore",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

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
    "code": 1,
    "message": "",
    "data": {
        "current_page": 1,
        "list": [
            {
                "id": 5,
                "user_id": 2,
                "group_id": 7,
                "goods_id": 145,
                "price": 36002,
                "status": 1,
                "bid_status": 0,
                "config": {
                    "id": 7,
                    "issue": 7,
                    "start_at": "2020-04-11 23:14:07",
                    "end_at": "2020-04-14 23:14:13"
                },
                "goods": {
                    "id": 145,
                    "group_id": 7,
                    "sn": "U9T0069000",
                    "category": "龙钞补号",
                    "score": " 67E",
                    "sn_no": "豹子号",
                    "low_price": 20000,
                    "top_price": 40000
                }
            },
            {
                "id": 8,
                "user_id": 2,
                "group_id": 7,
                "goods_id": 146,
                "price": 35101,
                "status": 2,
                "bid_status": 0,
                "config": {
                    "id": 7,
                    "issue": 7,
                    "start_at": "2020-04-11 23:14:07",
                    "end_at": "2020-04-14 23:14:13"
                },
                "goods": {
                    "id": 146,
                    "group_id": 7,
                    "sn": "U9T0069001",
                    "category": "龙钞补号",
                    "score": " 68E",
                    "sn_no": "豹子号",
                    "low_price": 20100,
                    "top_price": 40100
                }
            },
            {
                "id": 4,
                "user_id": 2,
                "group_id": 5,
                "goods_id": 43,
                "price": 34000,
                "status": 1,
                "bid_status": 1,
                "config": {
                    "id": 5,
                    "issue": 5,
                    "start_at": "2020-04-09 11:46:03",
                    "end_at": "2020-04-09 18:46:07"
                },
                "goods": {
                    "id": 43,
                    "group_id": 5,
                    "sn": "U9T0069000",
                    "category": "龙钞补号",
                    "score": " 67E",
                    "sn_no": "豹子号",
                    "low_price": 20000,
                    "top_price": 40000
                }
            }
        ],
        "total": 3
    }
}
```

### HTTP Request
`GET api/group/my`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `page` |  optional  | 页码 默认 1
    `limit` |  optional  | 每页条数 默认15

<!-- END_fbd217206b7ff0dd4115c12269ae3546 -->

#往期团购


APIs for managing 往期团购
<!-- START_7d36bcda012ed60b6ecbdae9d934ca52 -->
## 往期团购列表

> Example request:

```bash
curl -X GET \
    -G "http://rumu.top/api/group/history?page=nulla&limit=libero" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://rumu.top/api/group/history"
);

let params = {
    "page": "nulla",
    "limit": "libero",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

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
    "code": 1,
    "message": "",
    "data": {
        "current_page": 1,
        "list": [
            {
                "id": 6,
                "issue": 6,
                "start_at": "2020-04-10 08:15:16",
                "end_at": "2020-04-11 08:15:18"
            },
            {
                "id": 5,
                "issue": 5,
                "start_at": "2020-04-09 11:46:03",
                "end_at": "2020-04-09 18:46:07"
            }
        ],
        "total": 2
    }
}
```

### HTTP Request
`GET api/group/history`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `page` |  optional  | 页码 默认 1
    `limit` |  optional  | 每页条数 默认15

<!-- END_7d36bcda012ed60b6ecbdae9d934ca52 -->

<!-- START_e8ceda0cc8200028e6aec27ea3437230 -->
## 往期团购详情

> Example request:

```bash
curl -X GET \
    -G "http://rumu.top/api/group/history/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://rumu.top/api/group/history/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

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
    "code": 1,
    "message": "",
    "data": {
        "id": 1,
        "issue": 1,
        "start_at": "2020-04-01 10:01:26",
        "end_at": "2020-04-02 10:01:35",
        "goods": [
            {
                "category": "龙钞补号",
                "goods": [
                    {
                        "id": 1,
                        "group_id": 1,
                        "sn": "U9T0069000",
                        "category": "龙钞补号",
                        "score": " 67E",
                        "sn_no": "豹子号",
                        "low_price": 20000,
                        "top_price": 40000,
                        "bid": {
                            "user_id": 1,
                            "nickname": "赵亚博²º²º",
                            "price": 20000
                        }
                    },
                    {
                        "id": 2,
                        "group_id": 1,
                        "sn": "U9T0069001",
                        "category": "龙钞补号",
                        "score": " 68E",
                        "sn_no": "豹子号",
                        "low_price": 20100,
                        "top_price": 40100,
                        "bid": []
                    }
                ]
            }
        ],
        "status": 2
    }
}
```

### HTTP Request
`GET api/group/history/{history}`


<!-- END_e8ceda0cc8200028e6aec27ea3437230 -->

#微信 management

APIs for managing 微信配置
<!-- START_a684f87f850fea0223c26d0a7a028748 -->
## 展示微信号和二维码

> Example request:

```bash
curl -X GET \
    -G "http://rumu.top/api/wechat" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://rumu.top/api/wechat"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

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
    "code": 1,
    "message": "",
    "data": {
        "wechat_account": "yable",
        "qrcode": "http:\/\/rumu.top\/images\/81daa075b84e3825d897f6e5543cab2d.jpeg"
    }
}
```

### HTTP Request
`GET api/wechat`


<!-- END_a684f87f850fea0223c26d0a7a028748 -->

#登录授权

APIs for managing 登录授权
<!-- START_a925a8d22b3615f12fca79456d286859 -->
## 小程序登录

> Example request:

```bash
curl -X POST \
    "http://rumu.top/api/auth/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"code":"atque","iv":"repudiandae","encryptedData":"necessitatibus"}'

```

```javascript
const url = new URL(
    "http://rumu.top/api/auth/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "code": "atque",
    "iv": "repudiandae",
    "encryptedData": "necessitatibus"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/auth/login`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `code` | string |  required  | wx.login() 获取
        `iv` | string |  required  | 加密算法的初始向量 IV.
        `encryptedData` | string |  required  | 包括敏感数据在内的完整用户信息的加密数据.
    
<!-- END_a925a8d22b3615f12fca79456d286859 -->

<!-- START_994af8f47e3039ba6d6d67c09dd9e415 -->
## Refresh a token.

刷新token，如果开启黑名单，以前的token便会失效。
值得注意的是用上面的getToken再获取一次Token并不算做刷新，两次获得的Token是并行的，即两个都可用。

> Example request:

```bash
curl -X POST \
    "http://rumu.top/api/auth/refresh" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://rumu.top/api/auth/refresh"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/auth/refresh`


<!-- END_994af8f47e3039ba6d6d67c09dd9e415 -->

<!-- START_a47210337df3b4ba0df697c115ba0c1e -->
## Get the authenticated User.

> Example request:

```bash
curl -X POST \
    "http://rumu.top/api/auth/me" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://rumu.top/api/auth/me"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/auth/me`


<!-- END_a47210337df3b4ba0df697c115ba0c1e -->


