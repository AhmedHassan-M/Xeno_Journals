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

Route::get('/', 'Content\contentController@homePage');
// Search fo articles route
Route::post('/', 'articleController@searchForArticles');

// login & signup
Route::post('/user/sign-up' , 'CustomAuth\AuthController@userSignup');
Route::post('/user/login' , 'CustomAuth\AuthController@userLogin');

// login using linkedin
Route::get('/auth/linkedin', 'CustomAuth\AuthController@redirectToLinkedin');
Route::get('/callback/linkedin', 'CustomAuth\AuthController@handleLinkedinCallback');

// User logout
Route::get('/logout' , 'CustomAuth\AuthController@logout')->middleware('auth');

// Forget Password
Route::get('/send-email' , 'CustomAuth\AuthController@addEmail');
Route::post('/send-email' , 'CustomAuth\AuthController@sendEmail');
Route::get('/reset-password/{email}/{code}' , 'CustomAuth\AuthController@resetPassword');
Route::post('/reset-password/{email}/{code}' , 'CustomAuth\AuthController@confirmNewPassword');
Route::get('/explore', 'journalsController@exploreJournals');

// Subscribe
Route::post('/subscribe' , 'Content\contactUsController@subscribe');

Route::get('/about_xeno', 'Content\contentController@AboutUs');

// Route::get('/search_xeno', function () {
//     return view('site.search');
// });

Route::get('/download_center', 'Content\contentController@downloadCenter');

Route::get('/contact_us', 'Content\contactUsController@contactUs');
Route::post('/contact-us', 'Content\contactUsController@requestContactUs');
// View each article
Route::get('/article/{id}', 'articleController@viewArticle');
// Delete each aticle
Route::get('/delete-article/{id}', 'articleController@deleteAuthorArticle');

// USER PROFILE
Route::get('/publish_your_article', function () {
    return view('author.publish');
})->middleware('authUser');
Route::post('/publish-article' , 'articleController@publishArticle');

// ADMIN DASHBOARD
Route::get('/admin/login', function () {
    if(\Auth::guest()){
        return view('admin.login');
    }elseif(\Auth::check()){
        return redirect('/admin/dashboard');
    }
    
});
Route::post('/admin/login', 'CustomAuth\AuthController@adminLogin');

