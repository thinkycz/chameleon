<?php

namespace App\Http\Controllers;

use App\Events\ContactFormSubmitted;
use App\Http\Requests\Contact\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function contact(ContactRequest $request)
    {
        event(new ContactFormSubmitted($request->get('name'), $request->get('email'), $request->get('message')));

        snackbar()->success(trans('contact.contact_success'));

        return redirect()->back();

    }
}
