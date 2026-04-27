<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Start with ONLY the authenticated user's tickets
        $tickets = Auth::user()->tickets();

        // If the user is an admin, override and show ALL tickets
        if (Auth::user()->is_admin) {
            $tickets = Ticket::query();
        }

        // Apply status filter
        if (request('status')) {
            $tickets->where('status', request('status'));
        }

        // Apply priority filter
        if (request('priority')) {
            $tickets->where('priority', request('priority'));
        }

        // Final ordering
        $tickets = $tickets->latest()->get();

        return view('ticket.index', compact('tickets'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // User must be authenticated — handled by auth middleware on the route
        return view('ticket.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        $validated = $request->validated();

        $ticket = new Ticket($validated);
        $ticket->user_id = Auth::id(); // make sure ownership is set

        if ($request->hasFile('image')) {
            $ticket->image_path = $request->file('image')->store('tickets', 'public');
        }

        $ticket->save();

        return redirect()->route('ticket.show', $ticket);
    }


    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        $user = Auth::user();

        // Authorization: normal users can only view their own tickets
        if (! $user->is_admin && $ticket->user_id !== $user->id) {
            abort(403);
        }

        // Eager-load notes if you want (recommended)
        $ticket->load('notes');

        return view('ticket.show', compact('ticket'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        // (optional: auth check like in show)
        return view('ticket.edit', compact('ticket'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $user = Auth::user();

        // Authorization: normal users can only delete their own tickets
        if (! $user->is_admin && $ticket->user_id !== $user->id) {
            abort(403);
        }

        $ticket->delete();

        return redirect()->route('ticket.index')
            ->with('success', 'Ticket deleted.');
    }
}
