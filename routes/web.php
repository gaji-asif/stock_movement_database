<?php
//Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return redirect('login');
       });
 //});


//Route::auth();
Route::get('/login', ['as' => 'login' , 'uses' => 'DtbLoginController@login']);

//Route::group(['middleware' => 'CheckAuthenticateUserMiddleware'], function () {

Route::post('/checkLogin', ['as' => 'checkLogin' , 'uses' => 'DtbLoginController@checkLogin']);
Route::get('/register', ['as' => 'register' , 'uses' => 'DtbLoginController@register']);
Route::post('/makeRegister', ['as' => 'makeRegister' , 'uses' => 'DtbLoginController@makeRegister']);
Route::get('/user/verify/{token}', 'DtbLoginController@verifyUser');
Route::get('email_confirm/{already}', ['as' => 'email_confirm' , 'uses' => 'DtbLoginController@emailConfirm']);
Route::get('/logout', ['as' => 'logout' , 'uses' => 'DtbLoginController@destroy']);
Route::get('/home', ['as' => 'home' , 'uses' => 'HomeController@index']);
Route::get('/notification', 'HomeController@notification');

Route::resource('role', 'DtbRoleController');// start Settings Route

//Settings

Route::get('/basic-sett', ['as' => 'basicSett' , 'uses' => 'HomeController@basicSett']);
Route::resource('/users','DtbUserController');//users
Route::get('/user_edit', ['as' => 'user_edit' , 'uses' => 'DtbUserController@user_edit']);
Route::get('/user_view', ['as' => 'user_view' , 'uses' => 'DtbUserController@user_view']);

// settigns template 
Route::resource('settings-template', 'SettingsTemplateController');//template
Route::get('/delete_template_view/{id}', 'SettingsTemplateController@deleteTemplateView'); 
Route::post('/get-template', 'SettingsTemplateController@getTemplate'); 
//last Access url do not delete
Route::post('/user_access_url', 'DtbUserController@updateLastAccessUrl');

Route::get('/team1', ['as' => 'team1' , 'uses' => 'DtbTeamController@index']);
Route::get('/team2', ['as' => 'team2' , 'uses' => 'DtbTeamController@team2']);
Route::get('/profile-update', ['as' => 'profile-update' , 'uses' => 'DtbSettingsController@profileUpdate']);
Route::post('/profile_general', ['as' => 'profile_general' , 'uses' => 'DtbSettingsController@profileGeneral']);
Route::post('/profile_password', ['as' => 'profile_password' , 'uses' => 'DtbSettingsController@profilePassword']);
Route::post('/profile_info', ['as' => 'profile_info' , 'uses' => 'DtbSettingsController@profileInfo']);
Route::post('/profile_links', ['as' => 'profile_links' , 'uses' => 'DtbSettingsController@profileLinks']);
//Route::get('/settings', ['as' => 'settings' , 'uses' => 'DtbSettingsController@settings']);
Route::post('/emailCheck', ['as' => 'emailCheck' , 'uses' => 'DtbUserController@emailCheck']);



//basic/developer settings
Route::resource('/contact','DtbDevelopGroupController');//contacts
Route::resource('/timezone','DtbTimezoneController');//timezone
Route::resource('/space','DtbSpaceController');//contacts
Route::resource('/notice','DtbNoticeController');//contacts
Route::POST('/noticeUpload', 'DtbNoticeController@noticeUpload')->name('noticeUpload');

Route::get('/news', ['as' => 'news' , 'uses' => 'DtbNewsController@index']);
Route::get('/news-all', ['as' => 'news-all' , 'uses' => 'DtbNewsController@allnews']);
Route::get('/news/create', 'DtbNewsController@create')->name('news-create');
Route::post('/news/create', 'DtbNewsController@store')->name('news-create');
Route::get('/news/{newsid}', ['as' => 'news-single' , 'uses' => 'DtbNewsController@show']);
Route::get('/news/{newsid}/edit', ['as' => 'news-edit' , 'uses' => 'DtbNewsController@edit']);
Route::put('/news/{newsid}/update', ['as' => 'news-update' , 'uses' => 'DtbNewsController@update']);
Route::post('/news/search', ['as' => 'news-search' , 'uses' => 'DtbNewsController@search']);
Route::put('/newsorder', ['as' => 'newsorder' , 'uses' => 'DtbNewsController@updateOrder']);
Route::POST('/newsfileupload', 'DtbNewsController@newsfileupload')->name('newsfileupload');


Route::get('/news-category', ['as' => 'news-category' , 'uses' => 'DtbNewsCategoryController@index']);

Route::get('/news-category/create', 'DtbNewsCategoryController@create')->name('news-category-create');
Route::post('/news-category/create', 'DtbNewsCategoryController@store')->name('news-category-create');
Route::put('/newsCatorder', ['as' => 'newsCatorder' , 'uses' => 'DtbNewsCategoryController@newsCatorder']);
Route::get('/news-category/{newsid}/edit', ['as' => 'news-category-edit' , 'uses' => 'DtbNewsCategoryController@edit']);
Route::put('/news-category/{newsid}/update', ['as' => 'news-category-update' , 'uses' => 'DtbNewsCategoryController@update']);





