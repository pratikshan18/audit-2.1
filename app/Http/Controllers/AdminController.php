<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuditOrgnization;
use App\Models\AuditUsers;

class AdminController extends Controller
{  
    public function index()
    {
        // return view('admin.dashboard', compact('users'));
        return view('admin.admin_list');
    }

    public function create_admin()
    {  
        $companies = AuditOrgnization::getCompaniesList();
        return view('admin.create_admin', compact('companies'));
    }

    public function save_admin_data(Request $request)
    {
        // dd($request->all());
        // dd($request->input('name')); // or
        // dd($request->name);   
       $request->validate([
         'name'=>'required',
         'email'=>'required|email|unique:audit_user_header_all',
         'company_id'=>'required|exists:audit_orgnizations,id',
       ]);

       $inserted = AuditUsers::insert_admin($request->all());
       if ($inserted) {
          return redirect()->route('admin.admin_list')->with('success', 'Admin User created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create user. Please try again.');
        }

    }

    //---For fetch data to update
    public function admin_adit($id)
    {
        $response = AuditUsers::fetch_admin_user_data($id);
        if ($response['status']) {
            $user = $response['data'];
            $companies = DB::table('audit_orgnizations')->where('status', 1)->get();
             
            return view('admin.edit', compact('user', 'companies'));
        } else {
            return redirect()->back()->with('error', $response['message']);
        }
    }

    //----For Update Admin DAta 
    public function update_admin(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:audit_user_header_all,email,' . $id,
            'company_id' => 'required|exists:audit_orgnizations,id',
        ]);

        $updated = AuditUsers::updateAdminUser($id, $request->all());
        if ($updated) {
            return redirect()->route('admin.admin_list')->with('success', 'Admin user updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Update failed. Please try again.');
        }
    }

    //---For Delete Admin User
    public function delete_admin_user($id)
    {
        $delete = AuditUsers::deleteAdminUser($id);
        if($delete)
        {
           return redirect()->route('admin.admin_list')->with('success', 'Admin user deleted successfully.');
        }else{
            return redirect()->back()->with('error', 'Admin user not found or could not be deleted.');
        }
    }

}
