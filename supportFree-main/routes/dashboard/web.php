<?php

/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
Route::group(['prefix' => LaravelLocalization::setLocale()], function () {

    //ana hena mest5dm name m3a algroup 3lshan aw7d kol ely haygy b3dhom be start mo3ena
    Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {




        Route::get('index', 'DashboardController@index')->name('index');

        //user(support) route
        Route::resource('users', 'UserController')->except('show');



         //modules route
         Route::resource('modules', 'ModuleController')->except('show');
         //branches route
         Route::resource('branches', 'BranchController')->except('show');
        //branches route
         Route::resource('projects', 'ProjectController')->except('show');

       //employee route
        Route::resource('employees', 'EmployeeController')->except('show');


       //tickets route // employee side
       Route::resource('tickets', 'TicketController')->except('show');

       Route::get('/tickets/{id}', 'TicketController@show')->name('tickets.show');

     //  Route::get('/tickets/{id}', 'TicketController@showpending');

       Route::get('/search', 'TicketController@search')->name('search');

       Route::get('/pendingcalls', 'TicketController@pendingcalls')->name('pendingcalls');

       Route::get('cloasedcalls', 'TicketController@cloasedcalls')->name('cloasedcalls');

      //tickets route // editor side
      Route::get('allcalls', 'TicketController@allcalls')->name('allcalls');
      Route::get('allpendingcalls', 'TicketController@allpendingcalls')->name('allpendingcalls');
      Route::get('allcloasedcalls', 'TicketController@allcloasedcalls')->name('allcloasedcalls');

      //export
      Route::get('export', 'TicketController@export')->name('export');

      //Route::post('reply/{id}', 'TicketController@reply')->name('reply');

    });
});
