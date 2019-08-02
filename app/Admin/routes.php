<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {
    $router->get('/', 'HomeController@index');
});

// 后台接口，无需授权
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
], function (Router $router) {
    $router->post('login', 'AdminPassportController@login');

    // to move to below
    $router->post('utils/upload_image', 'UploadImageController@upload');

    $router->get('download_phoneTemplate', 'CommunityPhoneController@download_phoneTemplate');
    $router->get('download_payTemplate', 'PaymentController@download_payTemplate');
    $router->get('download_roomTemplate', 'RoomController@download_roomTemplate');
    $router->get('download_bluetoothTemplate', 'BluetoothController@download_bluetoothTemplate');
    $router->post('registerid', 'JPushController@registerid');
});


/******************************小区管理****************************/
//活动管理*******增改查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_activity', 'auth:admin_api'],
], function (Router $router) {
    $router->get('activities', 'ActivityController@index');
    $router->get('activities/{id}', 'ActivityController@show');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,post_activity', 'auth:admin_api'],
], function (Router $router) {
    $router->post('activities', 'ActivityController@store');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,update_activity', 'auth:admin_api'],
], function (Router $router) {
    $router->put('activities/{id}', 'ActivityController@update');
});

// 公告管理*******增删改查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_notice', 'auth:admin_api'],
], function (Router $router) {
    $router->get('notices', 'NoticeController@index');
    $router->get('notices/{id}', 'NoticeController@show');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,post_notice', 'auth:admin_api'],
], function (Router $router) {
    $router->post('notices', 'NoticeController@store');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,update_notice', 'auth:admin_api'],
], function (Router $router) {
    $router->put('notices/{id}', 'NoticeController@update');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,del_notice', 'auth:admin_api'],
], function (Router $router) {
    $router->delete('notices/{id}', 'NoticeController@destroy');
});

//缴费管理*******增删改查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_payment', 'auth:admin_api'],
], function (Router $router) {
    $router->get('payment', 'PaymentController@index');
    $router->get('payment/{id}', 'PaymentController@show');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,post_payment', 'auth:admin_api'],
], function (Router $router) {
    $router->post('payment', 'PaymentController@store');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,update_payment', 'auth:admin_api'],
], function (Router $router) {
    $router->put('payment/{id}', 'PaymentController@update');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,del_payment', 'auth:admin_api'],
], function (Router $router) {
    $router->delete('payment/{id}', 'PaymentController@destroy');
});

//访客记录*******查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_visit', 'auth:admin_api'],
], function (Router $router) {
    $router->get('visit_records', 'VisitorRecordController@index');
    $router->get('visit_records/{id}', 'VisitorRecordController@show');
});

//房号相关*******增改查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_rooms', 'auth:admin_api'],
], function (Router $router) {
    $router->get('rooms', 'RoomController@index');
    $router->get('rooms_query', 'RoomController@rooms_query');
    $router->get('rooms/{id}', 'RoomController@show');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,post_rooms', 'auth:admin_api'],
], function (Router $router) {
    $router->post('rooms', 'RoomController@store');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,update_rooms', 'auth:admin_api'],
], function (Router $router) {
    $router->put('rooms/{id}', 'RoomController@update');
});
//审核房号
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,update_room', 'auth:admin_api'],
], function (Router $router) {
    $router->put('update_status/{id}', 'RoomController@update_status');
});

//小区相关*******增改查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,post_community', 'auth:admin_api'],
], function (Router $router) {
    $router->post('community', 'CommunityController@store');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,update_community', 'auth:admin_api'],
], function (Router $router) {
    $router->put('community/{id}', 'CommunityController@update');
});

//电话管理********查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_community_phone', 'auth:admin_api'],
], function (Router $router) {
    $router->get('community_phone', 'CommunityPhoneController@index');
    $router->get('community_phone/{id}', 'CommunityPhoneController@show');
});

//物品寄存*******增改查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_effects', 'auth:admin_api'],
], function (Router $router) {
    $router->get('effects', 'PersonalEffectsController@index');
    $router->get('effects/{id}', 'PersonalEffectsController@show');
});