// Admin Profile
Route::get('/dashboard/profile', 'CustomAuth\AuthController@editDashboardProfile')->middleware('auth');
Route::post('/dashboard/profile', 'CustomAuth\AuthController@updateAdminProfile');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('authAdmin');
Route::get('/admin/content_pages/about_xeno', 'Content\contentController@manageAbout')->middleware('authAdmin');
Route::post('/admin/content_pages/about_xeno', 'Content\contentController@updateAbout');
Route::post('/admin/delete_about', 'Content\contentController@deleteAbout');
Route::get('/all_notifications', 'NotificationsController@allNotifications')->middleware('auth');
Route::get('/admin/manage_downloads', function () {
    return view('admin.manage_downloads');
})->middleware('authAdmin');
Route::get('/admin/manage_downloads', 'Content\contentController@allFiles')->middleware('authAdmin');
Route::post('/admin/manage_downloads', 'Content\contentController@manageDownloads');
Route::post('/admin/edit_download', 'Content\contentController@updateDownloads');
Route::get('/admin/downloads-delete/{i}' , 'Content\contentController@deleteDownloads')->middleware('authAdmin');
Route::get('/admin/all_journals', 'journalsController@allJournals')->middleware('authAdmin');
Route::get('/admin/add_journal', function () {
    return view('admin.manage_journals.add_journal');
})->middleware('authAdmin');
Route::post('/admin/add_journal', 'journalsController@createJournal');
Route::post('/admin/update_journal', 'journalsController@updateJournal');
Route::post('/admin/journal_delete' , 'journalsController@deleteJournal');
Route::get('/admin/articles/requests', 'articleController@articleRequests')->middleware('authAdmin');
Route::get('/admin/articles/assigned', 'articleController@articleAssigned')->middleware('authAdmin');
Route::get('/admin/articles/published', 'articleController@articlePublished')->middleware('authAdmin');
Route::get('/articles/rejected-successfully', 'articleController@articleRejectedSuccessfully')->middleware('authAdmin');
Route::get('/articles/published-successfully', function(){
    return redirect('/admin/articles/published')->with('success' , 'Article has been published successfully');
})->middleware('authAdmin');
Route::get('/admin/articles/rejected', 'articleController@articleRejected')->middleware('authAdmin');
Route::post('/admin/article_delete' , 'articleController@deleteArticle');
Route::post('/admin/approve-article' , 'articleController@approveArticle');
Route::post('/admin/reject-article' , 'articleController@rejectArticle');
Route::post('/admin/back-to-dataentry' , 'articleController@articleToDataEntry');
Route::get('/admin/publish/{id}', 'articleController@publish')->middleware('authAdmin');
Route::get('/admin/content_pages/contact_us', 'Content\contactUsController@editContactUsContent')->middleware('authAdmin');
Route::post('/admin/content_pages/contact_us', 'Content\contactUsController@updateContactUsContent');
Route::get('/admin/contact_form', 'Content\contactUsController@allContactUs')->middleware('authAdmin');
Route::post('/admin/delete_contacts' , 'Content\contactUsController@deleteContact');
Route::get('/admin/home-page', 'Content\contentController@editHomePage')->middleware('authAdmin');
Route::post('/admin/home-page', 'Content\contentController@updateHomePageContent');
Route::get('/admin/download-page', 'Content\contentController@allFiles')->middleware('authAdmin');
Route::post('/admin/update-journal-preview' , 'Content\contentController@updateJournalPreview');
Route::post('/admin/add_about' , 'Content\contentController@addAboutUsContent');
Route::get('/admin/content_pages/contact_us', function () {
    return view('admin.manage_contentPages.contactUsPage');
})->middleware('authAdmin');
Route::get('/admin/data-entry/all-data', 'AllUsers\dataEntryController@allDataEntries')->middleware('authAdmin');
Route::post('/admin/Data_entry_delete' , 'AllUsers\dataEntryController@deleteDataEntry');
Route::get('/admin/data-entry/create-data', function () {
    return view('admin.manage_dataEntry.create_new_account');
})->middleware('authAdmin');
Route::post('/admin/data-entry/create-data', 'AllUsers\dataEntryController@addDataEntry');
Route::get('/admin/authors-page', 'articleController@allAuthors')->middleware('authAdmin');
Route::post('/admin/author_delete', 'articleController@deleteAuthor');
Route::get('/user/index', 'articleController@userIndex')->middleware('authUser');
Route::get('/user/profile', function () {
    return view('author.profile');
})->middleware('authUser');
Route::post('/user/profile', 'CustomAuth\AuthController@updateUserData');
Route::post('/check-password', 'CustomAuth\AuthController@checkPassword');
Route::post('/update/profile-pic', 'CustomAuth\AuthController@updateProfileImg');
Route::get('/author/dashboard', 'articleController@authorDash')->middleware('authAuthor');
Route::get('/author/edit-article/{i}', 'articleController@authorEditArticle')->middleware('authAuthor');
Auth::routes();

Route::get('/home', function () {
    redirect('/');
})->name('home');

// Data-Entry dashboard
Route::get('/data_entry/dashboard', function() {
    return view('admin.dashboard');
})->middleware('authEntry');
Route::get('/data_entry/new_articles', 'articleController@newAssignedArticles')->middleware('authEntry');
Route::post('/data_entry/new_articles', 'articleController@saveArticle');
Route::get('/data-entry/start-revision/{id}', 'articleController@startRevision')->middleware('authAdmin');
Route::get('/data_entry/InProgress_articles', 'articleController@inProgressArticles')->middleware('authEntry');
Route::post('/data_entry/InProgress_articles', 'articleController@saveArticle');
Route::get('/data-entry/send-to-publish/{id}', 'articleController@sendToPublish')->middleware('authEntry');
Route::get('/data_entry/sent_to_admin', 'articleController@sentToAdminSuccessfully')->middleware('authEntry');
Route::get('/data_entry/finished_articles', 'articleController@finishedArticles')->middleware('authEntry');


Route::get('/data_entry/login', function () {
    if(\Auth::guest()){
        return view('dataEntry.login');
    }elseif(\Auth::check()){
        return redirect('/data_entry/dashboard');
    }
});
Route::post('/data_entry/login', 'CustomAuth\AuthController@dataEntryLogin');

// Notifications 
Route::get('/admin/seen', 'CustomAuth\AuthController@seen');