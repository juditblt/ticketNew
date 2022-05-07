<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketDestroyPostRequest;
use App\Http\Requests\TicketPermanentPostRequest;
use App\Http\Requests\TicketRevertPostRequest;
use App\Models\Ticket;
use Illuminate\Http\Request;


class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  view('admin.tickets', [
            'tickets' => Ticket::all(),
            'tickets_trash' => Ticket::onlyTrashed()->get()
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.tickets.show', [
            'ticket' => Ticket::find($id)
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TicketDestroyPostRequest $request)
    {
        /*
        $ticket = Ticket::find($request->id);
        $ticket->delete();
        */
        Ticket::destroy($request->id);
        return redirect()->route('admin.tickets');
    }

    // visszaállít:
    public function revert(TicketRevertPostRequest $request){
        $ticket = Ticket::onlyTrashed()->find($request->id);
        $ticket->restore();
        return redirect()->route('admin.tickets');
    }

    // végleges törlés:
    public function permanent(TicketPermanentPostRequest $request){
        $ticket = Ticket::withTrashed()->find($request->id);
        $ticket->forceDelete();
        return redirect()->route('admin.tickets');
    }
}
