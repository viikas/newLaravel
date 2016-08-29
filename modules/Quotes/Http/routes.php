<?php

Route::group(['middleware' => ['web', 'cors'], 'prefix' => 'api/v1/quotes', 'namespace' => 'Modules\Quotes\Http\Controllers'], function() {
    Route::get('templates/get', 'TemplatesController@get');
    Route::get('templates/getById/{id}', 'TemplatesController@getById');
    Route::get('templates/getActive', 'TemplatesController@getActive');

    Route::get('templates/getActiveByOpp/{Oppid}', 'TemplatesController@getActiveByOpp');

    Route::get('templates/getActiveById/{id}', 'TemplatesController@getActiveById');
    Route::post('templates/getAllByIds', 'TemplatesController@getAllByIds');

    Route::get('templates/populate', 'TemplatesController@getPopulate');

    Route::post('templates/add', 'TemplatesController@add');

    Route::post('templates/update', 'TemplatesController@update');
    Route::get('QuoteStatuses/get', 'QuoteStatusController@get');
    Route::get('QuoteStatuses/getById/{id}', 'QuoteStatusController@getById');
    Route::put('templates/update', 'TemplatesController@update');
    Route::post('templates/copy', 'TemplatesController@copy');
    // quoteStatuses
    Route::get('quoteStatuses/get', 'QuoteStatusController@get');
    Route::get('quoteStatuses/getById/{id}', 'QuoteStatusController@getById');
    Route::post('quoteStatuses/add', 'QuoteStatusController@add');
    Route::post('quoteStatuses/update', 'QuoteStatusController@update');

    //----------------------------GLobal Settings---------------------------
    Route::get('globalSettings/get', 'QuoteGlobalSettingsController@get');
    Route::get('globalSettings/getById/{id}', 'QuoteGlobalSettingsController@getById');
    Route::post('globalSettings/add', 'QuoteGlobalSettingsController@add');
    // Route::get('GlobalSettings/edit','QuoteGLobalSettingsController@edit');
    // Route::post('globalSettings/update', 'QuoteGLobalSettingsController@update');
    // Route::get('GlobalSettings/{id}/delete','QuoteGLobalSettingsController@delete');
    Route::get('globalSettings/getSettingsByType/{type}', 'QuoteGlobalSettingsController@getSettingsByType');
    Route::post('globalSettings/addSetting', 'QuoteGlobalSettingsController@addsetting');
    Route::post('globalSettings/updateSetting', 'QuoteGlobalSettingsController@updatesetting');


######################################################profile price##########################################
    Route::get('price/getProfile', 'ProfileAccessoriesController@getProfiles');
    Route::get('price/getProfilePriceRevision', 'ProfileAccessoriesController@getProfilePriceRevision');  //get list
    Route::get('price/getProfilePriceRevisionByDate/{date}', 'ProfileAccessoriesController@getProfilePriceRevisionByDate');  //get list by date
    Route::post('price/addBulkProfilePriceRevision', 'ProfileAccessoriesController@addBulkProfilePriceRevision');  //add profile
    Route::post('price/updateProfilePriceRevision', 'ProfileAccessoriesController@updateProfilePriceRevision');    //update profile
    Route::get('price/getProfilePriceRevisionDate', 'ProfileAccessoriesController@getProfilePriceRevisionDates');

    Route::get('price/getLatestProfilePriceRevisionDate', 'ProfileAccessoriesController@getLatestProfilePriceRevision');
    Route::get('price/getLatestProfileRevision', 'ProfileAccessoriesController@getProfileLatestRevision');
    
######################################################Accessory Price#############################################################

    Route::get('profileAccessory/get', 'ProfileAccessoriesController@get');

    Route::get('price/getAccessoryPrice', 'ProfileAccessoriesController@getAccessoryPrice');
    Route::get('price/getAccessoryInventoryPrice', 'ProfileAccessoriesController@getAccessoryInventPrice');
    Route::get('price/getLatestProfilePrice', 'ProfileAccessoriesController@getLatestProfilePrice');
    Route::get('price/getLatestAccessoryPrice', 'ProfileAccessoriesController@getLatestAccessoryPrice');
    Route::get('price/getPriceRevisionByDate/{date}', 'ProfileAccessoriesController@getPriceRevisionByDate');
    Route::post('price/addPriceRevision', 'ProfileAccessoriesController@addPriceRevision');
    Route::post('price/updatePriceRevision', 'ProfileAccessoriesController@updatePriceRevision');
    Route::post('price/addBulkPriceRevision', 'ProfileAccessoriesController@addBulkPriceRevision');
    Route::get('price/getAccessoryDate', 'ProfileAccessoriesController@getAccessoryDate');

    //added by sangam on 5/8/2016
    Route::post('price/getInfillingProfileUnitCost', 'ProfileAccessoriesController@getInfillingProfileUnitCost');

    #######################################Quote Additional Profiles#########################################
    Route::get('additionalProfiles/list', 'ProfileAccessoriesController@listAdditionalProfiles');
    Route::post('additionalProfiles/add', 'ProfileAccessoriesController@addAdditionalProfiles');
    Route::post('additionalProfiles/update', 'ProfileAccessoriesController@updateAdditionalProfiles');
    Route::get('additionalProfiles/delete/{id}', 'ProfileAccessoriesController@deleteAdditionalProfiles');

    ##########################Quote Additional Accessories############################################
    Route::get('additionalAccessories/get', 'ProfileAccessoriesController@listAdditionalAccessories');
    Route::post('additionalAccessories/add', 'ProfileAccessoriesController@addAdditionalAccessories');
    Route::post('additionalAccessories/update', 'ProfileAccessoriesController@updateAdditionalAccessories');
    Route::get('additionalAccessories/delete/{id}', 'ProfileAccessoriesController@deleteAdditionalAccessories');

    ##########################additional profile and Accessories price######################################
    Route::get('price/getLatestAdditionalProfilePrice', 'ProfileAccessoriesController@getLatestAdditionalProfilePriceRevision');
    Route::get('price/getLatestAdditionalAccessoryPrice', 'ProfileAccessoriesController@getLatestAdditionalAccessoryPriceRevision');
    Route::get('price/getAdditionalLatestAccessoryPrice', 'ProfileAccessoriesController@getAddAccessoryLatestRevision'); //get latest additional accessory list of same id
    Route::get('price/getLatestAdditionalAccessoryPriceByDate/{date}', 'ProfileAccessoriesController@getLatestAdditionalAccessoryPriceRevisionByDate');

    Route::get('price/getLatestAdditionalProfilePriceByDate/{date}', 'ProfileAccessoriesController@getLatestAdditionalProfilePriceRevisionByDate');
    Route::get('price/getAdditionalLatestProfilePrice', 'ProfileAccessoriesController@getAddProfileLatestRevision'); //get latest additional profile list of same id
    Route::post('price/addAdditionalProfilePriceRevision', 'ProfileAccessoriesController@addAdditionalProfilePriceRevision');
    Route::post('price/addAdditionalAccessoryPriceRevision', 'ProfileAccessoriesController@addAdditionalAccessoriesPriceRevision');
    Route::get('price/getAdditionalAccessoryPriceLatestRevision', 'ProfileAccessoriesController@getAdditionalAccessoryLatestRevision');
    Route::post('price/updateAdditionalProfilePriceRevision', 'ProfileAccessoriesController@updateAdditionalProfilePriceRevisionModel');
    Route::post('price/updateAdditionalAccessoriesPriceRevision', 'ProfileAccessoriesController@updateAdditionalAccessoriesPriceRevisionModel');


    // Route::get('listProfileAccessories/getById/{id}', 'ProfileAccessoriesController@getById');
    ################ START RUOTES FOR QOUTES##################################
    Route::get('quotes/get/{opportunityId}', 'QuotesController@get');
    Route::get('quotes/get', 'QuotesController@getquotes');
    
    Route::get('quotes/getById/{id}', 'QuotesController@getById');
    Route::get('quotes/getActive', 'QuotesController@getActive');
    Route::get('quotes/getitems/{quoteId}', 'QuotesController@getItems');
    Route::get('quotes/getiteminfos/{itemId}', 'QuotesController@getItemInfos');
    Route::post('quotes/add', 'QuotesController@add');
    Route::post('quotes/update', 'QuotesController@update');
    Route::post('quotes/addRevision', 'QuotesController@addRevision');
    Route::post('quotes/addOption', 'QuotesController@addOption');
    Route::post('quotes/addItem', 'QuotesController@addItem');
    Route::post('quotes/updateItem', 'QuotesController@updateItem');
    Route::post('quotes/changeStatus', 'QuotesController@changeStatus');
    Route::post('quotes/addNote', 'QuotesController@addNote');

    ################END ROUTES FOR QUOTES#####################################
    ##############################################CMS#########################################################
    Route::get('cms/getByCategory/{category}', 'ProfileAccessoriesController@getcmsByCategory');
    Route::post('cms/update', 'ProfileAccessoriesController@updatecms');
    Route::get('activity/getLogById/{id}', 'ProfileAccessoriesController@getlogbyId');
    Route::post('activity/addLog', 'ProfileAccessoriesController@addlog');

    Route::post('quotes/updateCMSData', 'ProfileAccessoriesController@updateCMSData');





    
    Route::get('activity/getActivityByCategory', 'QuoteActivityLogController@getActivityByCategory');
    Route::post('activity/createActivityLog', 'QuoteActivityLogController@createActivityLog');
    ############################################Glasss Board Revision#######################################################
    Route::get('price/getGlass', 'GlassPriceRevisionController@getGlass');
    Route::get('price/getLatestGlassPriceRevision', 'GlassPriceRevisionController@getLatestGlasstypeRevision'); //list glass price
    Route::get('price/getBoards', 'GlassPriceRevisionController@getBoards');
    Route::get('price/getAllGlassAndBoards', 'GlassPriceRevisionController@getAllGlassAndBoards');
    Route::get('price/getLatestBoardPriceRevision', 'GlassPriceRevisionController@getLatestBoardRevisionPrice'); //list board price
    Route::get('price/getGlassPriceRevisionByDate/{date}', 'GlassPriceRevisionController@getGlassTypeRevisionByDate'); //get glass price by date
    Route::get('price/getBoardPriceRevisionByDate/{date}', 'GlassPriceRevisionController@getBoardTypeRevisionByDate'); //get board price by date
    //Route::post('price/addNewBoard', 'GlassPriceRevisionController@addNewBoard');// add new thickness board
    Route::post('price/updateGlassPriceRevision', 'GlassPriceRevisionController@updatePriceRevision'); // endpoint to update Glasss price
    Route::post('price/updateBoardPriceRevision', 'GlassPriceRevisionController@updateBoardPriceRevision'); //endpoint to update Board price     
    Route::post('price/addGlassPriceRevision', 'GlassPriceRevisionController@addGlassPriceRevision'); // Bulk add of glass price
    Route::post('price/addBoardPriceRevision', 'GlassPriceRevisionController@addBoardPriceRevision'); //bulk add of board price
    # added by sangam on 5/27/2016
    Route::get('price/getGlassBible', 'GlassPriceRevisionController@getGlassBible');
    Route::get('price/getGlassAndBoardPrice', 'GlassPriceRevisionController@getGlassAndBoardPrice');
#########################################################Quote Setting #########################################################
    Route::get('quote/getSetting', 'ProfileAccessoriesController@getQuotesSetting');


    Route::post('quote/addQuoteItemTemplateProfile', 'ProfileAccessoriesController@addQuoteItemTemplateProfile'); //endpoint to add quote_item_template_profile
    Route::post('quote/updateQuoteItemTemplateProfile', 'ProfileAccessoriesController@updateQuoteItemTemplateProfile'); //endpoint to update quote_item_template_profile

    Route::post('quote/addQuoteTemplateProfile', 'ProfileAccessoriesController@addQuoteTemplateProfile'); //endpoint to add quote_template_profile
    Route::post('quote/updateQuoteTemplateProfile', 'ProfileAccessoriesController@updateQuoteTemplateProfile'); //endpoint to update quote_template_profile
    Route::post('quote/updateTemplate', 'ProfileAccessoriesController@updateQuoteTemplates'); //endpoint to update template remark and is_active column

    Route::get('quote/getCMSByQuoteId/{id}', 'QuotesController@getCMSByQuoteId');


    ////////////////////////////////////////////////Image Routes//////////////////////////////////////////

    // Route::post('image/upload', 'ProfileAccessoriesController@addImage');
   // Route::get('image/delete','ProfileAccessoriesController@deleteImage');


    Route::post('addImages','QuotesController@addNewImage');
     Route::post('quoteitem/image/upload', 'QuotesController@addImage');

    Route::post('quoteitem/image/updateupload', 'QuotesController@updateImage');

    Route::get('quoteitem/image/delete/{id}', 'QuotesController@deleteImage');
    Route::post('quote/updatePaymentoptions', 'QuotesController@updatePaymentOption');

    // Add Item Template Images
    Route::post('add_item_image','QuotesController@addItemImage');
    // List Item Template image
    Route::get('get_item_images/{id}','QuotesController@getItemImages');







 Route::post('quote/revision', 'QuotesController@revisionfirst');


 Route::post('quote/revisionsecond', 'QuotesController@revisionsecond');
 Route::get('quote/quotelist', 'QuotesController@getquotelist');

 Route::post('quote/revisionthird', 'QuotesController@revisionthird');



    //------------------------------------------------Users---------------------------------



    Route::get('user/getGroups', 'UserController@getGroup');
    Route::post('user/addGroup', 'UserController@addGroup');
    Route::post('user/editGroup', 'UserController@editGroup');

       ///------------Authethentication----------------



     // Route::post('authenticate', 'UserController@authenticate');

     // entrust auth routes
     // Route to create a new role
    // Route to create a new permission
    Route::post('permission', 'JwtAuthenticateController@createPermission');
    // Route to assign role to user
    Route::post('assign-role', 'JwtAuthenticateController@assignRole');
    // Route to attache permission to a role
    Route::post('attach-permission', 'JwtAuthenticateController@attachPermission');

    // API route group that we need to protect
    Route::group(['prefix' => 'admin', 'middleware' => ['ability:admin,create-user']], function()
    {
        // Protected route
        // Permissions
        Route::get('user/getPermission', 'UserController@getPermission');
        
        // Roles
        Route::get('user/getRoles', 'UserController@getRoles');
        Route::post('user/addRoles', 'UserController@addRoles');
        Route::post('user/editRoles', 'UserController@editRoles');
        
        // Users
        Route::post('user/editUser', 'UserController@editUser'); 
        Route::post('user/addUser', 'UserController@addUser');
        Route::get('user/getUser', 'UserController@getUser');

        Route::get('users', 'JwtAuthenticateController@index');
        Route::get('authenticate/user', 'JwtAuthenticateController@authenticatedUser');
        Route::post('role', 'JwtAuthenticateController@createRole');


    });

    // Authentication route
    Route::post('login', 'JwtAuthenticateController@authenticate');




});
