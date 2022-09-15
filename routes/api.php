<?php

use App\Http\Controllers\Controller;
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
Route::get('webhook', [WebhookController::class, 'index']);
Route::post('webhook', [WebhookController::class, 'store']);

Route::get('testing', function () {
    $response = Http::withHeaders(
        [
            'Accept' => 'application/vnd.github+json',
            'Authorization' => 'Bearer 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'
        ]
    )->post('https://api.github.com/repos/acellware/onboard/hooks',
        [
            'name' => 'web',
            'active' => true,
            'events' => [
                "discussion",
                "pull_request",
                "pull_request_review",
                "pull_request_review_comment",
                "repository",
                "status",
            ],
            'config' => [
                'url' => "https://a9f1-102-89-41-214.eu.ngrok.io/webhook",
                'content_type' => "form",
                'insecure_ssl' => "0",
            ]
        ]
    );

    if($response->failed()) {
        // throw exception
        return ['failed' => $response->json()];
    }

    return $response->json();

});
