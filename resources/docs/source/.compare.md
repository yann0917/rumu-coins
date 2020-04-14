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
<!-- START_cd0989d58a35300421075d377cb10925 -->
## 获取最近一个小时后开始或者正在进行中的的团购

> Example request:

```bash
curl -X GET \
    -G "http://rumu.top/api/group" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://rumu.top/api/group"
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
        "start_at": "2020-04-11 23:14:07",
        "end_at": "2020-04-14 23:14:13",
        "goods": [
            {
                "category": "龙钞补号",
                "goods": [
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
                    },
                    {
                        "id": 147,
                        "group_id": 7,
                        "sn": "U9T0069002",
                        "category": "龙钞补号",
                        "score": " 69E",
                        "sn_no": "豹子号",
                        "low_price": 20200,
                        "top_price": 40200,
                        "bid": []
                    },
                    {
                        "id": 148,
                        "group_id": 7,
                        "sn": "U9T0069003",
                        "category": "龙钞补号",
                        "score": " 70E",
                        "sn_no": "豹子号",
                        "low_price": 20300,
                        "top_price": 40300,
                        "bid": []
                    },
                    {
                        "id": 149,
                        "group_id": 7,
                        "sn": "U9T0069004",
                        "category": "龙钞补号",
                        "score": " 71E",
                        "sn_no": "豹子号",
                        "low_price": 20400,
                        "top_price": 40400,
                        "bid": []
                    },
                    {
                        "id": 150,
                        "group_id": 7,
                        "sn": "U9T0069005",
                        "category": "龙钞补号",
                        "score": " 72E",
                        "sn_no": "豹子号",
                        "low_price": 20500,
                        "top_price": 40500,
                        "bid": []
                    },
                    {
                        "id": 151,
                        "group_id": 7,
                        "sn": "U9T0069006",
                        "category": "龙钞补号",
                        "score": " 73E",
                        "sn_no": "豹子号",
                        "low_price": 20600,
                        "top_price": 40600,
                        "bid": []
                    },
                    {
                        "id": 152,
                        "group_id": 7,
                        "sn": "U9T0069007",
                        "category": "龙钞补号",
                        "score": " 74E",
                        "sn_no": "豹子号",
                        "low_price": 20700,
                        "top_price": 40700,
                        "bid": []
                    },
                    {
                        "id": 153,
                        "group_id": 7,
                        "sn": "U9T0069008",
                        "category": "龙钞补号",
                        "score": " 75E",
                        "sn_no": "豹子号",
                        "low_price": 20800,
                        "top_price": 40800,
                        "bid": []
                    },
                    {
                        "id": 154,
                        "group_id": 7,
                        "sn": "U9T0069009",
                        "category": "龙钞补号",
                        "score": " 76E",
                        "sn_no": "豹子号",
                        "low_price": 20900,
                        "top_price": 40900,
                        "bid": []
                    },
                    {
                        "id": 155,
                        "group_id": 7,
                        "sn": "U9T0069010",
                        "category": "龙钞补号",
                        "score": " 77E",
                        "sn_no": "豹子号",
                        "low_price": 21000,
                        "top_price": 41000,
                        "bid": []
                    },
                    {
                        "id": 156,
                        "group_id": 7,
                        "sn": "U9T0069011",
                        "category": "龙钞补号",
                        "score": " 78E",
                        "sn_no": "豹子号",
                        "low_price": 21100,
                        "top_price": 41100,
                        "bid": []
                    }
                ]
            },
            {
                "category": "渣打150",
                "goods": [
                    {
                        "id": 157,
                        "group_id": 7,
                        "sn": "U9T0069012",
                        "category": "渣打150",
                        "score": " 79E",
                        "sn_no": "豹子号",
                        "low_price": 21200,
                        "top_price": 41200,
                        "bid": []
                    },
                    {
                        "id": 158,
                        "group_id": 7,
                        "sn": "U9T0069013",
                        "category": "渣打150",
                        "score": " 80E",
                        "sn_no": "豹子号",
                        "low_price": 21300,
                        "top_price": 41300,
                        "bid": []
                    },
                    {
                        "id": 159,
                        "group_id": 7,
                        "sn": "U9T0069014",
                        "category": "渣打150",
                        "score": " 81E",
                        "sn_no": "豹子号",
                        "low_price": 21400,
                        "top_price": 41400,
                        "bid": []
                    },
                    {
                        "id": 160,
                        "group_id": 7,
                        "sn": "U9T0069015",
                        "category": "渣打150",
                        "score": " 82E",
                        "sn_no": "豹子号",
                        "low_price": 21500,
                        "top_price": 41500,
                        "bid": []
                    },
                    {
                        "id": 161,
                        "group_id": 7,
                        "sn": "U9T0069016",
                        "category": "渣打150",
                        "score": " 83E",
                        "sn_no": "豹子号",
                        "low_price": 21600,
                        "top_price": 41600,
                        "bid": []
                    },
                    {
                        "id": 162,
                        "group_id": 7,
                        "sn": "U9T0069017",
                        "category": "渣打150",
                        "score": " 84E",
                        "sn_no": "豹子号",
                        "low_price": 21700,
                        "top_price": 41700,
                        "bid": []
                    },
                    {
                        "id": 163,
                        "group_id": 7,
                        "sn": "U9T0069018",
                        "category": "渣打150",
                        "score": " 85E",
                        "sn_no": "豹子号",
                        "low_price": 21800,
                        "top_price": 41800,
                        "bid": []
                    },
                    {
                        "id": 164,
                        "group_id": 7,
                        "sn": "U9T0069019",
                        "category": "渣打150",
                        "score": " 86E",
                        "sn_no": "豹子号",
                        "low_price": 21900,
                        "top_price": 41900,
                        "bid": []
                    }
                ]
            },
            {
                "category": "航天号",
                "goods": [
                    {
                        "id": 165,
                        "group_id": 7,
                        "sn": "U9T0069020",
                        "category": "航天号",
                        "score": " 87E",
                        "sn_no": "豹子号",
                        "low_price": 22000,
                        "top_price": 42000,
                        "bid": []
                    },
                    {
                        "id": 166,
                        "group_id": 7,
                        "sn": "U9T0069021",
                        "category": "航天号",
                        "score": " 88E",
                        "sn_no": "豹子号",
                        "low_price": 22100,
                        "top_price": 42100,
                        "bid": []
                    },
                    {
                        "id": 167,
                        "group_id": 7,
                        "sn": "U9T0069022",
                        "category": "航天号",
                        "score": " 89E",
                        "sn_no": "豹子号",
                        "low_price": 22200,
                        "top_price": 42200,
                        "bid": []
                    },
                    {
                        "id": 168,
                        "group_id": 7,
                        "sn": "U9T0069023",
                        "category": "航天号",
                        "score": " 90E",
                        "sn_no": "豹子号",
                        "low_price": 22300,
                        "top_price": 42300,
                        "bid": []
                    },
                    {
                        "id": 169,
                        "group_id": 7,
                        "sn": "U9T0069024",
                        "category": "航天号",
                        "score": " 91E",
                        "sn_no": "豹子号",
                        "low_price": 22400,
                        "top_price": 42400,
                        "bid": []
                    },
                    {
                        "id": 170,
                        "group_id": 7,
                        "sn": "U9T0069025",
                        "category": "航天号",
                        "score": " 92E",
                        "sn_no": "豹子号",
                        "low_price": 22500,
                        "top_price": 42500,
                        "bid": []
                    },
                    {
                        "id": 171,
                        "group_id": 7,
                        "sn": "U9T0069026",
                        "category": "航天号",
                        "score": " 93E",
                        "sn_no": "豹子号",
                        "low_price": 22600,
                        "top_price": 42600,
                        "bid": []
                    }
                ]
            },
            {
                "category": "荷花钞",
                "goods": [
                    {
                        "id": 172,
                        "group_id": 7,
                        "sn": "U9T0069027",
                        "category": "荷花钞",
                        "score": " 94E",
                        "sn_no": "豹子号",
                        "low_price": 22700,
                        "top_price": 42700,
                        "bid": []
                    },
                    {
                        "id": 173,
                        "group_id": 7,
                        "sn": "U9T0069028",
                        "category": "荷花钞",
                        "score": " 95E",
                        "sn_no": "豹子号",
                        "low_price": 22800,
                        "top_price": 42800,
                        "bid": []
                    },
                    {
                        "id": 174,
                        "group_id": 7,
                        "sn": "U9T0069029",
                        "category": "荷花钞",
                        "score": " 96E",
                        "sn_no": "豹子号",
                        "low_price": 22900,
                        "top_price": 42900,
                        "bid": []
                    },
                    {
                        "id": 175,
                        "group_id": 7,
                        "sn": "U9T0069030",
                        "category": "荷花钞",
                        "score": " 97E",
                        "sn_no": "豹子号",
                        "low_price": 23000,
                        "top_price": 43000,
                        "bid": []
                    },
                    {
                        "id": 176,
                        "group_id": 7,
                        "sn": "U9T0069031",
                        "category": "荷花钞",
                        "score": " 98E",
                        "sn_no": "豹子号",
                        "low_price": 23100,
                        "top_price": 43100,
                        "bid": []
                    },
                    {
                        "id": 177,
                        "group_id": 7,
                        "sn": "U9T0069032",
                        "category": "荷花钞",
                        "score": " 99E",
                        "sn_no": "豹子号",
                        "low_price": 23200,
                        "top_price": 43200,
                        "bid": []
                    },
                    {
                        "id": 178,
                        "group_id": 7,
                        "sn": "U9T0069033",
                        "category": "荷花钞",
                        "score": " 100E",
                        "sn_no": "豹子号",
                        "low_price": 23300,
                        "top_price": 43300,
                        "bid": []
                    }
                ]
            }
        ],
        "status": 1,
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


<!-- END_cd0989d58a35300421075d377cb10925 -->

<!-- START_574eb03c7487fd3b774a8fdd1b988fc9 -->
## 参与竞价

> Example request:

```bash
curl -X POST \
    "http://rumu.top/api/group" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"goods_id":1,"group_id":12,"price":1}'

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
    "goods_id": 1,
    "group_id": 12,
    "price": 1
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
## api/group/current/price/{goods_id}
> Example request:

```bash
curl -X GET \
    -G "http://rumu.top/api/group/current/price/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://rumu.top/api/group/current/price/1"
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
    "code": 0,
    "message": "Please make sure the PHP Redis extension is installed and enabled.",
    "data": {}
}
```

### HTTP Request
`GET api/group/current/price/{goods_id}`


<!-- END_9bfd1aa1092fc96c4aadc47e16b5e31f -->

<!-- START_fbd217206b7ff0dd4115c12269ae3546 -->
## 我参与的团购

> Example request:

```bash
curl -X GET \
    -G "http://rumu.top/api/group/my?page=corporis&limit=molestias" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://rumu.top/api/group/my"
);

let params = {
    "page": "corporis",
    "limit": "molestias",
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
    -G "http://rumu.top/api/group/history?page=autem&limit=consequatur" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://rumu.top/api/group/history"
);

let params = {
    "page": "autem",
    "limit": "consequatur",
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
    -d '{"code":"deserunt","iv":"earum","encryptedData":"voluptatem"}'

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
    "code": "deserunt",
    "iv": "earum",
    "encryptedData": "voluptatem"
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