Route::resource('/settings-users','DtbUserController'); //Developer Settings -> Users Settings
Route::get('/delete_user_view/{user_id}', 'DtbUserController@deleteUserView'); // delete the user from settings
Route::resource('/settings-teams','DtbTeamController'); //Developer Settings -> Team Settings
Route::get('/delete_team_view/{user_id}', 'DtbTeamController@deleteTeamView'); // delete the team from settings
Route::post('/delete_team/{user_id}', 'DtbTeamController@deleteTeam');
Route::get('/settings-teams/add-member/{id}', ['as' => 'add-member' , 'uses' => 'DtbTeamController@addMember']);
Route::get('/delete_view/{user_id}/{team_id}', ['as' => 'delete_view' , 'uses' => 'DtbTeamController@deleteView']);
Route::post('/assign-users-team', ['as' => 'assign-users-team' , 'uses' => 'DtbTeamController@assignUserTeam']);
Route::post('/search-users', ['as' => 'search-users' , 'uses' => 'DtbUserController@searchUsers']);



// ***** there are two controller to manage porject related operations 1.dtbprojectcontroller(for main project crud) and 2.dtbgeneralprojectcontroller(for general settings)
//project basic settings; creating projects ,listing all projectst of developer or owner
Route::post('/project/{id}/issue.upload', 'DtbIssueController@upload')->name('issue.upload');
Route::post('/project/{id}/issue.delete_images', 'DtbIssueController@delete_images')->name('issue.delete_images');
Route::post('/project/{id}/issue.update_images', 'DtbIssueController@update_images')->name('issue.update_images');

Route::get('/project/{id}', 'DtbProjectsController@show')->name('project.show');
Route::resource('/projects','DtbProjectsController');//projects settings
Route::get('/manageproject', 'DtbProjectsController@manageproject')->name('manageproject');

Route::put('projectlist', 'DtbProjectsController@updateOrder')->name('projectlist.updateOrder');


//project search in popover bar
Route::get('popupprojectsrch', 'DtbProjectsController@projectpopsearch')->name('popupprojectsrch');



Route::get('/project/{id}/settings', 'DtbGeneralProjectController@settings')->name('project.settings');
Route::put('/project/{id}/settings', 'DtbGeneralProjectController@updateprojectinfo')->name('project.settings');
Route::delete('/project/{id}/project',['as' => 'project.destroy' , 'uses' => 'DtbGeneralProjectController@destroy']);

Route::delete('/project/{id}/delparticipants', 'DtbProjectsController@deleteparticipant')->name('project.deleteparticipant');

Route::post('/change_at_once', 'DtbIssueController@chnageAtOnce')->name('change_at_once');
Route::get('/chnageAtOnceView', array('as' => 'chnageAtOnceView', 'uses' => 'DtbIssueController@chnageAtOnceView'));
Route::post('/update_change_at_once', 'DtbIssueController@updateChangeAtOnce')->name('update_change_at_once');

// Change at once Complete Status

Route::post('/change_at_once_complete_status', 'DtbIssueController@chnageAtOnceCompleteStatus')->name('change_at_once_complete_status');

Route::post('/change_at_once_mng_pro', 'DtbProjectsController@chnageAtOnceMngPro')->name('change_at_once_mng_pro');
Route::get('/chnageAtOnceViewMngPro', array('as' => 'chnageAtOnceViewMngPro', 'uses' => 'DtbProjectsController@chnageAtOnceViewMngPro'));
Route::post('/update_change_at_once_mng_pro', 'DtbProjectsController@updateChangeAtOnceMngPro')->name('update_change_at_once_mng_pro');


Route::post('/change_at_once_complete_status_mng_pro', 'DtbProjectsController@chnageAtOnceCompleteStatusMngPro')->name('change_at_once_complete_status_mng_pro');

Route::post('/change_at_once_my_issues', 'DtbMyIssueController@chnageAtOnce')->name('change_at_once_my_issues');
Route::get('/chnageAtOnceViewMyIssues', array('as' => 'chnageAtOnceViewMyIssues', 'uses' => 'DtbMyIssueController@chnageAtOnceView'));
Route::post('/update_change_at_once_my_issues', 'DtbMyIssueController@updateChangeAtOnce')->name('update_change_at_once_my_issues');


//Route::resource('/project/{id}/issue', 'TestController')->only(['index', 'store',,'create','show' ,'edit', 'update', 'destroy']);
Route::get('/project/{id}/issue/data', 'DtbIssueController@getissues')->name('issue.data');
Route::post('/project/{id}/issue/search','DtbIssueController@issuesearch');
Route::resource('/project/{id}/issue','DtbIssueController');//issues
// Route::resource('/project/{id}/issue','DtbIssueController');//issues
Route::get('/editIssue/{issue_id}', 'DtbIssueController@edit');
Route::get('/issue/{issue_id}/{div}', 'DtbIssueController@show');
Route::get('/issue/{issue_id}', 'DtbIssueController@show');
//Route::get('/issue/{issue_id}', 'DtbIssueController@showNoDiv');

Route::post('/add_comment', ['as' => 'add_comment', 'uses' => 'DtbIssueController@addComment']);
Route::get('/issue/{issue_id}/commentShow/{id}', 'DtbIssueController@getComment');
Route::post('/issue/{issue_id}/commentUpdate/{id}', 'DtbIssueController@editComment');

