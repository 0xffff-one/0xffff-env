# 0xFFFF Env
[0xFFFF](https://0xffff.one) 社区网站基础环境配置，基于 Docker, Docker Compose 构建

## 技术栈
标准的 LNMP 架构
* Nginx: 静态文件服务器，fastcgi 反代
* PHP-FPM: PHP 运行时
* MySQL: 数据库服务
* [Sonic](https://github.com/ganuonglachanh/flarum-sonic): Flarum 中文搜索支持

## 配置
在启动前，需在根目录创建 `.env` 文件，`docker-compose.yml` 加载时会替换其中内容。  
`.env` 的内容例子：
```
DB_NAME=flarum
DB_USER=flarum_0xffff
DB_PASS=748OwVlAvgmj
DB_ROOT_PASS=mcXu71c90rIu
```

## LICENSE
MIT
