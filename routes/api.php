<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\GithubWebhookController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\OrganizationRepositoryDetailsController;
use App\Http\Controllers\PullRequestController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', [Controller::class, 'routes'])
    ->name('route information')
    ->withoutMiddleware('api');
Route::get('/example', [Controller::class, 'example'])->name('example route');
Route::get('/error', [Controller::class, 'error'])->name('error route');

Route::post('register/organization', [OrganizationController::class, 'store'])->name('register.store')->middleware('verify.services');
Route::get('organization/{organization}', [OrganizationController::class, 'show']);
Route::post('organization/repositorydetails', [OrganizationRepositoryDetailsController::class, 'getOrganizationMembers'])->name('repositorydetails');
Route::get('services', [ServiceController::class, 'index'])->name('services.index');
Route::get('webhook', [WebhookController::class, 'index']);
Route::post('webhook', [WebhookController::class, 'store']);
Route::get('reviews', [PullRequestController::class, 'index']);
