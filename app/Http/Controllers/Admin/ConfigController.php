<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class ConfigController extends Controller
{
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cache_config()
    {
        $exitCode = Artisan::call('config:cache');
        return redirect()->back()->with('success', 'Cache successfully configured!');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cache_clear()
    {
        $exitCode = Artisan::call('cache:clear');
        return redirect()->back()->with('success', 'Cache successfully clear!');
    }

    public function clear_view()
    {
        Artisan::call('view:clear');
        return redirect()->back()->with('success', 'View successfully clear!');
    }
}