/******************************用户管理****************************/
//业主相关*******增删改查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_user', 'auth:admin_api'],
], function (Router $router) {
    $router->get('get_user', 'UserController@index');
    $router->get('users_query', 'UserController@users_query');
    $router->get('get_user/{id}', 'UserController@show');
});
//业主审核
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,user_audit', 'auth:admin_api'],
], function (Router $router) {

    $router->put('user_audit', 'UserController@user_audit');
});
//业主管理
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,user_manager', 'auth:admin_api'],
], function (Router $router) {
//    $router->get('get_user', 'UserController@index');
//    $router->get('get_user/{id}', 'UserController@show');
    //活动用户
    $router->get('activity_user', 'UserController@activity_user');
    //app注册用户
    $router->get('register_user', 'UserController@register_user');
});
//新增业主
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,add_user', 'auth:admin_api'],
], function (Router $router) {
    $router->post('get_user', 'UserController@store');
    //房产信息*******增
    $router->post('room_info', 'OwnerRoominfoController@store');
});
//修改业主
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,update_user', 'auth:admin_api'],
], function (Router $router) {
    $router->put('get_user/{id}', 'UserController@update');
    //房产信息**改
    $router->put('room_info/{id}', 'OwnerRoominfoController@update');
});
//举报相关*******改查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_report', 'auth:admin_api'],
], function (Router $router) {
    $router->get('report', 'ReportController@index');
    $router->get('report/{id}', 'ReportController@show');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,update_report', 'auth:admin_api'],
], function (Router $router) {
    $router->put('report/{id}', 'ReportController@update');
});


//车辆信息*******增改查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_car', 'auth:admin_api'],
], function (Router $router) {
    $router->get('owner_car', 'OwnerCarController@index');
    $router->get('owner_car/{id}', 'OwnerCarController@show');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,post_car', 'auth:admin_api'],
], function (Router $router) {
    $router->post('owner_car', 'OwnerCarController@store');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,update_car', 'auth:admin_api'],
], function (Router $router) {
    $router->put('owner_car/{id}', 'OwnerCarController@update');
});

//库房信息*******增改查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_store', 'auth:admin_api'],
], function (Router $router) {
    $router->get('store_room', 'OwnerStoreRoomController@index');
    $router->get('store_room/{id}', 'OwnerStoreRoomController@show');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,post_store', 'auth:admin_api'],
], function (Router $router) {
    $router->post('store_room', 'OwnerStoreRoomController@store');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,update_store', 'auth:admin_api'],
], function (Router $router) {
    $router->put('store_room/{id}', 'OwnerStoreRoomController@update');
});
//车位信息*******增改查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_park', 'auth:admin_api'],
], function (Router $router) {
    $router->get('owner_park', 'OwnerParkController@index');
    $router->get('owner_park/{id}', 'OwnerParkController@show');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,post_park', 'auth:admin_api'],
], function (Router $router) {
    $router->post('owner_park', 'OwnerParkController@store');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,update_park', 'auth:admin_api'],
], function (Router $router) {
    $router->put('owner_park/{id}', 'OwnerParkController@update');
});

/******************************服务管理****************************/
//公有服务库*******增改查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_service', 'auth:admin_api'],
], function (Router $router) {
    $router->get('public_services', 'ServicePublicController@index');
    $router->get('public_services/{id}', 'ServicePublicController@show');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,post_service', 'auth:admin_api'],
], function (Router $router) {
    $router->post('public_services', 'ServicePublicController@store');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,update_service', 'auth:admin_api'],
], function (Router $router) {
    $router->put('public_services/{id}', 'ServicePublicController@update');
});


//商家管理*******增改查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_business', 'auth:admin_api'],
], function (Router $router) {
    $router->get('business', 'ServiceBusinessController@index');
    $router->get('business/{id}', 'ServiceBusinessController@show');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,post_business', 'auth:admin_api'],
], function (Router $router) {
    $router->post('business', 'ServiceBusinessController@store');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,update_business', 'auth:admin_api'],
], function (Router $router) {
    $router->put('business/{id}', 'ServiceBusinessController@update');
});

//门店管理*******增改查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_stores', 'auth:admin_api'],
], function (Router $router) {
    $router->get('stores', 'ServiceStoreController@index');
    $router->get('stores/{id}', 'ServiceStoreController@show');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,post_stores', 'auth:admin_api'],
], function (Router $router) {
    $router->post('stores', 'ServiceStoreController@store');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,update_stores', 'auth:admin_api'],
], function (Router $router) {
    $router->put('stores/{id}', 'ServiceStoreController@update');
});

