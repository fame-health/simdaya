<?php

namespace App\Http\Controllers;

use App\Models\LandingPage;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        // Get the active landing page or create default data
        $landingPage = LandingPage::active()->first();

        if (!$landingPage) {
            // Create a default landing page if none exists
            $landingPage = LandingPage::create(LandingPage::getDefaultData());
        }

        return view('welcome', compact('landingPage'));
    }

    public function show(LandingPage $landingPage)
    {
        if (!$landingPage->is_active) {
            abort(404);
        }

        return view('welcome', compact('landingPage'));
    }
}