Route::get('/get_issue_after_comment', ['as' => 'get_issue_after_comment', 'uses' => 'DtbIssueController@getIssueAfterComment']);
Route::get('/copy-issue/{issue_id}', 'DtbIssueController@copyIssue');
Route::put('/updateCopyIssue/{issue_id}', 'DtbIssueController@updateCopyIssue');
Route::get('/edit_issue/{issue_id}/{div}', 'DtbIssueController@editIssueNew');
Route::get('/project/{project_id}/issue/{issue_id}/edit', 'DtbIssueController@show');
Route::patch('/project/{project_id}/issue/{issue_id}/update', 'DtbIssueController@update')->name('project.issue.update');
Route::delete('/project/{project_id}/issue/{issue_id}',['as' => 'issue.destroy' , 'uses' => 'DtbIssueController@destroy']);
//for show chcklist of issue with ajax request
Route::post('getissuechcklist', 'DtbIssueController@getissuechcklist')->name('getissuechcklist');
Route::post('ischeckeditem', 'DtbIssueController@ischeckeditem')->name('ischeckeditem');
Route::put('checkupdateOrder', 'DtbIssueController@updateOrder')->name('checkupdateOrder');
Route::post('addissuechckitem', 'DtbIssueController@addissuechckitem')->name('addissuechckitem');


//for issue edit upload file
Route::POST('/uploadissuefiles', 'DtbIssueController@editorfilesup')->name('uploadissuefiles');

//for comment upload file
Route::POST('/uploadissuecommentfiles', 'DtbIssueController@editcommentfileup')->name('uploadissuecommentfiles');

Route::post('/issue_details_image_upload', ['as' => 'issue_details_image_upload', 'uses' => 'DtbIssueController@issueDetailsImageUpload']);

Route::put('/update_issue_data/{issue_id}', 'DtbIssueController@updateIssueData')->name('update_issue_data');
Route::get('/delete_issue_view/{issue_id}', 'DtbIssueController@deleteIssueView');
Route::delete('/delete_issue/{issue_id}', 'DtbIssueController@deleteIssue');
Route::get('/clear-issue-status/{project_id}', 'DtbIssueController@clearIssueStatus');

Route::post('/project/{project_id}/issueexport', 'DtbIssueController@exportcsv')->name('issueexport');

//ISSUE EDIT : AUTO ASSIGNEE ROUTES
Route::POST('/getprojectapp', 'DtbIssueController@getprojectapp')->name('getprojectapp');
Route::POST('/getprojectaddeduser', 'DtbIssueController@getprojectaddeduser')->name('getprojectaddeduser');

Route::POST('/getprojectnewassignee', 'DtbIssueController@getprojectnewassignee')->name('getprojectnewassignee');
Route::POST('/getprojectnewstatus', 'DtbIssueController@getprojectnewstatus')->name('getprojectnewstatus');

Route::get('customsearch', 'DtbIssueController@autoassignsrch')->name('customsearch');
Route::POST('newlyassignto', 'DtbIssueController@newlyassignto')->name('newlyassignto');



// Route::get('issue/create/{id}', [
//     'as' => 'payments.create',
//     'uses' => 'PaymentsController@create'
// ]);
// Route::resource('payments', 'PaymentsController', ['except' => 'create']);
//general settings , all settings for specific project
//Route::get('/settings-projects', 'HomeController@home')->name('settings-projects.home');
//Route::resource('/project','DtbGeneralProjectController');//projects settings
//Route::get('/projects-home', ['as' => 'projectsHome' , 'uses' => 'HomeController@home']);
//fro project general settings home



//member manage
Route::get('/managemember', 'DtbMemberManageController@index')->name('managemember');
Route::get('/managemember/{memberid}', 'DtbMemberManageController@show')->name('managemember.show');
Route::post('/managemember/{memberid}', 'DtbMemberManageController@store')->name('managemember.store');
Route::put('/managemember/{memberid}', 'DtbMemberManageController@update')->name('managemember.update');

Route::put('/archiveuser', 'DtbMemberManageController@archiveuser')->name('archiveuser');
Route::put('/unarchiveuser', 'DtbMemberManageController@unarchiveuser')->name('unarchiveuser');


//user skill
Route::post('/userskill/{memberid}', 'DtbUserSkillController@store')->name('userskill.store');
Route::get('/userskill/{id}/edit', 'DtbUserSkillController@edit')->name('userskill.edit');
Route::put('/userskill/{id}/update', 'DtbUserSkillController@update')->name('userskill.update');
Route::delete('/userskill/{id}/delete', 'DtbUserSkillController@destroy');
// Route::delete('/project/{id}/apps/{appid}',['as' => 'apps.destroy' , 'uses' => 'DtbAppController@destroy']);


//gneral member settins for project
Route::get('/project/{id}/member', 'DtbMemberController@index')->name('project.member');
Route::get('/project/{id}/member/data', 'DtbMemberController@getdata')->name('project.data');
Route::get('/project/{id}/member/team', 'DtbMemberController@getteam')->name('project.team');
Route::get('/project/{id}/member/list', 'DtbMemberController@getdevslist')->name('project.list');
Route::post('/project/{id}/member/addteam', 'DtbMemberController@teamsuserstore')->name('project.teamsuserstore');
Route::post('/project/{id}/member', 'DtbMemberController@store')->name('project.store');
Route::delete('/project/{id}/member', 'DtbMemberController@destroy')->name('project.destroy');


