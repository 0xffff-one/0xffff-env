# 0xFFFF Env
[0xFFFF](https://0xffff.one) 社区网站基础环境配置，基于 Docker, Docker Compose 构建

2022.5.15 更新：环境相关配置已整合至 [0xffff-flarum](https://github.com/0xffff-one/0xffff-flarum)，本项目废弃

---------

## 技术栈
标准的 LNMP 架构
* Nginx: 静态文件服务器，fastcgi 反代
* PHP-FPM: PHP 运行时，[0xffff-flarum](https://github.com/0xffff-one/0xffff-flarum) 已自带合适的 fpm 容器配置
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

线上会直接用 [0xffff-flarum](https://github.com/0xffff-one/0xffff-flarum) 构建好并上传到 DockerHub 的 [容器](https://hub.docker.com/r/zgq354/0xffff-flarum) 来跑，生产机器不再需要手动克隆代码。

启动前需保证本地挂载的 `config.php` 存在于 `data/app` 目录中，暂不支持在线安装（此处待完善）。

## 本地开发
本地开发环境不依赖容器，在线上环境的基础上，需要单独绑定代码目录，通过另一个 compose 配置来启动
```
# 链接到 0xffff-flarum 的本地开发目录
ln -s wwwroot /path/to/0xffff-flarum
# 使用非默认 docker-compose.yml 启动（这时不加载构建好的容器，而是用自定义 php-fpm 与本地文件绑定
docker-compose -f docker-compose.dev.yml up -d
```

## LICENSE
MIT