//小区服务配置*******增改查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_service_config', 'auth:admin_api'],
], function (Router $router) {
    $router->get('service_config', 'ServiceConfigController@index');
    $router->get('service_config/{id}', 'ServiceConfigController@show');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,post_service_config', 'auth:admin_api'],
], function (Router $router) {
    $router->post('service_config', 'ServiceConfigController@store');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,update_service_config', 'auth:admin_api'],
], function (Router $router) {
    $router->put('service_config/{id}', 'ServiceConfigController@update');
});

//设置服务等级
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,set_service_index', 'auth:admin_api'],
], function (Router $router) {
    $router->get('set_service_index', 'ServiceConfigController@set_service_index');
});
//设置服务暂停时间
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,set_stop_time', 'auth:admin_api'],
], function (Router $router) {
    $router->put('set_stop_time', 'ServiceConfigController@set_stop_time');
});

//商家商品*******增改查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_service_goods', 'auth:admin_api'],
], function (Router $router) {
    $router->get('service_goods', 'ServiceGoodsController@index');
    $router->get('service_goods/{id}', 'ServiceGoodsController@show');

    $router->get('store_goods', 'ServiceStoreGoodsController@index');
    $router->get('store_goods/{id}', 'ServiceStoreGoodsController@show');

    $router->get('sale_goods', 'ServiceSaleGoodsController@index');
    $router->get('sale_goods/{id}', 'ServiceSaleGoodsController@show');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,post_service_goods', 'auth:admin_api'],
], function (Router $router) {
    $router->post('service_goods', 'ServiceGoodsController@store');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,update_service_goods', 'auth:admin_api'],
], function (Router $router) {
    $router->put('service_goods/{id}', 'ServiceGoodsController@update');
});

//店家商品*******增改查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,post_store_goods', 'auth:admin_api'],
], function (Router $router) {
    $router->post('store_goods', 'ServiceStoreGoodsController@store');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,update_store_goods', 'auth:admin_api'],
], function (Router $router) {
    $router->put('store_goods/{id}', 'ServiceStoreGoodsController@update');
});


//促销商品*******增改查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,post_sale_goods', 'auth:admin_api'],
], function (Router $router) {
    $router->post('sale_goods', 'ServiceSaleGoodsController@store');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,update_sale_goods', 'auth:admin_api'],
], function (Router $router) {
    $router->put('sale_goods/{id}', 'ServiceSaleGoodsController@update');
});


//门店商品的批量上架、下架
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,store_goods_lower', 'auth:admin_api'],
], function (Router $router) {
    $router->put('store_goods_lower', 'ServiceStoreGoodsController@store_goods_lower');
});
//结束商品促销
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,end_sale', 'auth:admin_api'],
], function (Router $router) {
    $router->put('end_sale/{id}', 'ServiceSaleGoodsController@end_sale');
});


/******************************订单管理****************************/
//订单*******增查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_orders', 'auth:admin_api'],
], function (Router $router) {
    $router->get('orders', 'OrderController@index');
    $router->get('orders/{id}', 'OrderController@show');
});
//处理订单
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,deal_order', 'auth:admin_api'],
], function (Router $router) {
    $router->put('deal_order', 'OrderController@deal_order');
});
//售后*******增查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_order_sales', 'auth:admin_api'],
], function (Router $router) {
    $router->get('order_sales', 'OrderRefundController@index');
    $router->get('order_sales/{id}', 'OrderRefundController@show');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,put_order_sales', 'auth:admin_api'],
], function (Router $router) {
    $router->put('order_sales/{id}', 'OrderRefundController@update');
});

//获取退款列表
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_order_refunds', 'auth:admin_api'],
], function (Router $router) {
    $router->get('order_refunds', 'OrderRefundController@order_refunds');
});

//订单评价*******增查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_order_evaluates', 'auth:admin_api'],
], function (Router $router) {
    $router->get('order_evaluates', 'OrderEvaluateController@index');
    $router->get('order_evaluates/{id}', 'OrderEvaluateController@show');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,put_order_evaluates', 'auth:admin_api'],
], function (Router $router) {
    $router->put('order_evaluates/{id}', 'OrderEvaluateController@update');
});