Route::get('/project/{id}/issuetype', 'DtbGenIssueTypeController@index')->name('issuetype.index');
Route::put('/project/{id}/issuetype', 'DtbGenIssueTypeController@updateOrder')->name('issuetype.updateOrder');
Route::delete('/project/{id}/issuetype', 'DtbGenIssueTypeController@destroy')->name('issuetype.destroy');
Route::post('/project/{id}/issuetype/{issueid}', 'DtbGenIssueTypeController@update')->name('issuetype.update');
Route::post('/project/{id}/issuetype', 'DtbGenIssueTypeController@store')->name('issuetype.store');



//general category
Route::get('/project/{id}/category',['as' => 'category' , 'uses' => 'DtbIssueCategoryController@index']);//issues
Route::post('/project/{id}/category',['as' => 'category' , 'uses' => 'DtbIssueCategoryController@store']);
Route::put('/project/{id}/category',['as' => 'category' , 'uses' => 'DtbIssueCategoryController@updateOrder']);// for drag and drop ordering
Route::delete('/project/{id}/category/{catid}',['as' => 'category.destroy' , 'uses' => 'DtbIssueCategoryController@destroy']);
Route::post('/project/{id}/category/{catid}',['as' => 'category.destroy' , 'uses' => 'DtbIssueCategoryController@update']);
//Route::delete('/settings-projects/issuetype/{id}', 'DtbIssueCategoryController@destroy')->name('issuetype.destroy');


// Category For Developer
Route::get('/category', ['as' => 'category' , 'uses' => 'DtbDeveloperCategoryController@index']);

Route::get('/priority', ['as' => 'priorityss' , 'uses' => 'DtbDeveloperPriorityController@index']);
Route::get('/priority/create', 'DtbDeveloperPriorityController@create')->name('priority-create');
Route::post('/priority/create', 'DtbDeveloperPriorityController@store')->name('priority-create');

Route::put('/priorityorder', ['as' => 'priorityorder' , 'uses' => 'DtbDeveloperPriorityController@priorityorder']);
Route::get('/priority/{priorityid}/edit', ['as' => 'priority-edit' , 'uses' => 'DtbDeveloperPriorityController@edit']);
Route::put('/priority/{priorityid}/update', ['as' => 'priority-update' , 'uses' => 'DtbDeveloperPriorityController@update']);


// status for Developer
Route::get('/status', ['as' => 'statuss' , 'uses' => 'DtbDeveloperStatusController@index']);
//Route::get('/status', ['as' => 'statuss' , 'uses' => 'DtbDeveloperStatusController@index']);
Route::get('/status/create', 'DtbDeveloperStatusController@create')->name('statuss-create');
Route::post('/status/create', 'DtbDeveloperStatusController@store')->name('statuss-create');

Route::put('/statusorder', ['as' => 'statusorder' , 'uses' => 'DtbDeveloperStatusController@statusorder']);
Route::get('/status/{statusid}/edit', ['as' => 'statuss-edit' , 'uses' => 'DtbDeveloperStatusController@edit']);
Route::put('/status/{statusid}/update', ['as' => 'statuss-update' , 'uses' => 'DtbDeveloperStatusController@update']);

// Route::get('/status_delete/{param}', ['as' => 'status-delete' , 'uses' => 'DtbDeveloperStatusController@destroy']);
Route::post('/status_delete', ['as' => 'status-delete' , 'uses' => 'DtbDeveloperStatusController@destroy']);


Route::get('/category/create', 'DtbDeveloperCategoryController@create')->name('category-create');
Route::post('/category/create', 'DtbDeveloperCategoryController@store')->name('category-create');
Route::put('/Catorder', ['as' => 'Catorder' , 'uses' => 'DtbDeveloperCategoryController@Catorder']);
Route::get('/category/{catid}/edit', ['as' => 'category-edit' , 'uses' => 'DtbDeveloperCategoryController@edit']);
Route::put('/category/{catid}/update', ['as' => 'category-update' , 'uses' => 'DtbDeveloperCategoryController@update']);


//general version
Route::get('/project/{id}/version',['as' => 'version' , 'uses' => 'DtbVersionController@index']);//issues
Route::post('/project/{id}/version',['as' => 'version' , 'uses' => 'DtbVersionController@store']);
Route::put('/project/{id}/version',['as' => 'version' , 'uses' => 'DtbVersionController@updateOrder']);
Route::delete('/project/{id}/version/{verid}',['as' => 'version.destroy' , 'uses' => 'DtbVersionController@destroy']); // for drag and drop ordering
Route::post('/project/{id}/version/{varid}',['as' => 'version.destroy' , 'uses' => 'DtbVersionController@update']); //for update
//Route::delete('/settings-projects/issuetype/{id}', '	DtbVersionController@destroy')->name('issuetype.destroy');



