<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('homepage');
});

Route::get('/homepage', function () {
    return view('homepage');
});

Route::get('/login', function() {
    return view('loginpage');
});

Route::get('/loginpage', 'LoginController@authenticate');

Route::get('/register', function()
{
    return view('registrationpage');
});
Route::post('/registrationpage', 'RegisterController@register');

Route::get('/profile', function () 
{
    return view('profilepage');
});

Route::post('/profileAdmin', function ()
{
    return view('profilepage');
});

Route::get('/admin', 'AdminController@index');
// Takes you to the AdminController.suspendUser
Route::post('/suspendUser', 'AdminController@suspendUser');
// Takes you to the AdminController.deleteUser
Route::post('/deleteUser', 'AdminController@deleteUser');

Route::post('/addskill', 'SkillsController@addSkill');

Route::post('/edit_xp', 'ExperienceController@editExperience');

Route::post('/add_xp', 'ExperienceController@addExperience');

Route::post('/delete_xp', 'ExperienceController@deleteExperience');

Route::post('/edit_edu', 'EducationController@editEducation');

Route::post('/add_edu', 'EducationController@addEducation');

Route::post('/delete_edu', 'EducationController@deleteEducation');

Route::post('/edit_skill', 'SkillsController@editSkill');

Route::post('/add_skill', 'SkillsController@addSkill');

Route::post('/delete_skill', 'SkillsController@deleteSkill');

Route::post('/add_contact', 'ContactController@addContact');

Route::post('/edit_contact', 'ContactController@editContact');

Route::post('/delete_contact', 'ContactController@deleteContact');

Route::get('/addjob', function(){
    return view('addjobs');
});

Route::post('/addjobs', 'JobController@addJob');

Route::get('/managejob', 'JobController@findAllJob');

Route::get('/joppage', 'JobController@findAllJob');

Route::post('/editJob', 'JobController@editJob');

Route::post('/deleteJob', 'JobController@deleteJob');

Route::get('/addgroups', function(){
    return view('addgroups');
});

Route::post('/addgroup', 'GroupController@addGroup');

Route::get('/managegroups', 'GroupController@findAllGroups');

Route::get('/allgroups', 'GroupController@findAllGroups');

Route::post('/editGroup', 'GroupController@editGroup');

Route::post('/deleteGroup', 'GroupController@deleteGroup');

Route::post('/addmember', 'GroupMemberController@addMember');

Route::post('/deletemember', 'GroupMemberController@deleteMember');

Route::get('/searchjobs', function(){
    return view('jobsearch');
});

Route::post('/jobDetails', 'JobController@findJobByID');

Route::post('/searchDescription', 'JobController@findJobByDescription');

Route::post('/jobApp', function(){
    return view('jobapplication');
});