/******************************邻里管理****************************/
//邻里相关*******查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_neighborhoods', 'auth:admin_api'],
], function (Router $router) {
    $router->get('neighborhoods', 'NeighborhoodController@index');
    $router->get('neighborhoods/{id}', 'NeighborhoodController@show');
});
//邻里评论*******增删查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_comments', 'auth:admin_api'],
], function (Router $router) {
    $router->get('comments', 'NeighborCommentController@index');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,post_comments', 'auth:admin_api'],
], function (Router $router) {
    $router->post('comments', 'NeighborCommentController@store');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,del_comments', 'auth:admin_api'],
], function (Router $router) {
    $router->delete('comments/{id}', 'NeighborCommentController@destroy');
});
//群组*******增改查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_neighbor_groups', 'auth:admin_api'],
], function (Router $router) {
    $router->get('neighbor_groups', 'NeighborGroupController@index');
    $router->get('neighbor_groups/{id}', 'NeighborGroupController@show');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,post_neighbor_groups', 'auth:admin_api'],
], function (Router $router) {
    $router->post('neighbor_groups', 'NeighborGroupController@store');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,update_neighbor_groups', 'auth:admin_api'],
], function (Router $router) {
    $router->put('neighbor_groups/{id}', 'NeighborGroupController@update');
});

//鹰眼*******增改查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_monitors', 'auth:admin_api'],
], function (Router $router) {
    $router->get('monitors', 'MonitorController@index');
    $router->get('monitors/{id}', 'MonitorController@show');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,post_monitors', 'auth:admin_api'],
], function (Router $router) {
    $router->post('monitors', 'MonitorController@store');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,update_monitors', 'auth:admin_api'],
], function (Router $router) {
    $router->put('monitors/{id}', 'MonitorController@update');
});
//设施设备*******增改查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_devices', 'auth:admin_api'],
], function (Router $router) {
    $router->get('devices', 'DeviceController@index');
    $router->get('devices/{id}', 'DeviceController@show');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,post_devices', 'auth:admin_api'],
], function (Router $router) {
    $router->post('devices', 'DeviceController@store');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,update_devices', 'auth:admin_api'],
], function (Router $router) {
    $router->put('devices/{id}', 'DeviceController@update');
});
//设备房*******增改查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_device_rooms', 'auth:admin_api'],
], function (Router $router) {
    $router->get('device_rooms', 'DeviceRoomController@index');
    $router->get('device_rooms/{id}', 'DeviceRoomController@show');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,post_device_rooms', 'auth:admin_api'],
], function (Router $router) {
    $router->post('device_rooms', 'DeviceRoomController@store');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,update_device_rooms', 'auth:admin_api'],
], function (Router $router) {
    $router->put('device_rooms/{id}', 'DeviceRoomController@update');
});
//设备通用内容*******增改查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_common_contents', 'auth:admin_api'],
], function (Router $router) {
    $router->get('common_contents', 'DeviceCommonContentController@index');
    $router->get('common_contents/{id}', 'DeviceCommonContentController@show');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,post_common_contents', 'auth:admin_api'],
], function (Router $router) {
    $router->post('common_contents', 'DeviceCommonContentController@store');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,update_common_contents', 'auth:admin_api'],
], function (Router $router) {
    $router->put('common_contents/{id}', 'DeviceCommonContentController@update');
});
//设备分类*******增删改查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_device_types', 'auth:admin_api'],
], function (Router $router) {
    $router->get('device_types', 'DeviceTypeController@index');
    $router->get('device_types/{id}', 'DeviceTypeController@show');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,post_device_types', 'auth:admin_api'],
], function (Router $router) {
    $router->post('device_types', 'DeviceTypeController@store');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,update_device_types', 'auth:admin_api'],
], function (Router $router) {
    $router->put('device_types/{id}', 'DeviceTypeController@update');
});
//蓝牙设备*******增改查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_bluetooths', 'auth:admin_api'],
], function (Router $router) {
    $router->get('bluetooths', 'BluetoothController@index');
    $router->get('bluetooths/{id}', 'BluetoothController@show');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,post_bluetooths', 'auth:admin_api'],
], function (Router $router) {
    $router->post('bluetooths', 'BluetoothController@store');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,update_bluetooths', 'auth:admin_api'],
], function (Router $router) {
    $router->put('bluetooths/{id}', 'BluetoothController@update');
});