//general priority
Route::get('/project/{id}/priority',['as' => 'priority' , 'uses' => 'DtbIssuePriorityController@index']);//issues
Route::post('/project/{id}/priority',['as' => 'priority' , 'uses' => 'DtbIssuePriorityController@store']);
Route::put('/project/{id}/priority',['as' => 'priority' , 'uses' => 'DtbIssuePriorityController@updateOrder']);
Route::delete('/project/{id}/priority/{prioid}',['as' => 'priority.destroy' , 'uses' => 'DtbIssuePriorityController@destroy']); // for drag and drop ordering
Route::post('/project/{id}/priority/{prioid}',['as' => 'priority.update' , 'uses' => 'DtbIssuePriorityController@update']); //for update


//general status
Route::get('/project/{id}/status', 'DtbIssueStatusController@index')->name('status.index');
Route::put('/project/{id}/status', 'DtbIssueStatusController@updateOrder')->name('status.updateOrder');
Route::delete('/project/{id}/status', 'DtbIssueStatusController@destroy')->name('status.destroy');
Route::post('/project/{id}/status/{issueid}', 'DtbIssueStatusController@update')->name('status.update');
Route::post('/project/{id}/status', 'DtbIssueStatusController@store')->name('status.store');


//general checklist
Route::get('/project/{id}/checklist', 'DtbCheckListController@index')->name('checklist.index');
Route::put('/project/{id}/checklist', 'DtbCheckListController@updateOrder')->name('checklist.updateOrder');
Route::delete('/project/{id}/checklist', 'DtbCheckListController@destroy')->name('checklist.destroy');
Route::post('/project/{id}/checklist/{chckid}', 'DtbCheckListController@update')->name('checklist.update');
Route::post('/project/{id}/checklist', 'DtbCheckListController@store')->name('checklist.store');
Route::get('/project/{id}/checkdetail/{chckid}', 'DtbCheckListController@show')->name('checkdetail.show');
Route::post('/project/{id}/checkdetail/{chckid}/add', 'DtbCheckListController@listadd');
Route::delete('/project/{id}/checkdetail/{chckid}/delete', 'DtbCheckListController@deldtailchecklist');
Route::put('/project/{id}/checkdetail/{chckid}/edit', 'DtbCheckListController@editdtailchecklist');
Route::get('/project/{id}/checkdetail/{chckid}/getlist', 'DtbCheckListController@getlistofdetail');


//project app list / crud
Route::get('/project/{id}/apps', 'DtbAppController@index')->name('apps.index');
Route::get('/project/{id}/apps/create', 'DtbAppController@create')->name('apps.create');
Route::post('/project/{id}/apps', 'DtbAppController@store')->name('apps.store');
Route::get('/project/{id}/apps/{appid}',['as' => 'apps.show' , 'uses' => 'DtbAppController@show']);
Route::get('/project/{id}/apps/{appid}/edit', 'DtbAppController@edit')->name('apps.edit');
Route::put('/project/{id}/apps/{appid}', 'DtbAppController@update')->name('project.apps.update');
//using do not delete
Route::post('/apps/updatememo/{appid}', 'DtbAppController@updateMemo')->name('project.apps.update.memo');
// Route::post('/project/{id}/apps/{appid}', 'DtbAppController@destroy')->name('apps.delete');
Route::delete('/project/{id}/apps/{appid}/edit',['as' => 'apps.destroy' , 'uses' => 'DtbAppController@destroy']);
Route::put('/project/{id}/apps',['as' => 'apps' , 'uses' => 'DtbAppController@updateOrder']);
//editor file attch
Route::POST('/uploadappfiles', 'DtbAppController@editorfiles')->name('uploadappfiles');

// test Sheets
Route::get('/project/{id}/testSheets', 'DtbTestSheetController@index')->name('testSheets.index');

Route::get('/project/{id}/create', 'DtbTestSheetController@create')->name('testSheets.create');
Route::post('/project/{id}/store', 'DtbTestSheetController@store')->name('testSheets.store');

Route::get('/project/{id}/testSheets/{testSheetID}', 'DtbTestSheetController@show')->name('testSheets.show');


Route::get('/project/{id}/testSheets/{testSheetID}/edit', 'DtbTestSheetController@edit')->name('testSheets.edit');
Route::put('/project/{id}/testSheets/{testSheetID}', 'DtbTestSheetController@update')->name('project.testSheets.update');

//Route::get('/project/{id}/testSheets/{testSheetID}/copy', 'DtbTestSheetController@sheetcopy')->name('sheetcopy');
Route::get('/project/{id}/testSheets/{testSheetID}/copy', 'DtbTestSheetController@sheetcopystore')->name('sheetcopystore');
Route::DELETE('/testSheetdelete', 'DtbTestSheetController@testSheetdelete')->name('testSheetdelete');
Route::DELETE('/newsItemdelete', 'DtbNewsController@newsItemdelete')->name('newsItemdelete');




//test case list ordering
Route::put('/project/{id}/testSheets/{testSheetID}/testcaseordering', 'DtbTestSheetController@updateOrder')->name('testcaseordering');

Route::get('/project/{id}/testCase/{testSheetID}/create', 'DtbTestCaseController@create')->name('testCase.create');

Route::post('/project/{id}/testCaseStore', 'DtbTestCaseController@store')->name('testCase.store');
Route::get('/project/{id}/testCase/{testCaseID}/edit', 'DtbTestCaseController@edit')->name('testCase.edit');

