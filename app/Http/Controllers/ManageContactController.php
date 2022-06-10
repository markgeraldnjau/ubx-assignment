<?php

namespace App\Http\Controllers;

use App\Models\AddressGroup;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ManageContactController extends Controller
{
    //
    public function index()
    {

        // return Auth::id();
        $address_groups = AddressGroup::where('user_id', Auth::id())->orderBy('id', 'desc')->get();

        return view('contactsmanagement.index')
            ->with('address_groups', $address_groups);
    }

    public function viewImportContacts()
    {

        // return Auth::id();
        $address_groups = AddressGroup::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        $contactFields = Schema::getColumnListing('contacts');
        // return $contactFields;

        $contactFieldsNames = [

            "first_name"=> $contactFields[2],
            "last_name"=> $contactFields[3],
            "phone_number"=> $contactFields[4],
            "email"=> $contactFields[5],
            "dob"=> $contactFields[6],
            "gender"=> $contactFields[7],
            
        ];

        return view('contactsmanagement.importcontacts')
            ->with('address_groups', $address_groups)
            ->with('contactFieldsNames', $contactFieldsNames);
    }


    
}