/************************************ 通用设置 ***************************************/
//账号管理
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_account', 'auth:admin_api'],
], function (Router $router) {
    $router->get('get_account', 'AdminPassportController@get_account');
    $router->get('show_account/{id}', 'AdminPassportController@show_account');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,post_account', 'auth:admin_api'],
], function (Router $router) {
    $router->post('create_account', 'AdminPassportController@create_account');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,update_account', 'auth:admin_api'],
], function (Router $router) {
    $router->put('update_account/{id}', 'AdminPassportController@update_account');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,del_account', 'auth:admin_api'],
], function (Router $router) {
    $router->delete('del_account/{id}', 'AdminPassportController@del_account');
});
//角色管理
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_role', 'auth:admin_api'],
], function (Router $router) {
    $router->get('get_role', 'AdminPassportController@get_role');
    $router->get('show_role/{id}', 'AdminPassportController@show_role');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,create_role', 'auth:admin_api'],
], function (Router $router) {
    $router->post('create_role', 'AdminPassportController@create_role');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,update_role', 'auth:admin_api'],
], function (Router $router) {
    $router->put('update_role/{id}', 'AdminPassportController@update_role');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,del_role', 'auth:admin_api'],
], function (Router $router) {
    $router->delete('del_role/{id}', 'AdminPassportController@del_role');
});

//区域管理*******增删改查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_districts', 'auth:admin_api'],
], function (Router $router) {
    $router->get('districts', 'DistrictController@index');
    $router->get('districts/{id}', 'DistrictController@show');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,post_districts', 'auth:admin_api'],
], function (Router $router) {
    $router->post('districts', 'DistrictController@store');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,update_districts', 'auth:admin_api'],
], function (Router $router) {
    $router->put('districts/{id}', 'DistrictController@update');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,del_districts', 'auth:admin_api'],
], function (Router $router) {
    $router->delete('districts/{id}', 'DistrictController@destroy');
});
//业主账户
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_user_account', 'auth:admin_api'],
], function (Router $router) {
    $router->get('user_account', 'AccountController@user_account');
    $router->get('account_info/{user_id}', 'AccountController@account_info');
    $router->get('recharge_record/{user_id}', 'AccountController@recharge_record');
});
//通知管理*******增删改查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_informs', 'auth:admin_api'],
], function (Router $router) {
    $router->get('informs', 'InformController@index');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,post_informs', 'auth:admin_api'],
], function (Router $router) {
    $router->post('informs', 'InformController@store');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,del_informs', 'auth:admin_api'],
], function (Router $router) {
    $router->delete('informs/{id}', 'InformController@destroy');
});
//焦点图*******增删改查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_banners', 'auth:admin_api'],
], function (Router $router) {
    $router->get('banners', 'BannerController@index');
    $router->get('banners/{id}', 'BannerController@show');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,post_banners', 'auth:admin_api'],
], function (Router $router) {
    $router->post('banners', 'BannerController@store');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,update_banners', 'auth:admin_api'],
], function (Router $router) {
    $router->put('banners/{id}', 'BannerController@update');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,del_banners', 'auth:admin_api'],
], function (Router $router) {
    $router->delete('banners/{id}', 'BannerController@destroy');
});

//积分管理*******增改查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_integral', 'auth:admin_api'],
], function (Router $router) {
    //积分商品
    $router->get('integral_goods', 'IntegralGoodsController@index');
    $router->get('integral_goods/{id}', 'IntegralGoodsController@show');
    //积分订单
    $router->get('integral_order', 'IntegralOrderController@index');
    $router->get('integral_order/{id}', 'IntegralOrderController@show');
    //用户积分
    $router->get('user_integral', 'IntegralController@index');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,post_integral', 'auth:admin_api'],
], function (Router $router) {
    //积分商品
    $router->post('integral_goods', 'IntegralGoodsController@store');
    //积分订单
    $router->post('integral_order', 'IntegralOrderController@store');
    //用户积分
    $router->post('user_integral', 'IntegralController@store');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,update_integral', 'auth:admin_api'],
], function (Router $router) {
    //积分商品
    $router->put('integral_goods/{id}', 'IntegralGoodsController@update');
    //积分订单
    $router->put('integral_order/{id}', 'IntegralOrderController@update');
});

