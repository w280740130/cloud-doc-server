<?php

$api = app('Dingo\Api\Routing\Router');

$api->version(['v1', 'v2'], function (Dingo\Api\Routing\Router $api) {
    //V1版本
    $api->group(['namespace' => '\App\Http\Controllers\Api', 'middleware' => []], function (Dingo\Api\Routing\Router $api) {
        $api->get("list", "DocController@lists");
        $api->get("info", "DocController@info");
        $api->get("menu", "DocController@menu");
        $api->get("page", "DocController@page");

        $api->any('py_post', "PythonController@collect");
    });
    //V2版本
    $api->group([
        'namespace' => '\App\Http\Controllers\Api\V2',
        'middleware' => [],
        'prefix' => 'v2'
    ], function (Dingo\Api\Routing\Router $api) {
        $api->get("index", "DocController@index");
        $api->get("class-list", "DocController@class_list");
        $api->get("list", "DocController@doc_class_list");
        $api->get("doc-page", "DocController@doc_page");
        $api->get("page", "DocController@page");
        $api->post("get-my-doc", "DocController@get_my_doc");
        $api->any("search", "DocController@search");
        $api->any("search-index", "DocController@search_index");
        $api->any("title-tip", "DocController@title_tip");
    });
    //V3版本
    $api->group([
        'namespace' => '\App\Http\Controllers\Api\V3',
        'middleware' => [],
        'prefix' => 'v3'
    ], function (Dingo\Api\Routing\Router $api) {
        $api->get("index", "DocController@index");
        $api->get("article-index", "ArticleController@index");
        $api->get("article-page", "ArticleController@page");
        $api->post("article-collect", "ArticleController@collect");

        $api->get("class-list", "DocController@doc_class_list");
        $api->get("class-list-2", "DocController@doc_class_list_2");

        $api->get("info", "DocController@info");
        $api->get("doc-info-2", "DocController@info_2");

        $api->any('login', 'UserController@login');
        $api->any('scan-login', 'UserController@scan_login');

        $api->get("doc-page", "DocController@doc_page");
        $api->get("doc-page-menu", "DocController@doc_page_menu");
        $api->get("page", "DocController@page");
        $api->get('wenda-index', 'QuestionController@index');
        $api->get('wenda-page', 'QuestionController@page');

        $api->group(['middleware' => ['before' => 'jwt.auth']], function (Dingo\Api\Routing\Router $api) {
            $api->get('user-index', 'UserController@index');
            $api->any('user-follow', 'UserController@user_follow');
            $api->any('user-follow-cancel', 'UserController@user_follow_cancel');

            $api->any('user-like', 'UserController@user_like');
            //问答
            $api->post('wenda-upload-image', 'QuestionController@upload_img');
            $api->post('wenda-post', 'QuestionController@question_post');
            $api->post('wenda-reply-post', 'QuestionController@question_reply');

            $api->post("doc-back", "DocController@doc_back");

        });
    });


    //V3版本
    $api->group([
        'namespace' => '\App\Http\Controllers\Api\Web',
        'middleware' => [],
        'prefix' => 'web'
    ], function (Dingo\Api\Routing\Router $api) {
        $api->group(['middleware' => ['before' => 'jwt.auth']], function (Dingo\Api\Routing\Router $api) {
            $api->any("search-tag","WebController@search_tag");
            $api->any("article","ArticleController@index");
            $api->any("article-post","ArticleController@article_post");
            $api->any("article-edit","ArticleController@article_edit");
        });
    });

});
