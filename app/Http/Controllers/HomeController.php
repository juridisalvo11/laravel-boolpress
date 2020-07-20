<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\NewContact;
use Illuminate\Support\Facades\Mail;
use App\Lead;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function contacts() {
      return view('contacts');
    }

    public function contactsStore(Request $request) {

      $dati_email = $request->all();
      $new_lead = new Lead();
      $new_lead->fill($dati_email);
      $new_lead->save();


      Mail::to('support@boolpress.com')->send(new NewContact($new_lead));
      return redirect()->route('home');
    }
}
