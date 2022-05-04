<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketCreatePostRequest;
use App\Models\Category;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrivateController extends Controller
{
    public function home(){
        //felhasználóhoz tartozó ticket
        $user = Auth::user();
        $tickets = $user->tickets;
        //var_dump($tickets);
        //nézet visszadása
        return view('private.home', [
            'tickets' => $tickets,
            'categories' => Category::all()
        ]);
    }

    public function store(TicketCreatePostRequest $req){
        $ticket = new Ticket();
        $ticket->user_id = Auth::id();
        $ticket->category_id = $req->ticket_category_id;
        $ticket->status = "received";
        $ticket->priority = $req->ticket_prio;
        $ticket->description = $req->ticket_description;
        $ticket->save();
        return redirect()->route('private.home');
    }
}
