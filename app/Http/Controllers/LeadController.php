<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Http\Requests\LeadRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Auth::user()->leads()->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $leads = $query->paginate(10)->withQueryString();

        return view('leads.index', compact('leads'));
    }

    
    public function create()
    {
        return view('leads.create');
    }

    
    public function store(LeadRequest $request)
    {
        Auth::user()->leads()->create($request->validated());
        return redirect()->route('leads.index')->with('success', 'Lead created successfully.');
    }

    
    public function show(Lead $lead)
    {
        $this->authorize('view', $lead);
        $lead->load([
            'tasks' => function ($q) {
                $q->latest();
            }
        ]);
        return view('leads.show', compact('lead'));
    }

    
    public function edit(Lead $lead)
    {
        $this->authorize('update', $lead);
        return view('leads.edit', compact('lead'));
    }

    
    public function update(LeadRequest $request, Lead $lead)
    {
        $this->authorize('update', $lead);
        $lead->update($request->validated());
        return redirect()->route('leads.index')->with('success', 'Lead updated successfully.');
    }

    
    public function destroy(Lead $lead)
    {
        $this->authorize('delete', $lead);
        $lead->delete();
        return redirect()->route('leads.index')->with('success', 'Lead deleted successfully.');
    }
}
