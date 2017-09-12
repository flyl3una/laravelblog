### 技术介绍
- 此博客后台使用的 laravel5.4 MVC 框架。

- 页面前端布局使用 materialize0.97.8 库。

- 后台博客编辑使用的editor.md，仅支持markdown格式。

- 图标使用的阿里的 iconfont。

- 使用 echarts 制作后台首页系统信息仪表盘。

- 使用 bower 安装各种库

- 使用 compass 编译 scss 到 css 文件。 

### 安装方法
1. 修改项目跟目录下的 .env 环境，参照.env.example
2. 进入项目根目录。
3. 使用 `bower install` 命令安装库。
4. 执行 `php artisan migrate` 同步数据库
5. 执行 `php artisan db:seed` 生成数据库填充数据

### 功能支持
- 后台
    - 文章增删改查
    - 目录增删改查
    - 标签增删改查
    - 友情连接增删改查
- 前台
    - 博客显示
    - 根据目录查看
    - 文章归档
    - 标题搜索
- 用户
    - 单管理员登录
    
### 使用截图
- 首页
![]('https://github.com/flyl3una/laravelblog/tree/master/public/screen/1.png')
- 查看文章
![]('https://github.com/flyl3una/laravelblog/tree/master/public/screen/2.png')
- 归档
![]('https://github.com/flyl3una/laravelblog/tree/master/public/screen/3.png')
- 后台
![]('https://github.com/flyl3una/laravelblog/tree/master/public/screen/4.png')
- 文章列表
![]('https://github.com/flyl3una/laravelblog/tree/master/public/screen/5.png')
- 创建文章
![]('https://github.com/flyl3una/laravelblog/tree/master/public/screen/6.png')
- 目录分类
![]('https://github.com/flyl3una/laravelblog/tree/master/public/screen/7.png')
### 附注
1. 后台一些不重要的功能没做完，一些细节已被忽略。
2. 文章搜索功能可以使用scout。需要自己注册algolia账号，并在.env中进行配置。