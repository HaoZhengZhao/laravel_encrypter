## 如何使用
> 下载 `bin` 目录下的 `console` 文件,存储在任意目录下


### 加载配置

#### 方案1: 添加环境变量

```
export APP_KEY=xxx
```

#### 方案2: 在同级目录下创建 `.env` 文件, 内容如下

```
APP_KEY=xxx # xxx 可以使用 php console app:key 生成
```

### 可用命令
> 进入到 `console` 所在目录

#### 加密字符串

```
./console app:encrypt xxx
或
php console app:encrypt xxx
```

#### 解密字符串

```
php console app:decrypt xxx
```

#### 生成`APP_KEY`

```
php console app:key
```

### 注意事项

> 加密和解密需要使用相同的 APP_KEY


### 参与开发

>php 要求: ~7.3.0 || ~8.0

```
composer install
```

#### 配置`.env`

```
cp .env.example .env
```

#### 参考文档
https://symfony.com/doc/5.4/components/console.html

#### 打包为 phar

-  全局安装 box
> 请确保全局的 `composer bin` 目录在环境变量下，安装完成后会具有 `box` 命令

```
composer global require humbug/box
```

- 打包命令
> 在项目根目录下执行

```
box compile
```