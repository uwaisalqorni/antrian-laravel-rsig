<?php

use Illuminate\Support\Facades\Route;
use App\Exports\AntrianExport;

Route::get('/', function () {
    return
    to_route('filament.admin.auth.login');
});

Route::get('antrian/export', function(){
    return Excel::download(new AntrianExport, 'antrians.xlsx');
})->name('antrian-export');
