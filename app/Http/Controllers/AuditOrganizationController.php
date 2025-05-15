<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuditOrgnization;
use Carbon\Carbon;

class AuditOrganizationController extends Controller
{
 public function index()
    {
        $audit_orgnizations = AuditOrgnization::all();
        return view('audit_orgnizations.index', compact('audit_orgnizations'));
    }


// Show form for creating a new post
    public function create()
    {
        return view('audit_orgnizations.create');
    }  
    
    
    // Store a new post
    public function store(Request $request)
    {
        // dd( $request);die;
       $request->validate([
            'company_name' => 'required|string|max:255',
            'short_name' => 'required|string',
            'address' => 'required|string',
            'com_reg_detail' => 'required|string',
            'company_logo' => 'required|string',
        ]);



        AuditOrgnization::create([
            'company_name' => $request->company_name,
            'short_name' => $request->short_name,
            'address' => $request->address,
            'com_reg_detail' => $request->com_reg_detail,
            'company_logo' => $request->company_logo,
            'created_at' => Carbon::now()
        ]);

         return redirect()->route('organization.index');
    }

    // Show a specific post
    public function show(AuditOrgnization $audit_orgnizations)
    {
        // dd($audit_orgnizations);
        return view('audit_orgnizations.show', compact('audit_orgnizations'));
    }

    // Show form for editing a post
    public function edit(AuditOrgnization $audit_orgnizations)
    {
        return view('audit_orgnizations.edit', compact('audit_orgnizations'));
    }

    // Update a post
    public function update(Request $request, AuditOrgnization $audit_orgnizations)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'address' => 'required|string',
        ]);

        $audit_orgnizations->update([
            'company_name' => $request->company_name,
            'address' => $request->address,
        ]);

        return redirect()->route('organization.index');
    }

    // Delete a post
    public function destroy(AuditOrgnization $audit_orgnizations)
    {
        $audit_orgnizations->delete();
        return redirect()->route('organization.index');
    }
}
