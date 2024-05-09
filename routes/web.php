<?php

use App\Events\TestBroad;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/publish', function(){
    return view('send');
})->name('publish');

Route::post('/publish', function(){
    $data = [
        'data' => request('data'),
        'message' => request('message'),
    ];
    event(new TestBroad($data));
    
    return redirect()->route('publish')->with('success', 'Message published successfully!');
})->name('publishmessage.post');
