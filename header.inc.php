
<!doctype html>
<html>
<head>

    <meta http-equiv="content-type" content="text/html" charset="utf-8"/>
    <link href="bootstrap.css" rel="stylesheet" type="text/css">
    <link href="bootstrap1.css" rel="stylesheet" type="text/css">
    <link href="bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="bootstrap-responsive.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="device-wdith,initial-scale=1.0">

    <script type="text/javascript" src="jquery.min.js"></script>
    <script type="text/javascript" src="bootstrap.js"></script>
    <title>新闻发布系统</title>
</head>
<body>
<!--<h1 class="page-header"></h1>-->
<!--<h1 class="page-header"></h1>-->
<?php
error_reporting(0);
//判断当前是否为管理模式，如果是，则显示管理导航
if ($_SESSION["admin"] == "1") {

    ?>
    <div class="container">
<!--        <h1 class="page-header">新闻发布系统</h1>-->

<!--        <div class="alert alert-block">-->
<!--            <a href="#" class="close" data-dismiss="alert">×</a>-->
<!--            <h4>提示</h4>-->
<!--            你已经登陆为管理员，当前为管理模式。-->
<!--        </div>-->
        <div class="navbar-fixed-top">
            <div class="navbar">
                <div class="navbar-inner">
                    <div class="container">
                        <a class="brand" href="#">会员管理系统</a>
                        <ul class="nav pull-left">
                            <li class="active"><a href="#">首页</a></li>
                            <li><a href="#">添加新闻</a></li>
                            <li><a href="#">添加栏目</a></li>
                        </ul>
                        <ul class="nav pull-right">
                            <?php if(!$_SESSION["admin"]) { ?>
                                <a href="login.php" class="navLink">管理员登陆</a>
                            <?php }?>
                        </ul>
                        <!--                    <form class=" navbar-search">-->
                        <!--                        <input type="text" class="search-query">-->
                        <!--                    </form>-->
                        <!--                    <ul class="nav pull-right">-->
                        <!--                        <li ><a href="#">登陆</a></li>-->
                        <!--                        <li class="divider-vertical"><a href="#"></a></li>-->
                        <!--                        <li><a href="#">注册</a></li>-->
                        <!--                    </ul>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
//
?>





<div class="container">

    <!-- Static navbar -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">新闻发布系统</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">首页</a></li>
                    <li><a href="#">所有分类</a></li>
                    <?php
                    //检索 category 表，按 order_id 排序，并在页面上显示所有栏目名
                    include("dbconnect.php");

                    $res = mysql_query("select * from category order by order_id");
                    while ($row = mysql_fetch_array($res)) {
                        $categorys[$row["id"]] = $row["category_name"];
                        echo "  <li ><a href='list.php?category={$row['id']}'>{$row['category_name']}</a></li>";
                        //如果当前是管理模式，则显示栏目的编辑链接
                        if ($_SESSION["admin"]) {
                            echo ' [<li><a href="admin_editcategory.php?id=' . $row['id'] . '">
                                                                			<font color="blue">编辑</font></a></li>]';
                        }
                    }
                    ?>

<!--                    <li class="dropdown">-->
<!--                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>-->
<!--                        <ul class="dropdown-menu" role="menu">-->
<!--                            <li><a href="#">Action</a></li>-->
<!--                            <li><a href="#">Another action</a></li>-->
<!--                            <li><a href="#">Something else here</a></li>-->
<!--                            <li class="divider"></li>-->
<!--                            <li class="dropdown-header">Nav header</li>-->
<!--                            <li><a href="#">Separated link</a></li>-->
<!--                            <li><a href="#">One more separated link</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li ><a href="#login" data-toggle="modal">登录</a></li>
                    <li><a href="register.php">注册</a></li>

                </ul>
            </div><!--/.nav-collapse -->

            <?php
            include("login.php");
            ?>
        </div><!--/.container-fluid -->
    </nav>

    <!-- Main component for a primary marketing message or call to action -->