Route::put('/project/{id}/testCase/{testCaseID}', 'DtbTestCaseController@update')->name('testCase.update');

Route::get('/project/{id}/testCase/{testCaseID}/copy', 'DtbTestCaseController@testcasecopy')->name('testcasecopy');
Route::post('/project/{id}/testCase/{testCaseID}/copy', 'DtbTestCaseController@testcasecopystore')->name('testcasecopystore');


Route::post('/deleteTEstCase', 'DtbTestCaseController@deleteTEstCase')->name('deleteTEstCase');

Route::post('/seacrh_test_cases', ['as' => 'seacrh_test_cases', 'uses' => 'DtbTestSheetController@seacrhTestCases']);

Route::get('/seacrh_test_cases', ['as' => 'seacrh_test_cases', 'uses' => 'DtbTestSheetController@seacrhTestCases']);


// screen and screen manage manage routes
Route::get('/project/{id}/screengroup', 'DtbScreenManageController@index')->name('screengroup.index');
Route::post('/project/{id}/screengroup', 'DtbScreenManageController@store')->name('screengroup.store');
Route::get('/project/{id}/screengroup/{screengroupid}', 'DtbScreenManageController@show')->name('screengroup.show');
Route::put('/project/screengroup/{screengroupid}', 'DtbScreenManageController@update')->name('screengroup.update');

Route::put('/project/{id}/screengrouporder',['as' => 'screengroup' , 'uses' => 'DtbScreenManageController@updateOrder']);
Route::put('/project/{id}/screengroup/{screengroupid}/screenorder',['as' => 'screenorder' , 'uses' => 'DtbScreenManageController@screenorder']);

Route::get('/project/{id}/screengroup/{screengroupid}/screen/{screenid}',['as' => 'screensingle' , 'uses' => 'DtbScreenManageController@screensingle']);

Route::get('/project/{id}/screengroup/{screengroupid}/screenr/{rank}',['as' => 'screensinglerank' , 'uses' => 'DtbScreenManageController@screenranked']);

Route::get('/project/{id}/screengroup/{screengroupid}/screen/{screenid}/edit',['as' => 'screenedit' , 'uses' => 'DtbScreenManageController@screensingleedit']);
Route::put('/project/{id}/screengroup/{screengroupid}/screen/{screenid}/update',['as' => 'screenupdate' , 'uses' => 'DtbScreenManageController@screensingleupdate']);

Route::get('/project/{id}/screengroup/{screengroupid}/screen',['as' => 'screencreate' , 'uses' => 'DtbScreenManageController@screencreate']);
Route::post('/project/{id}/screengroup/{screengroupid}/screen',['as' => 'screenstore' , 'uses' => 'DtbScreenManageController@screenstore']);

Route::POST('/screenactionadd', 'DtbScreenManageController@addscreenaction')->name('screenactionadd');
Route::PUT('/screenactionedit', 'DtbScreenManageController@editscreenaction')->name('screenactionedit');
Route::GET('/screenactionget', 'DtbScreenManageController@getscreenactions')->name('screenactionget');
Route::POST('/uploadactionattach', 'DtbScreenManageController@actioneditorfiles')->name('uploadactionattach');

Route::put('/project/{id}/screengroup/{screengroupid}/screen/{screenid}',['as' => 'actionorderupdate' , 'uses' => 'DtbScreenManageController@actionorderupdate']);

Route::DELETE('/screendelete', 'DtbScreenManageController@screendelete')->name('screendelete');
Route::DELETE('/screenActiondelete', 'DtbScreenManageController@screenActiondelete')->name('screenActiondelete');
Route::DELETE('/screenItemActiondelete', 'DtbScreenManageController@screenItemActiondelete')->name('screenItemActiondelete');

Route::POST('/screenitemadd', 'DtbScreenManageController@screenitemadd')->name('screenitemadd');
Route::GET('/screenitemget', 'DtbScreenManageController@getscreenitems')->name('screenitemget');
Route::put('/screenitemedit', 'DtbScreenManageController@screenitemedit')->name('screenitemedit');

Route::POST('/project/{id}/screengroup/{screengroupid}/screen/{screenid}',['as' => 'itemorderupdate' , 'uses' => 'DtbScreenManageController@itemorderupdate']);

Route::POST('/screenattach', 'DtbScreenManageController@screenattach')->name('screenattach');

Route::POST('/uploadscreenattchment', 'DtbScreenManageController@editorfiles')->name('uploadscreenattchment');

//project wiki settings
Route::get('/project/{id}/wiki', 'DtbWikiController@index')->name('wiki.index');
Route::get('/project/{id}/wiki/create', 'DtbWikiController@create')->name('wiki.create');
Route::post('/project/{id}/wiki', 'DtbWikiController@store')->name('wiki.store');
Route::get('/project/{id}/wiki/{wikiid}', 'DtbWikiController@show')->name('wiki.show');
Route::get('/project/{id}/wiki/{wikiid}/edit', 'DtbWikiController@edit')->name('wiki.edit');
Route::put('/project/{id}/wiki/{wikiid}/update', 'DtbWikiController@update')->name('project.wiki.update');
// Route::post('/project/{id}/wiki/{appid}', 'DtbWikiController@destroy')->name('wiki.delete');
Route::delete('/project/{id}/wiki/{wikiid}/delete',['as' => 'wiki.destroy' , 'uses' => 'DtbWikiController@destroy']);
//Route::delete('/project/{id}/wiki/{wikiid}',['as' => 'wiki.deletewiki' , 'uses' => 'DtbWikiController@deletewiki']);


