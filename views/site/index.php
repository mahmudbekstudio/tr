<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Dashboard';
$this->params['bodyClass'] = 'dashboard';
?>
<div id="wrapper">

    <div id="page-wrapper" class="white-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
                <?php /*<div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    <form role="search" class="navbar-form-custom" action="search_results.html">
                        <div class="form-group">
                            <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                        </div>
                    </form>
                </div>*/ ?>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">Welcome to INSPINIA+ Admin Theme.</span>
                    </li>
                    <?php /*<li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                        </a>
                        <ul class="dropdown-menu dropdown-messages">
                            <li>
                                <div class="dropdown-messages-box">
                                    <a href="profile.html" class="pull-left">
                                        <img alt="image" class="img-circle" src="img/a7.jpg">
                                    </a>
                                    <div class="media-body">
                                        <small class="pull-right">46h ago</small>
                                        <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                        <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="dropdown-messages-box">
                                    <a href="profile.html" class="pull-left">
                                        <img alt="image" class="img-circle" src="img/a4.jpg">
                                    </a>
                                    <div class="media-body ">
                                        <small class="pull-right text-navy">5h ago</small>
                                        <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                        <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="dropdown-messages-box">
                                    <a href="profile.html" class="pull-left">
                                        <img alt="image" class="img-circle" src="img/profile.jpg">
                                    </a>
                                    <div class="media-body ">
                                        <small class="pull-right">23h ago</small>
                                        <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                        <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="text-center link-block">
                                    <a href="mailbox.html">
                                        <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            <li>
                                <a href="mailbox.html">
                                    <div>
                                        <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="profile.html">
                                    <div>
                                        <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                        <span class="pull-right text-muted small">12 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="grid_options.html">
                                    <div>
                                        <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="text-center link-block">
                                    <a href="notifications.html">
                                        <strong>See All Alerts</strong>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>*/ ?>


                    <li>
                        <a href="<?php echo Url::to('site/logout') ?>">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>

            </nav>
        </div>
        <?php /*<div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-4">
                <h2>This is main title</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="index.html">This is</a>
                    </li>
                    <li class="active">
                        <strong>Breadcrumb</strong>
                    </li>
                </ol>
            </div>
            <div class="col-sm-8">
                <div class="title-action">
                    <a href="" class="btn btn-primary">This is action area</a>
                </div>
            </div>
        </div>*/ ?>

        <div class="wrapper wrapper-content">
            <?php /*<header id="logos">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-5">
                            <h1 class="text-center">Logo #1</h1>
                        </div><!-- col -->
                        <div class="col-sm-7">
                            <h1 class="text-center">Logo #2</h1>
                        </div><!-- col -->
                    </div><!-- row -->
                </div><!-- container-fluid -->
            </header><!-- logos -->*/ ?>

            <main class="site-content">

                <div class="container-fluid">
                    <div class="row site-content-row">
                        <div class="col-sm-6 site-content-col1 basket-side">
                            <div class="basket">
                                <div class="basket-table">
                                    <div class="custom-basket-table clearfix">
                                        <div class="custom-basket-table-head">
                                            <div class="col-sm-12">
                                                <div class="custom-basket-table-tr row">
                                                    <div class="custom-basket-table-th col-sm-4">Название</div>
                                                    <div class="custom-basket-table-th col-sm-2">Кол-во</div>
                                                    <div class="custom-basket-table-th col-sm-2">Цена</div>
                                                    <div class="custom-basket-table-th col-sm-3">Сумма</div>
                                                    <div class="custom-basket-table-th col-sm-1"><a href="#" class="btn btn-default text-center basket-goods-clear">X</a></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="custom-basket-table-body clearfix ">
                                            <div class="custom-basket-table-tr row custom-basket-table-tr-example hidden" data-goods-id="">
                                                <div class="custom-basket-table-td col-md-4 custom-basket-table-td-title goods-name"></div>
                                                <div class="custom-basket-table-td col-md-2 goods-count"></div>
                                                <div class="custom-basket-table-td col-md-2 goods-price"></div>
                                                <div class="custom-basket-table-td col-md-3 goods-total-price"></div>
                                                <div class="custom-basket-table-td custom-basket-table-td-action col-md-1"><a href="#" class="btn btn-default text-center basket-goods-remove">–</a></div>
                                            </div>
                                            <div class="col-sm-12 custom-basket-table-body-list">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="checkout">
                                <section class="buttons">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-bordered table-responsive">

                                                <tr>
                                                    <td>Итого</td>
                                                    <td class="basket-total-price">0</td>
                                                </tr>

                                            </table>
                                        </div><!-- col -->
                                    </div><!-- row -->

                                    <div class="row">
                                        <div class="col-sm-3 text-center">
                                            <a href="#" class="btn btn-lg btn-default basket-goods-clear"><i class="fa fa-lg fa-trash"></i> <span class="hidden-sm hidden-xs hidden-md">Отмена</span></a>
                                        </div><!-- col -->
                                        <div class="col-sm-3 text-center">
                                            <a href="#" class="btn btn-lg btn-warning basket-goods-save"><i class="fa fa-lg fa-save"></i> <span class="hidden-sm hidden-xs hidden-md">Сохранить</span></a>
                                        </div>
                                        <div class="col-sm-3 text-center">
                                            <a href="#" class="btn btn-lg btn-info basket-goods-return-saved"><i class="fa fa-lg fa-arrow-circle-up"></i> <span class="hidden-sm hidden-xs hidden-md">Вызвать</span></a>
                                        </div>
                                        <div class="col-sm-3 text-center">
                                            <a href="#" class="btn btn-lg btn-success basket-goods-pay" data-toggle="modal" data-target="#stepTwoModal"><i class="fa fa-lg fa-money" aria-hidden="true"></i> <span class="hidden-sm hidden-xs hidden-md">Оплатить</span></a>
                                        </div>
                                    </div><!-- row -->
                                </section><!-- buttons -->
                            </div>
                        </div>
                        <div class="col-sm-6 site-content-col1 saved-basket-side">


                            <div class="basket">
                                <div class="basket-table">
                                    <div class="custom-basket-table clearfix">
                                        <div class="custom-basket-table-head">
                                            <div class="col-sm-12">
                                                <div class="custom-basket-table-tr row">
                                                    <div class="custom-basket-table-th col-sm-3">Время</div>
                                                    <div class="custom-basket-table-th col-sm-5">Наименования</div>
                                                    <div class="custom-basket-table-th col-sm-3">Сумма</div>
                                                    <div class="custom-basket-table-th col-sm-1"><a href="#" class="btn btn-default text-center saved-basket-clear">X</a></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="custom-basket-table-body clearfix ">
                                            <div class="custom-basket-table-tr row custom-saved-basket-table-tr-example hidden" data-saved-basket-time="">
                                                <div class="custom-basket-table-td col-md-3 custom-saved-basket-table-td-title saved-basket-date"></div>
                                                <div class="custom-basket-table-td col-md-5 saved-basket-name"></div>
                                                <div class="custom-basket-table-td col-md-3 saved-basket-total-price"></div>
                                                <div class="custom-basket-table-td custom-saved-basket-table-td-action col-md-1"><a href="#" class="btn btn-default text-center saved-basket-goods-return"><i class="fa fa-reply-all" aria-hidden="true"></i></a></div>
                                            </div>
                                            <div class="col-sm-12 custom-saved-basket-table-body-list">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="checkout">
                                <section class="buttons">

                                    <div class="row">
                                        <div class="col-sm-6 text-center">
                                            <a href="#" class="btn btn-lg btn-default saved-basket-clear"><i class="fa fa-lg fa-trash"></i> <span class="hidden-sm hidden-xs hidden-md">Очистить</span></a>
                                        </div><!-- col -->
                                        <div class="col-sm-6 text-center">
                                            <a href="#" class="btn btn-lg btn-warning saved-basket-close"><i class="fa fa-lg fa-arrow-left"></i> <span class="hidden-sm hidden-xs hidden-md">Назад</span></a>
                                        </div>
                                    </div><!-- row -->
                                </section><!-- buttons -->
                            </div>
                        </div>
                        <div class="col-sm-6 site-content-col2">
                            <section class="categories">

                                <ul class="nav nav-pills" role="tablist">

                                    <?php $k = 0; foreach($categoryList as $item) :  ?>
                                        <li role="presentation" class="<?php echo ($k == 0 ? 'active' : '') ?>">
                                            <a href="#category_<?php echo $item['id'] ?>" aria-controls="category_<?php echo $item['id'] ?>" role="tab" data-toggle="pill"><?php echo $item['name'] ?></a>
                                        </li>
                                        <?php $k++; endforeach; ?>

                                </ul><!-- nav-pills -->

                            </section><!-- categories -->

                            <section class="mealMenu">

                                <div class="tab-content">
                                    <?php $k = 0; foreach($categoryList as $item) : ?>
                                        <div class="tab-pane fade<?php echo ($k == 0 ? ' in active' : '') ?>" role="tabpanel" id="category_<?php echo $item['id'] ?>">
                                            <div class="meals">

                                                <div class="row">
                                                    <?php
                                                    foreach($goodsList as $val) :
                                                        if($val['category_id'] != $item['id'])
                                                            continue;
                                                        ?>
                                                        <div class="col-sm-4">
                                                            <a href="#" class="goods-item" data-id="<?php echo $val['id'] ?>" data-name="<?php echo $val['name'] ?>" data-price="<?php echo $val['sell_price'] ?>">
                                                                <div class="thumbnail">
                                                                    <img style="background-image: url('<?php echo Yii::$app->urlManager->baseUrl; ?>/<?php echo $val['pic'] ?>')" src="<?php echo Yii::$app->urlManager->baseUrl; ?>/img/thumb-image.png" alt="<?php echo $val['name'] ?>" class="img-responsive" title="<?php echo $val['name'] ?>">
                                                                    <div class="caption">
                                                                        <strong class="goods-item-title" title="<?php echo $val['name'] ?>"><?php echo $val['name'] ?></strong>
                                                                        <span class="price"><?php echo $val['sell_price'] ?> so`m</span>
                                                                        <span class="price-shadow"><?php echo $val['sell_price'] ?> so`m</span>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    <?php endforeach; ?>

                                                </div><!-- row -->

                                            </div><!-- meals -->
                                        </div><!-- tab-pane -->
                                        <?php $k++; endforeach; ?>

                                </div><!-- tab-content -->

                            </section><!-- mealMenu -->
                        </div>
                        <?php /*
                        <section class="col-sm-5 calcs">

                            <div class="row">
                                <div class="col-sm-12">

                                    <table class="table table-striped table-bordered mealList">

                                        <thead>
                                        <tr>
                                            <th>Название</th>
                                            <th>Кол-во</th>
                                            <th>Цена</th>
                                            <th>Сумма</th>
                                            <th>X</th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        <tr>
                                            <td>Mastava</td>
                                            <td>2</td>
                                            <td>4000</td>
                                            <td>8000</td>
                                            <td><a href="#" class="btn btn-default text-center">–</a></td>
                                        </tr>

                                        <tr>
                                            <td>Osh</td>
                                            <td>1</td>
                                            <td>5500</td>
                                            <td>5500</td>
                                            <td><a href="#" class="btn btn-default text-center">–</a></td>
                                        </tr>

                                        <tr>
                                            <td>Mastava</td>
                                            <td>2</td>
                                            <td>4000</td>
                                            <td>8000</td>
                                            <td><a href="#" class="btn btn-default text-center">–</a></td>
                                        </tr>

                                        <tr>
                                            <td>Osh</td>
                                            <td>1</td>
                                            <td>5500</td>
                                            <td>5500</td>
                                            <td><a href="#" class="btn btn-default text-center">–</a></td>
                                        </tr>

                                        <tr>
                                            <td>Mastava</td>
                                            <td>2</td>
                                            <td>4000</td>
                                            <td>8000</td>
                                            <td><a href="#" class="btn btn-default text-center">–</a></td>
                                        </tr>

                                        <tr>
                                            <td>Osh</td>
                                            <td>1</td>
                                            <td>5500</td>
                                            <td>5500</td>
                                            <td><a href="#" class="btn btn-default text-center">–</a></td>
                                        </tr>

                                        <tr>
                                            <td>Mastava</td>
                                            <td>2</td>
                                            <td>4000</td>
                                            <td>8000</td>
                                            <td><a href="#" class="btn btn-default text-center">–</a></td>
                                        </tr>

                                        <tr>
                                            <td>Osh</td>
                                            <td>1</td>
                                            <td>5500</td>
                                            <td>5500</td>
                                            <td><a href="#" class="btn btn-default text-center">–</a></td>
                                        </tr>

                                        <tr>
                                            <td>Mastava</td>
                                            <td>2</td>
                                            <td>4000</td>
                                            <td>8000</td>
                                            <td><a href="#" class="btn btn-default text-center">–</a></td>
                                        </tr>

                                        <tr>
                                            <td>Osh</td>
                                            <td>1</td>
                                            <td>5500</td>
                                            <td>5500</td>
                                            <td><a href="#" class="btn btn-default text-center">–</a></td>
                                        </tr>

                                        <tr>
                                            <td>Mastava</td>
                                            <td>2</td>
                                            <td>4000</td>
                                            <td>8000</td>
                                            <td><a href="#" class="btn btn-default text-center">–</a></td>
                                        </tr>

                                        <tr>
                                            <td>Osh</td>
                                            <td>1</td>
                                            <td>5500</td>
                                            <td>5500</td>
                                            <td><a href="#" class="btn btn-default text-center">–</a></td>
                                        </tr>

                                        <tr>
                                            <td>Mastava</td>
                                            <td>2</td>
                                            <td>4000</td>
                                            <td>8000</td>
                                            <td><a href="#" class="btn btn-default text-center">–</a></td>
                                        </tr>

                                        <tr>
                                            <td>Osh</td>
                                            <td>1</td>
                                            <td>5500</td>
                                            <td>5500</td>
                                            <td><a href="#" class="btn btn-default text-center">–</a></td>
                                        </tr>

                                        </tbody>

                                    </table>

                                </div><!-- col -->
                            </div><!-- row -->

                            <section class="buttons">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-bordered">

                                            <tr>
                                                <td>Итого</td>
                                                <td>13500</td>
                                            </tr>

                                        </table>
                                    </div><!-- col -->
                                </div><!-- row -->

                                <div class="row">
                                    <div class="col-sm-12">

                                        <a href="#" class="btn btn-lg btn-default">Отмена <i class="fa fa-lg fa-trash"></i></a>
                                        <a href="#" class="btn btn-lg btn-warning">Сохранить <i class="fa fa-lg fa-save"></i></a>
                                        <a href="#" class="btn btn-lg btn-info">Вызвать <i class="fa fa-lg fa-arrow-circle-up"></i></a>
                                        <a href="#" class="btn btn-lg btn-success" data-toggle="modal" data-target="#stepTwoModal">Оплатить</a>

                                    </div><!-- col -->
                                </div><!-- row -->
                            </section><!-- buttons -->

                        </section><!-- calcs -->

                        <section class="col-sm-7">

                            <div class="row">
                                <div class="col-sm-12">

                                    <section class="categories">

                                        <ul class="nav nav-pills" role="tablist">

                                            <li role="presentation" class="active">
                                                <a href="#breakfast" aria-controls="breakfast" role="tab" data-toggle="pill">Завтрак</a>
                                            </li>
                                            <li role="presentation">
                                                <a href="#firstMeal" aria-controls="firstMeal" role="tab" data-toggle="pill">
                                                    Первые блюда</a>
                                            </li>
                                            <li role="presentation">
                                                <a href="#secondMeal" aria-controls="secondMeal" role="tab" data-toggle="pill">Вторые блюда</a>
                                            </li>
                                            <li role="presentation">
                                                <a href="#salads" aria-controls="salads" role="tab" data-toggle="pill">Салаты</a>
                                            </li>
                                            <li role="presentation">
                                                <a href="#drinks" aria-controls="drinks" role="tab" data-toggle="pill">Напитки</a>
                                            </li>
                                            <li role="presentation">
                                                <a href="#tara" aria-controls="tara" role="tab" data-toggle="pill">Тара</a>
                                            </li>

                                        </ul><!-- nav-pills -->

                                    </section><!-- categories -->

                                    <section class="mealMenu">

                                        <div class="tab-content">

                                            <div class="tab-pane fade in active" role="tabpanel" id="breakfast">
                                                <div class="meals">

                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <a href="#">
                                                                <div class="thumbnail">
                                                                    <img src="img/blinchik.jpg" alt="Блинчик" class="img-responsive" title="Блинчик">
                                                                    <div class="caption">
                                                                        <strong>Блинчик</strong>
                                                                        <span class="pull-right">1000</span>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>

                                                        <div class="col-sm-3">
                                                            <a href="#">
                                                                <div class="thumbnail">
                                                                    <img src="img/blinchik-s-nachinkoy.jpg" alt="Блинчик с начинкой" class="img-responsive" title="Блинчик с начинкой">
                                                                    <div class="caption">
                                                                        <strong>Блинчик с начинкой</strong>
                                                                        <span class="pull-right">1500</span>
                                                                    </div><!-- caption -->
                                                                </div><!-- thumbnail -->
                                                            </a>
                                                        </div><!-- col -->

                                                        <div class="col-sm-3">
                                                            <a href="#">
                                                                <div class="thumbnail">
                                                                    <img src="img/omlet.jpg" alt="Омлет маленький" class="img-responsive" title="Омлет маленький">
                                                                    <div class="caption">
                                                                        <strong>Омлет маленький</strong>
                                                                        <span class="pull-right">2500</span>
                                                                    </div><!-- caption -->
                                                                </div><!-- thumbnail -->
                                                            </a>
                                                        </div><!-- col -->

                                                        <div class="col-sm-3">
                                                            <a href="#">
                                                                <div class="thumbnail">
                                                                    <img src="img/omletbig.jpg" alt="Омлет большой" class="img-responsive" title="Омлет большой">
                                                                    <div class="caption">
                                                                        <strong>Омлет большой</strong>
                                                                        <span class="pull-right">4000</span>
                                                                    </div><!-- caption -->
                                                                </div><!-- thumbnail -->
                                                            </a>
                                                        </div><!-- col -->

                                                    </div><!-- row -->

                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <a href="#">
                                                                <div class="thumbnail">
                                                                    <img src="img/yaichniylavash.jpg" alt="Яичный лаваш" class="img-responsive" title="Яичный лаваш">
                                                                    <div class="caption">
                                                                        <strong>Яичный лаваш</strong>
                                                                        <span class="pull-right">5000</span>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>

                                                        <div class="col-sm-3">
                                                            <a href="#">
                                                                <div class="thumbnail">
                                                                    <img src="img/bulochka-mak.jpg" alt="Булочки с маком" class="img-responsive" title="Булочки с маком">
                                                                    <div class="caption">
                                                                        <strong>Булочки с маком</strong>
                                                                        <span class="pull-right">1500</span>
                                                                    </div><!-- caption -->
                                                                </div><!-- thumbnail -->
                                                            </a>
                                                        </div><!-- col -->

                                                        <div class="col-sm-3">
                                                            <a href="#">
                                                                <div class="thumbnail">
                                                                    <img src="img/kasha.jpg" alt="Каша молочная" class="img-responsive" title="Каша молочная">
                                                                    <div class="caption">
                                                                        <strong>Каша молочная</strong>
                                                                        <span class="pull-right">3000</span>
                                                                    </div><!-- caption -->
                                                                </div><!-- thumbnail -->
                                                            </a>
                                                        </div><!-- col -->

                                                        <div class="col-sm-3">
                                                            <a href="#">
                                                                <div class="thumbnail">
                                                                    <img src="img/tvorog.jpg" alt="Творог со сметаной" class="img-responsive" title="Творог со сметаной">
                                                                    <div class="caption">
                                                                        <strong>Творог со сметаной</strong>
                                                                        <span class="pull-right">3000</span>
                                                                    </div><!-- caption -->
                                                                </div><!-- thumbnail -->
                                                            </a>
                                                        </div><!-- col -->

                                                    </div><!-- row -->

                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <a href="#">
                                                                <div class="thumbnail">
                                                                    <img src="img/smetana.jpg" alt="Сметана" class="img-responsive" title="Сметана">
                                                                    <div class="caption">
                                                                        <strong>Сметана</strong>
                                                                        <span class="pull-right">2500</span>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>

                                                        <div class="col-sm-3">
                                                            <a href="#">
                                                                <div class="thumbnail">
                                                                    <img src="img/syrnik-tvorozhnyj.jpg" alt="Сырник" class="img-responsive" title="Сырник">
                                                                    <div class="caption">
                                                                        <strong>Сырник</strong>
                                                                        <span class="pull-right">2500</span>
                                                                    </div><!-- caption -->
                                                                </div><!-- thumbnail -->
                                                            </a>
                                                        </div><!-- col -->

                                                        <div class="col-sm-3">
                                                            <a href="#">
                                                                <div class="thumbnail">
                                                                    <img src="img/omlet.jpg" alt="Яичница" class="img-responsive" title="Яичница">
                                                                    <div class="caption">
                                                                        <strong>Яичница</strong>
                                                                        <span class="pull-right">1200</span>
                                                                    </div><!-- caption -->
                                                                </div><!-- thumbnail -->
                                                            </a>
                                                        </div><!-- col -->

                                                        <div class="col-sm-3">
                                                            <a href="#">
                                                                <div class="thumbnail">
                                                                    <img src="img/sosiski.jpg" alt="Сосиски" class="img-responsive" title="Сосиски">
                                                                    <div class="caption">
                                                                        <strong>Сосиски</strong>
                                                                        <span class="pull-right">1500</span>
                                                                    </div><!-- caption -->
                                                                </div><!-- thumbnail -->
                                                            </a>
                                                        </div><!-- col -->

                                                    </div><!-- row -->

                                                </div><!-- meals -->
                                            </div><!-- tab-pane -->


                                            <div class="tab-pane fade" role="tabpanel" id="firstMeal">
                                                <div class="meals">

                                                </div><!-- meals -->
                                            </div><!-- tab-pane -->


                                            <div class="tab-pane fade" role="tabpanel" id="secondMeal">
                                                <div class="meals">

                                                </div><!-- meals -->
                                            </div><!-- tab-pane -->


                                            <div class="tab-pane fade" role="tabpanel" id="salads">
                                                <div class="meals">

                                                </div><!-- meals -->
                                            </div><!-- tab-pane -->


                                            <div class="tab-pane fade" role="tabpanel" id="drinks">
                                                <div class="meals">

                                                </div><!-- meals -->
                                            </div><!-- tab-pane -->


                                            <div class="tab-pane fade" role="tabpanel" id="tara">
                                                <div class="meals">

                                                </div><!-- meals -->
                                            </div><!-- tab-pane -->

                                        </div><!-- tab-content -->

                                    </section><!-- mealMenu -->

                                </div><!-- col -->
                            </div><!-- row -->

                        </section><!-- col -->
*/ ?>
                    </div><!-- row -->
                </div><!-- container-fluid -->

            </main><!-- site-content -->


            <!-- Modal -->
            <div class="modal fade" id="stepTwoModal" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Оплата</h4>
                        </div><!-- modal-header -->

                        <div class="modal-body">

                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <h3>Общая сумма: <span>21000</span></h3>
                                    <a href="#" class="btn btn-lg btn-success"><i class="fa fa-4x fa-credit-card"></i></a>
                                    <a href="#" class="btn btn-lg btn-success"><i class="fa fa-4x fa-money"></i></a>
                                </div><!-- col -->
                            </div><!-- row -->

                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <h4>Другие</h4>
                                    <a href="#" class="btn btn-lg btn-default">VIP #1</a>
                                </div><!-- col -->
                            </div><!-- row -->

                        </div><!-- modal-body -->

                    </div><!-- modal-content -->
                </div><!-- modal-dialog -->
            </div><!-- stepTwoModal -->
        </div>

    </div>
</div>