<?php
/*Ajax*/
Route::post('ajax/anime-request', 'Ajax/animeRequest');
Route::post('ajax/anime-report', 'Ajax/animeReport');

/* Home Routes */
Route::get('', 'Home/index');
Route::make('home', 'Home/home');
Route::make('search', 'Home/search');
Route::make('filter', 'Home/filter');
Route::get('watch', 'Episodes/selected');
Route::make('az-list', 'Home/animeByLetter');
Route::make('recently-added', 'Home/recentlyAdded');
Route::get('contact', 'Home/contact');
/* Admin Routes */

/*Log in */
Route::get('admin', 'Login/index');
Route::make('admin/sign-in', 'Login/index');
//Route::post('admin/sign-in', 'Login/check');
Route::get('admin/logout', 'Login/logout');

/* Dashboard route */
//Route::get('admin', 'Dashboard/index');

/*Home Slider */
Route::get('admin/slider', 'Slider/index');
Route::make('admin/slider/new', 'Slider/create');
Route::get('admin/slider/delete', 'Slider/delete');

/* Genre route */
Route::get('admin/genre', 'Genre/index');
Route::make('admin/genre/new', 'Genre/create');
Route::make('admin/genre/update', 'Genre/update');
Route::get('admin/genre/delete', 'Genre/delete');

/* Type route */
Route::get('admin/type', 'Type/index');
Route::make('admin/type/new', 'Type/create');
Route::make('admin/type/update', 'Type/update');
Route::get('admin/type/delete', 'Type/delete');

/* Anime route */
Route::get('admin/anime', 'Anime/index');
Route::make('admin/anime/new', 'Anime/create');
Route::make('admin/anime/update', 'Anime/update');
Route::get('admin/anime/delete', 'Anime/delete');
Route::get('admin/anime/view', 'Anime/view_');

/* NewList/Episode route */
Route::get('admin/episode', 'Episode/index');
Route::make('admin/episode/new', 'Episode/create');
Route::get('admin/episode/delete-all', 'Episode/deleteAll');
Route::make('admin/episode/update', 'Episode/update');
Route::get('admin/episode/delete', 'Episode/delete');

/* User */
Route::get('admin/user', 'User/index');
Route::make('admin/user/new', 'User/create');
Route::make('admin/user/update', 'User/update');
Route::get('admin/user/delete', 'User/delete');

/* Request */
Route::get('admin/request', 'RequestReport/request');
Route::get('admin/request/delete', 'RequestReport/deleteRequest');
Route::get('admin/request/delete-all', 'RequestReport/deleteRequest');
Route::get('admin/request/mark-as-done', 'RequestReport/markAsDone');
/* Report */
Route::get('admin/report', 'RequestReport/report');
Route::post('admin/report/delete-selected', 'RequestReport/deleteSelected');