//红包管理*******增改查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_packages', 'auth:admin_api'],
], function (Router $router) {
    //发放红包
    $router->get('packages', 'PackageController@index');
    $router->get('packages/{id}', 'PackageController@show');
    //用户红包
    $router->get('package_users', 'PackageUserController@index');
    //红包库
    $router->get('package_library', 'PackageLibraryController@index');
    $router->get('package_library/{id}', 'PackageLibraryController@show');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,post_packages', 'auth:admin_api'],
], function (Router $router) {
    //发放红包
    $router->post('packages', 'PackageController@store');
    //红包库
    $router->post('package_library', 'PackageLibraryController@store');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,update_packages', 'auth:admin_api'],
], function (Router $router) {
    //发放红包
    $router->put('packages/{id}', 'PackageController@update');
    //红包库
    $router->put('package_library/{id}', 'PackageLibraryController@update');
});

//充值活动*******增改查
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,get_recharge', 'auth:admin_api'],
], function (Router $router) {
    $router->get('recharge_activities', 'RechargeActivityController@index');
    $router->get('recharge_activities/{id}', 'RechargeActivityController@show');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,post_recharge', 'auth:admin_api'],
], function (Router $router) {
    $router->post('recharge_activities', 'RechargeActivityController@store');
});
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
    'middleware' => ['admin.api_permission:check,update_recharge', 'auth:admin_api'],
], function (Router $router) {
    $router->put('recharge_activities/{id}', 'RechargeActivityController@update');
});




