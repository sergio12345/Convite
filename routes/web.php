<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Event\EventController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\Admin\CampaignController as AdminCampaignController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Invitee\InviteeController;
use App\Http\Controllers\WebhookController;

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
    if(Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('auth/login');
});

Route::get('/signup', function () {
    return view('auth/signup');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
    // home - dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // views de criar evento
    Route::get('/create-event', [EventController::class, 'createEvent'])->name('step1');
    Route::post('/eventStep', [EventController::class, 'postEventStep'])->name('post.event.step');

    Route::get('/create-event/2', [EventController::class, 'createEvent2'])->name('step2');
    Route::post('/eventStep2', [EventController::class, 'postEventStep2'])->name('post.event.step2');

    Route::get('/create-event/3', [EventController::class, 'createEvent3'])->name('step3');
    Route::post('/eventStep3', [EventController::class, 'postEventStep3'])->name('post.event.step3');

    Route::get('/create-event/3/template', [EventController::class, 'createEvent3Template'])->name('step3.template');
    Route::post('/eventStepTemplate', [EventController::class, 'postEventStepTemplate'])->name('post.event.stepTemplate');

    Route::get('/create-event/3/summery', [EventController::class, 'createEvent3Summery'])->name('step3.summery');

    Route::get('/eventStepSuccess', [EventController::class, 'eventStepSuccess'])->name('event.success');
    Route::post('/eventStepSuccess', [EventController::class, 'postEventStepSuccess'])->name('post.event.stepSuccess');


    // edit
    Route::get('/edit-event/{id}', [EventController::class, 'editEvent'])->name('edit.event');
    Route::post('/edit-event/{id}', [EventController::class, 'saveEditEvent'])->name('post.save.edit.event');

    Route::get('/edit-event-step2/{id}', [EventController::class, 'editEventStep2'])->name('edit.event.step2');
    Route::post('/edit-event-step2/{id}', [EventController::class, 'saveEditEventStep2'])->name('post.save.edit.event.step2');

    Route::get('/edit-event-step3/{id}', [EventController::class, 'editEventStep3'])->name('edit.event.step3');
    Route::post('/edit-event-step3/{id}', [EventController::class, 'saveEditEventStep3'])->name('post.save.edit.event.step3');

    Route::get('/edit-event-step3-template/{id}', [EventController::class, 'editEventStep3Template'])->name('edit.event.step3Template');
    Route::post('/edit-event-step3-template/{id}', [EventController::class, 'saveEditEventStep3Template'])->name('post.save.edit.event.step3Template');

    Route::get('/edit-event-step3-summery/{id}', [EventController::class, 'editEventStep3Summery'])->name('edit.event.step3Summery');
    Route::post('/edit-event-step3-summery/{id}', [EventController::class, 'saveEditEventStep3Summery'])->name('post.save.edit.event.step3Summery');

    Route::get('/eventEditStepSuccess/{id}', [EventController::class, 'eventEditStepSuccess'])->name('event.edit.success');


    // view configurações
    Route::get('/settings/details', [DashboardController::class, 'settings'])->name('settings.details');
    Route::get('/settings/bank', [DashboardController::class, 'bank'])->name('settings.bank');
    Route::get('/settings/balance', [DashboardController::class, 'balance'])->name('settings.balance');
    Route::get('/settings/password', [DashboardController::class, 'password'])->name('settings.password');
    Route::get('/settings/policy', [DashboardController::class, 'policy'])->name('settings.policy');
    Route::get('/settings/termsOfUse', [DashboardController::class, 'termsOfUse'])->name('settings.termsOfUse');
    
    Route::post('/settings/details', [UserController::class, 'postDetailsAccount'])->name('post.details.account');
    Route::post('/settings/bank', [UserController::class, 'postDetailsBank'])->name('post.details.bank');
    Route::post('/settings/password', [UserController::class, 'postChangePassword'])->name('post.change.password');

    // eventos
    Route::get('/events/{id}', [DashboardController::class, 'events'])->name('events');

    // email
    Route::post('/sendEmailEvent', [EventController::class, 'sendEmailEvent'])->name('send.email.event');

});

//convite
Route::get('/convite/{id}', [InviteeController::class, 'convite']);
Route::get('/convite/{id}/confirm', [InviteeController::class, 'conviteConfirm']);
Route::post('/convite/{id}/confirm', [InviteeController::class, 'conviteSaveConfirm'])->name('post.save.confirm');

Route::get('/convite/{id}/pix/{id_pix}', [InviteeController::class, 'pixPayment'])->name('pix.payment');

Route::get('/convite/{id}/success/{invitee}', [InviteeController::class, 'conviteSuccess'])->name('journey.success');


Route::middleware('auth:admin')->post('/add-campaign-payouts', [CampaignController::class, 'addCampaignPayouts'])->name('add.campaignPayout');
Route::middleware('auth:admin')->get('/download/{path}', [CampaignController::class, 'download']);
Route::middleware('auth:admin')->post('/admin/changeTabCampaign', [AdminCampaignController::class, 'changeTab']);
    
Route::group(['prefix' => 'admin'], function () {
    Route::middleware('auth:admin')->get('list-webhook', [WebhookController::class, 'listWebhook']);
    Route::middleware('auth:admin')->get('create-webhook-url', [WebhookController::class, 'createWebhookUrl']);
    Voyager::routes();
});

//Route::post('receive-status', [WebhookController::class, 'receiveStatus']);
Route::post('/verifyPixPayment', [InviteeController::class, 'verifyPixPayment']);

Route::get('/novoteste', [InviteeController::class, 'novoteste']);