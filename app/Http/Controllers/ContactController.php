<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function create(): Factory|View|Application
    {
        return view('contact.create');
    }

    public function send(): Redirector|Application|RedirectResponse
    {
        $attributes = request()->validate([
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email' => 'required|email|max:50',
            'bday' => 'nullable|date',
            'additional_text' => 'required|max:255',
        ]);

        DB::insert('INSERT INTO contacts (email, first_name, last_name, bday, additional_text) VALUES (?,?,?,?,?)',
            [
                $attributes['email'],
                $attributes['first_name'],
                $attributes['last_name'],
                $attributes['bday'],
                $attributes['additional_text'],
            ]
        );

        return redirect('/')->with('success', 'Thank you for your message.');
    }
}
