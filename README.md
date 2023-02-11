### install

>php 要求: ~7.3.0 || ~8.0

```
composer install
```

### how to use

#### 配置`.env`

```
cp .env.example .env
```

##### .env

```
APP_KEY=
```

#### 加密字符串

```
php console app:encrypt xxx
```

#### 解密字符串

```
php console app:decrypt xxx
```

#### 生成 APP_KEY

```
php console app:key
```

### notice

> 加密和解密需要使用相同的 APP_KEY