//WIKI OPERATIONS
Route::POST('/project/{id}/wiki/{wikiid}/wikifileupload', 'DtbWikiController@filestore')->name('project.wiki.wikifileupload');
Route::delete('/project/{id}/wiki/{wikiid}',['as' => 'wiki.deletewiki' , 'uses' => 'DtbWikiController@deletewikiattachment']);
Route::post('/project/{id}/wiki/search', 'DtbWikiController@search')->name('project.wiki.search');
Route::POST('/upload', 'DtbWikiController@editorfiles')->name('uploads');
Route::POST('/wiki/upload/{div}', 'DtbWikiController@upload')->name('wiki.upload.decription');

//general members
// Route::get('/settings-projects/members',['as' => 'members' , 'uses' => 'DtbPriority@index']);//issues


// my issues
Route::get('/my_issues', ['as' => 'my_issues', 'uses' => 'DtbMyIssueController@index']);
Route::get('/getDropdownData', ['as' => 'getDropdownData', 'uses' => 'DtbMyIssueController@getDropdownData']);
Route::post('/seacrh_my_issue', ['as' => 'seacrh_my_issue', 'uses' => 'DtbMyIssueController@seacrhMyIssue']);
Route::post('/issue_search_by_sort', ['as' => 'issue_search_by_sort', 'uses' => 'DtbMyIssueController@issue_search_by_sort']);
Route::post('/issue_search_by_sort_project_wise', ['as' => 'issue_search_by_sort_project_wise', 'uses' => 'DtbIssueController@issue_search_by_sort_project_wise']);

Route::get('/seacrh_my_issue', ['as' => 'seacrh_my_issue', 'uses' => 'DtbMyIssueController@index']);

//project issues
Route::post('/seacrh_project_issue', ['as' => 'seacrh_project_issue', 'uses' => 'DtbIssueController@seacrhProjectIssue']);
Route::get('/seacrh_project_issue', ['as' => 'seacrh_project_issue', 'uses' => 'DtbIssueController@seacrhProjectIssue']);
// Route::post('/seacrh_project_issue_by_status', ['as' => 'seacrh_project_issue_by_status', 'uses' => 'DtbIssueController@searchIssueByStatus']);


//all projects
Route::get('/my_projects', ['as' => 'my_projects', 'uses' => 'DtbMyProjectController@index']);
Route::get('/velocity', ['as' => 'velocity', 'uses' => 'DtbVelocityController@index']);
Route::get('/velocity_search/{date}/{par}', ['as' => 'velocity_search', 'uses' => 'DtbVelocityController@velocitySearch']);


Route::get('/download', ['as' => 'download', 'uses' => 'DtbWikiController@download']);


// user report section
Route::get('/report', 'DtbUserReportController@index')->name('report.index');
Route::get('/report/{reportid}', 'DtbUserReportController@show')->name('report.show');
Route::get('/report/{reportid}/edit', 'DtbUserReportController@edit')->name('report.edit');
Route::put('/report/{reportid}/update', 'DtbUserReportController@update')->name('report.update');
Route::delete('/reportdelete', 'DtbUserReportController@destroy')->name('reportdelete');
Route::get('/reportlist', 'DtbUserReportController@getreportlist')->name('reportlist');
Route::get('/reportcreate', 'DtbUserReportController@reportcreate')->name('reportcreate');
Route::post('/reportstore', 'DtbUserReportController@reportstore')->name('reportstore');

Route::POST('/uploadreportfile', 'DtbUserReportController@editorfiles')->name('uploadreportfile');
Route::POST('/uploadtomorrowreportfile', 'DtbUserReportController@uploadtomorrowreportfile')->name('uploadtomorrowreportfile');
Route::POST('/uploadnoticefile', 'DtbUserReportController@uploadnoticefile')->name('uploadnoticefile');

// manage user report
Route::get('/userreportmanage', 'DtbUserReportController@reportlists')->name('userreportmanage');
Route::get('/reportsearch', 'DtbUserReportController@managereportsrch')->name('reportsearch');
Route::get('/monthlyreporthour', 'DtbUserReportController@monthlyreporthour')->name('monthlyreporthour');


//prevent direct access , csv file of issue
Route::get('/issuelist.csv', 'DtbUserReportController@csvprevent')->name('csvprevent');


//Gantt chart operation
Route::get('/project/{id}/ganttchart', 'DtbGanttChartController@index')->name('ganttchart');
Route::post('/project/{id}/ganttdatasend', 'DtbGanttChartController@ganttdatasend')->name('ganttdatasend');

Route::post('/project/{id}/filtered', 'DtbGanttChartController@filtered')->name('filtered');
Route::get('/project/{id}/filtereddata1', 'DtbGanttChartController@filtereddata1')->name('filtereddata1');
Route::get('/project/{id}/filtereddata2', 'DtbGanttChartController@filtereddata2')->name('filtereddata2');