// 后台接口，需要授权
Route::group([
    'prefix' => 'admin_api',
    'namespace' => 'App\\Admin\\Controllers\\API',
//    'middleware' => ['admin.api_permission:check,administrator,financer', 'auth:admin_api'],
    'middleware' => 'auth:admin_api'
], function (Router $router) {

    /***************** 首页 *****************/
    // 搜索
    $router->get('everyday_data', 'HomeController@everyday_data');
    $router->apiResource('search', 'SearchRecordController', [
        'only' => ['index', 'store'],
    ]);
    $router->get('tips_number', 'HomeController@tips_number');

    $router->delete('destroy_all', 'SearchRecordController@destroy_all');
    //重置密码
    $router->post('reset', 'AdminPassportController@reset');
    $router->put('update_admin_info', 'AdminPassportController@update_admin_info');

    //重置账号的密码
    $router->put('reset_admin_pwd/{id}', 'AdminPassportController@reset_admin_pwd');
    //重置商家的密码
    $router->put('reset_business_pwd', 'AdminPassportController@reset_business_pwd');



    /***************** 小区管理 *****************/
    //小区管理
    $router->get('community', 'CommunityController@index');
    $router->get('community/{id}', 'CommunityController@show');
    //获取小区停车类型
    $router->get('get_stop_type', 'CommunityController@get_stop_type');
    //获取小区名称列表
    $router->get('get_community', 'CommunityController@get_community');

    //获取当前小区的空置车位或车库
    $router->get('get_address', 'RoomController@get_address');
    $router->get('query_address', 'RoomController@query_address');
    //获取小区的苑
    $router->get('comm_gardens', 'RoomController@comm_gardens');
    //获取小区的楼幢
    $router->get('room_floors', 'RoomController@room_floors');
    //获取小区的单元室
    $router->get('room_doors', 'RoomController@room_doors');
    //获取所有的车位、车库和储藏室
    $router->get('get_all_park', 'RoomController@get_all_park');


    //审核活动状态
    $router->put('update_activity_status/{id}', 'ActivityController@update_activity_status');

    //活动报名*******增改查
    $router->get('activity_sign', 'ActivitySignController@index');
    $router->get('activity_sign/{id}', 'ActivitySignController@show');
    $router->put('activity_sign/{id}', 'ActivitySignController@update');

    //活动签到*******增查
    $router->get('activity_signin', 'ActivitySigninController@index');
    $router->post('activity_signin_create', 'ActivitySigninController@create');

    //电话管理*******增删改查
    $router->post('community_phone', 'CommunityPhoneController@store');
    $router->put('community_phone/{id}', 'CommunityPhoneController@update');
    $router->delete('community_phone/{id}', 'CommunityPhoneController@destroy');

    //物品寄存*******增改查
    $router->post('effects', 'PersonalEffectsController@store');
    $router->put('effects/{id}', 'PersonalEffectsController@update');


    /***************** 用户管理 *****************/
    //业主相关*******增删改查
    $router->delete('get_user/{id}', 'UserController@destroy');

    //无住址用户
    $router->get('no_address_user', 'UserController@no_address_user');
    //业主的车辆信息
    $router->get('get_user_car/{id}', 'UserController@get_user_car');
    //业主的库房信息
    $router->get('get_user_store/{id}', 'UserController@get_user_store');
    //业主的车位信息
    $router->get('get_user_park/{id}', 'UserController@get_user_park');
    //reset_user_pwd
    $router->put('reset_user_pwd/{id}', 'UserController@reset_user_pwd');

    //小区用户列表
    $router->get('community_user', 'UserController@community_user');
    //根据用户手机号码查找用户
    $router->get('phone_list', 'UserController@phone_list');

    //搜索小区库房
    $router->get('community_store', 'OwnerStoreRoomController@community_store');
    //搜索库房地址
    $router->get('store_address', 'OwnerStoreRoomController@store_address');

    //搜索小区库房
    $router->get('community_park', 'OwnerParkController@community_park');
    //搜索车位地址
    $router->get('park_address', 'OwnerParkController@park_address');


    /***************** 邻里管理 *****************/
    //置顶邻里
    $router->put('update_roof_place/{id}', 'NeighborhoodController@update_roof_place');
    //关闭邻里
    $router->put('close_neighbor/{id}', 'NeighborhoodController@close_neighbor');

    //评论我的
    $router->get('comment_mine', 'NeighborCommentController@comment_mine');
    //我的评论
    $router->get('my_comment', 'NeighborCommentController@my_comment');
    //邻里评论的详情
    $router->get('nei_comment_detail', 'NeighborCommentController@nei_comment_detail');
    //活动评论的详情
    $router->get('act_comment_detail', 'NeighborCommentController@act_comment_detail');


    /***************** 服务管理 *****************/
    //获取服务列表
    $router->get('get_service_list', 'ServicePublicController@get_service_list');
    //根据服务名称查找服务
    $router->get('to_service', 'ServicePublicController@to_service');

    //获取商家列表
    $router->get('get_business_list', 'ServiceBusinessController@get_business_list');
    //某个服务指定的商家
    $router->get('appoint_business', 'ServiceBusinessController@appoint_business');
    //获取某个商家和服务指定的门店
    $router->get('appoint_store', 'ServiceStoreController@appoint_store');
    //某个服务关联的小区
    $router->get('service_relation', 'ServiceConfigController@service_relation');

    //增加服务分类*******增删改查
    $router->get('goods_classify', 'ServiceGoodsClassifyController@index');
    $router->post('goods_classify', 'ServiceGoodsClassifyController@store');
    $router->put('goods_classify/{id}', 'ServiceGoodsClassifyController@update');
    $router->delete('goods_classify/{id}', 'ServiceGoodsClassifyController@destroy');

    //获取某商家的所有门店商品
    $router->get('get_business_store/{id}', 'ServiceGoodsController@get_business_store');
    //商家商品的批量上架、下架
    $router->put('goods_lower', 'ServiceGoodsController@goods_lower');


    /***************** 订单管理 *****************/
    //订单*******增
    $router->post('orders', 'OrderController@store');

    //订单评价*******增查
    $router->post('order_evaluates', 'OrderEvaluateController@store');

    //订单售后*******增查
    $router->post('order_sales', 'OrderRefundController@store');
    //退款接口
    $router->put('refund/{id}', 'OrderRefundController@refund');


    /***************** 设备管理 *****************/
    //鹰眼组*******增改查
    $router->get('monitor_groups', 'MonitorGroupController@index');
    $router->post('monitor_groups', 'MonitorGroupController@store');
    $router->get('monitor_groups/{id}', 'MonitorGroupController@show');
    $router->put('monitor_groups/{id}', 'MonitorGroupController@update');

    //鹰眼*******增改查
    $router->delete('monitors/{id}', 'MonitorController@destroy');

    //获取二级分类
    $router->get('second_class', 'DeviceController@second_class');
    //获取三级分类
    $router->get('third_class', 'DeviceController@third_class');

    //设备参数*******增改
    $router->post('device_params', 'DeviceParamController@store');
    $router->put('device_params/{id}', 'DeviceParamController@update');
    //设备维保*******增改
    $router->post('device_maints', 'DeviceMaintController@store');
    $router->put('device_maints/{id}', 'DeviceMaintController@update');
    //设备巡检*******增改
    $router->post('device_inspects', 'DeviceInspectController@store');
    $router->put('device_inspects/{id}', 'DeviceInspectController@update');

    //设备分类*******增删改查
    $router->delete('device_types/{id}', 'DeviceTypeController@destroy');
    //获取设备的一级分类
    $router->get('first_device_type', 'DeviceTypeController@first_device_type');
    //获取设备的二级分类
    $router->get('second_device_type', 'DeviceTypeController@second_device_type');
    //获取设备的三级分类
    $router->get('third_device_type', 'DeviceTypeController@third_device_type');

    //设备房名称列表
    $router->get('device_room_list', 'DeviceRoomController@device_room_list');

    //根据通用内容类型查询对应列表
    $router->get('common_type', 'DeviceCommonContentController@common_type');

    //设备关联*******增改查
    $router->get('device_relations', 'DeviceRelationController@index');
    $router->post('device_relations', 'DeviceRelationController@store');
    $router->get('device_relations/{id}', 'DeviceRelationController@show');
    $router->put('device_relations/{id}', 'DeviceRelationController@update');


    /***************** 通用设置 *****************/
    //批量删除账号
    $router->delete('del_more_account', 'AdminPassportController@del_more_account');
    //批量删除角色权限
    $router->delete('del_more_role', 'AdminPassportController@del_more_role');

    //获取角色名称列表
    $router->get('get_role_nickname', 'AdminPassportController@get_role_nickname');

    //获取商家下的门店
    $router->get('get_busi_store', 'AdminPassportController@get_busi_store');

    //根据选择的服务、商家、门店，获取关联的小区
    $router->get('get_package_community', 'PackageController@get_package_community');

    //获取红包库的分类列表
    $router->get('library', 'PackageLibraryController@library');

    //活动扣除积分
    $router->post('subtraction', 'IntegralController@subtraction');

    //获取用户积分的详细列表
    $router->get('get_integral_detail/{user_id}', 'IntegralController@get_integral_detail');

    /***************** 智慧物管 *****************/
    //物管相关
    $router->get('get_floors', 'PropertyController@get_floors');
    $router->get('get_doors', 'PropertyController@get_doors');
    $router->get('get_owner_info', 'PropertyController@get_owner_info'); //根据地址获取业主列表
    $router->post('visitor_record', 'PropertyController@visitor_record');
    $router->get('get_cars', 'PropertyController@get_cars');
    $router->get('visit_query', 'PropertyController@visit_query');
    $router->get('user_query', 'PropertyController@user_query');
    $router->put('car_leave', 'PropertyController@car_leave');
    $router->put('visitor_access', 'PropertyController@visitor_access');
    $router->get('order_wait_received_num', 'PropertyController@order_wait_received_num');
    $router->get('service_order', 'PropertyController@service_order');
    $router->get('my_order', 'PropertyController@my_order');
    $router->get('news_report', 'PropertyController@news_report');
    $router->get('device_list', 'PropertyController@device_list');
    $router->get('unregistered_rooms', 'PropertyController@unregistered_rooms');
    $router->apiResource('feedback', 'PropertyFeedbackController', [
        'only' => ['store'],
    ]);
    $router->get('get_comm_admins', 'PropertyController@get_comm_admins');
    $router->put('exchange_oper', 'PropertyController@exchange_oper');
    $router->get('scan_sgininfo', 'PropertyController@scan_sgininfo');
    //举报车辆
    $router->apiResource('report_cars', 'ReportCarController', [
        'only' => ['index', 'store'],
    ]);
    $router->get('report_count', 'ReportCarController@report_count');
    $router->post('car_result', 'ReportCarController@car_result');

    //活动签到
    $router->get('activity_signin_two', 'ActivitySigninController@activity_signin');
    $router->get('signin_detail', 'ActivitySigninController@detail');

    //极光推送
    $router->get('jpush', 'JPushController@index');
    $router->post('triggerJPush/{alert}/{user_id}', 'JPushController@triggerJPush');
});
