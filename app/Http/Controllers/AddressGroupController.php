<?php

namespace App\Http\Controllers;

use App\Models\AddressGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AddressGroupController extends Controller
{
    //
    public function addAddressGroup(Request $request)
    {
        //validating the data
        $validator = Validator::make($request->all(), [

            'title' => 'required',
        ]);

        if ($validator->fails()) {

            Session::flash('status_message_warning', 'Warning: Validation fail!!');
        } else {


            $addressGroupExists = AddressGroup::where('title', '=', $request->title)->first();

            if ($addressGroupExists === null) {

                $address_group = new AddressGroup();
                $address_group->user_id = Auth::id();
                $address_group->title = $request->title;
                $address_group->description = $request->description;
                $address_group->save();

                if ($addressGroupExists === null) {

                    Session::flash('status_message_success', 'Success: Category '  . $request->title . ' created!');
                    return back();
                } else {
                    // Return failed
                    Session::flash('status_message_failed', 'Failed: There is something wrong please try again');
                    return back();
                }
            } else {
                // Return failed
                Session::flash('status_message_warning', 'Failed: Address Group Title Exist');
                return back();
            }
        }
    }

    public function ajaxAddAddressGroup(Request $request)
    {
        // return $request->groupTitle;
        if ($request->ajax()) {
            // return $request;
            $addressGroupExists = AddressGroup::where('title', '=', $request->groupTitle)->first();
            if ($addressGroupExists === null) {

                $address_group = new AddressGroup();
                $address_group->user_id = Auth::id();
                $address_group->title = $request->groupTitle;
                $address_group->description = $request->groupDescription;
                $address_group->save();

                if ($addressGroupExists === null) {

                    return response()->json([
                        'success' => 'Success: Category '  . $request->title . ' created!',
                        'address_groups' => AddressGroup::select('id', 'title')
                        ->where('total_contacts', '>' , '0')
                        ->where('user_id', Auth::id())
                        ->orderBy('id', 'desc')
                        ->get(),
                    ]);
                } else {
                    // Return failed
                    return response()->json([
                        'failed' => 'Failed: There is something wrong please try again',
                        'address_groups' => AddressGroup::select('id', 'title')
                        ->where('total_contacts', '>' , '0')
                        ->where('user_id', Auth::id())
                        ->orderBy('id', 'desc')
                        ->get(),
                    ]);
                }
            } else {
                // Return failed
                return response()->json([
                    'exist' => 'Failed: Address Group Title Exist',
                    'address_groups' => AddressGroup::select('id', 'title')
                    ->where('total_contacts', '>' , '0')
                        ->where('user_id', Auth::id())
                        ->orderBy('id', 'desc')
                        ->get(),
                ]);
            }
        }
    }


    public function viewAddressGroup($id)
    {
        // return $event;
        $address_group = AddressGroup::where('id', $id)->with('contacts')
            ->first();
        // return $address_group->contacts;

        return view('contactsmanagement.addressgroup.index')
            ->with(compact(
                'address_group',
            ));
    }
}