Route::get('/project/{id}/ganttdata', 'DtbGanttChartController@getganttdata')->name('ganttdata');
Route::get('/project/{id}/ganttdata2', 'DtbGanttChartController@getganttdata2')->name('ganttdata2');

Route::post('/project/{idta}/task','DtbGanttChartController@store');
Route::put('/project/{id}/task/{taskid}','DtbGanttChartController@update');
Route::delete('/project/{id}/task/{taskid}','DtbGanttChartController@destroy');
//Route::delete('task/{id}','DtbGanttChartController@destroy');
//Route::resource('task', 'TaskController');

//INVOICE PORTION
Route::get('/manageinvoices', 'DtbInvoiceController@index')->name('manageinvoices');
Route::post('/invoiceimport', 'DtbInvoiceController@invoiceimport')->name('invoiceimport');
Route::get('/invoiceimport/{id}/edit', 'DtbInvoiceController@invoiceimportedit')->name('invoiceimportedit');
Route::put('/invoiceimport/{id}/edit', 'DtbInvoiceController@invoicedataupdate')->name('invoiceimportedit');

Route::post('/invoiceimport/{id}/invoiceitemsave', 'DtbInvoiceController@invoiceitemsave')->name('invoiceitemsave');

Route::get('/invoiceimport/{id}/invoiceitemlist', 'DtbInvoiceController@invoiceitemlist')->name('invoiceitemlist');

Route::post('/invoiceimport/{id}/invoiceitemupdate', 'DtbInvoiceController@invoiceitemupdate')->name('invoiceitemupdate');
Route::delete('/invoiceimport/{id}/invoiceitemdelete', 'DtbInvoiceController@invoiceitemdelete')->name('invoiceitemdelete');

Route::get('/invoiceimport/{id}/getprojectapp', 'DtbInvoiceController@getprojectapp')->name('getprojectapp');



//cost manage
Route::get('/addcost', 'DtbCostController@create')->name('addcost');
Route::post('/addcost', 'DtbCostController@store')->name('addcost');
Route::get('/editcost/{id}', 'DtbCostController@edit')->name('editcost');
Route::put('/editcost/{id}', 'DtbCostController@update')->name('editcost');
Route::post('/costimport', 'DtbCostController@costimport')->name('costimport');
Route::get('/generateprojectapp', 'DtbCostController@generateprojectapp')->name('generateprojectapp');
Route::post('/{id}/generateprojectappedit', 'DtbCostController@generateprojectappedit')->name('generateprojectappedit');
Route::delete('/editcost/{id}', 'DtbCostController@deletecost')->name('deletecost');

// students 
Route::resource('/int_student','IntStudentController');
Route::get('/delete_int_student/{user_id}', 'IntStudentController@deleteUserView'); // delete the user from settings
Route::get('/assign', 'IntStudentController@assign')->name('assign'); 
Route::get('/assign/view/{id}', 'IntStudentController@assignView')->name('assignview'); 
Route::post('/assign', 'IntStudentController@assignCreate'); 
Route::get('/assign_student/{id}', 'IntStudentController@assignStudent')->name('assign_student'); 
Route::post('/student_status_change', 'IntStudentController@statusChange'); 
Route::get('/delete_assign_student/{user_id}', 'IntStudentController@deleteAssign');
Route::delete('int_student/assign/{id}', 'IntStudentController@destroyAssign');
Route::post('/autocomplete-search','IntStudentController@autocompleteSearch')->name('autocomplete-search');
Route::post('/addUni','IntStudentController@saveUniversity');


// student reports
Route::get('/report', 'IntStudentReportController@index')->name('report'); 

//student filter
Route::post('/search-students','IntStudentReportController@searchStudents')->name('search_student');
// Route::post('/search-students', ['as' => 'search-students' , 'uses' => 'IntStudentController@searchStudents']);

// student profile document upload
Route::post('/student_upload', 'IntStudentController@studentUpload')->name('student-upload.store');
Route::get('/show-delete-document/{id}/{document_for}', 'IntStudentController@showDeleteDocument');
Route::post('/delete-document', 'IntStudentController@deleteDocument');
// student profile notes upload
Route::post('/student_notes', 'IntStudentController@studentNotes');
Route::get('/show-delete-note/{id}', 'IntStudentController@showDeleteNote');
Route::Post('/delete-note', 'IntStudentController@deleteNote');
// student profile custome notes upload
Route::post('/student_custome_notes', 'IntStudentController@studentCustomeNotes');
Route::get('/get_student_custome_notes/{id}', 'IntStudentController@getStudentCustomeNotes');

// facility type controller
Route::resource('settings-facility-types','FacilityTypeController');

Route::get('settings-facility-types-delete-view/{id}','FacilityTypeController@deleteUserView');


// for Import Sku

Route::get('/import-excel', 'ImportController@index')->name('import-excel');
Route::post('/storeImportExcel', 'ImportController@store')->name('store-import-excel');

Route::get('/import-item-excel', 'ImportController@importItemView')->name('import-item-excel');
Route::post('/storeImportItemExcel', 'ImportController@storeImportItemExcel')->name('store-import-item-excel');


Route::resource('all-skus', 'SkuController');
Route::get('/delete_sku/{sku_id}', 'SkuController@deleteSku');

// for import Item/Product

Route::resource('/items', 'ItemController');
Route::resource('/department', 'DepartmentController');


