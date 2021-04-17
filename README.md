# REST API with Laravel Microservices Lumen

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://img.shields.io/packagist/v/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://img.shields.io/packagist/l/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)

### API Methods
List of basic routes:

- employees
- products
- categories
- suppliers
- orders

List of routes:

| Route           | HTTP    | Descriptions                    |
| :-------------  | :------ | :------------------------------ |
| `/api/v1/employees`    | GET     | Get all the users               |
| `/api/v1/employees/:id`    | GET     | Get single user              |
| `/api/v1/employees`    | POST  | Create new user              |
| `/api/v1/employees/:id`    | PUT  | Update data user              |
| `/api/v1/employees/:id`    | DELETE  | Remove user              |

List of paging routes:

| Route | HTTP     | Descriptions |
| :------------- | :------------- |:------------- |
| `/api/v1/employees?page="{page}"`| GET | Get employees with paging |

---
### Usage
With only run:
```
php -S localhost:8000 -t public

```

Access the website via `http://localhost:8000/api/{endpointName}`.

