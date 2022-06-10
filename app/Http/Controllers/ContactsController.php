<?php

namespace App\Http\Controllers;

use App\Models\AddressGroup;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use stdClass;

class ContactsController extends Controller
{
    //

    public function addContacts(Request $request)
    {

        // return $request;
        $validator = Validator::make($request->all(), [
            'address_group' => 'required',
            // 'phone_number' => ['required', 'min:12', 'max:12', 'unique:contacts'],
            'contactlist' => 'required',
        ]);

        if ($validator->fails()) {

            Session::flash('status_message_warning', 'Warning: Validation fail!!');
            return back();
        } else {

            $address_group = AddressGroup::find($request->address_group);
            // return $address_group;
            $contacts = $request['contactlist'];
            $contacts_number = count($contacts);
            $i = 0;
            foreach ($contacts as $contact) {

                $contactData = new Contact();
                $contactData->address_group_id = $address_group->id;
                $contactData->first_name = $contact['firstName'];
                $contactData->last_name = $contact['lastName'];
                $contactData->phone_number = $contact['phoneNumber'];
                $contactData->email = $contact['email'];
                $contactData->dob = $contact['dob'];
                $contactData->gender = $contact['gender'];
                $contactData->save();

                if (++$i === $contacts_number) {
                    $success = 1;
                } else {
                    $success = 0;
                }
            }
            $get_number_of_contacts = Contact::where('address_group_id', $request->address_group)->count();

            //Upadate Basic Services unserved number
            $update_number_of_contact_in_group = AddressGroup::where('id', $address_group->id)->update(['total_contacts' => $get_number_of_contacts]);

            if ($success === 1 && $update_number_of_contact_in_group) {

                Session::flash('status_message_success', 'Success: '  . $contacts_number . ' contacts created!');
                return back();
            } else {
                // Return failed
                Session::flash('status_message_failed', 'Failed: There is something wrong please try again');
                return back();
            }
        }
    }



    public function editContact(Request $request)
    {

        // return $request;
        $validator = Validator::make($request->all(), [

            'contact_id' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            'phoneNumber' => 'required',
            'email' => 'required',
            'dob' => 'required',
            'gender' => 'required',
        ]);

        if ($validator->fails()) {

            Session::flash('status_message_warning', 'Warning: Validation fail!!');
            return back();
        } else {

            $contact = Contact::find($request->contact_id);
            $contact->first_name = $request->firstName;
            $contact->last_name = $request->lastName;
            $contact->phone_number = $request->phoneNumber;
            $contact->email = $request->email;
            $contact->dob = $request->dob;
            $contact->gender = $request->gender;
            $contact->save();
            if ($contact) {

                Session::flash('status_message_success', 'Success: Contact Informatiion Updated!');
                return back();
            } else {
                // Return failed
                Session::flash('status_message_failed', 'Failed: There is something wrong please try again');
                return back();
            }
        }
    }


    public function deleteSelectedContacts(Request $request)
    {
        // return $request;
        $contactIDs = json_decode($request->selected_contacts, true);
        // return $contactIDs;
        $contacts_number = count($contactIDs);
        $i = 0;
        foreach ($contactIDs as $contactID) {

            $contact = Contact::find($contactID['id']);

            $contact->delete();

            if (++$i === $contacts_number) {
                $success = 1;
            } else {
                $success = 0;
            }
        }

        $get_number_of_contacts = Contact::where('address_group_id', $request->address_group_id)->count();
        $update_number_of_contact_in_group = AddressGroup::where('id', $request->address_group_id)->update(['total_contacts' => $get_number_of_contacts]);
        if ($success === 1 && $update_number_of_contact_in_group)  {
            //Return Success
            Session::flash('status_message_success', 'Success: '  . $contacts_number . ' Contacts Deleted !!');
            return back();
        } else {
            // Return failed
            Session::flash('status_message_failed', 'Failed: There is something wrong please try again');
            return back();
        }
    }

    public function importedContacts(Request $request)
    {
        // return $request;
        $validContacts = new stdClass();
        $validContacts = json_decode($request->validContacts);
        // return $validContacts;
        $contacts_number = count($validContacts);
        $iteration = 0;
        $success = "";
        foreach ($validContacts as $validContact) {

            $validContactObject = [
                'firstName' => "",
                "lastName" => "",
                "phoneNumber" => "",
                "email" => "",
                "dob" => "",
                "gender" => ""
            ];

            for ($i = 0; $i < $request->numberOfColumns; $i++) {
                $column = "selectfield-" . $i;

                if ($request->$column == "first_name") {
                    $firstNameIndex = "contactKey" . $i;
                    $validContactObject['firstName'] = $validContact->{$firstNameIndex};
                } else if ($request->$column == "last_name") {
                    $lastNameIndex = "contactKey" . $i;
                    $validContactObject['lastName'] = $validContact->{$lastNameIndex};
                } else if ($request->$column == "phone_number") {
                    $phoneNumberIndex = "contactKey" . $i;
                    $validContactObject['phoneNumber'] = $validContact->{$phoneNumberIndex};
                } else if ($request->$column == "email") {
                    $emailIndex = "contactKey" . $i;
                    $validContactObject['email'] = $validContact->{$emailIndex};
                } else if ($request->$column == "dob") {
                    $dobIndex = "contactKey" . $i;
                    $validContactObject['dob'] = $validContact->{$dobIndex};
                } else if ($request->$column == "gender") {
                    $genderIndex = "contactKey" . $i;
                    $validContactObject['gender'] = $validContact->{$genderIndex};
                }
            }

            $contactData = new Contact();
            $contactData->address_group_id = $request->address_group;
            $contactData->first_name = ($validContactObject['firstName'] == "") ? "" : $validContactObject['firstName'];
            $contactData->last_name = ($validContactObject['lastName'] == "") ? "" : $validContactObject['lastName'];
            $contactData->phone_number = $validContactObject['phoneNumber'];
            $contactData->email = ($validContactObject['email'] == "") ? "" : $validContactObject['email'];
            $contactData->dob = ($validContactObject['dob'] == "") ? null : $validContactObject['dob'];
            $contactData->gender = ($validContactObject['gender'] == "") ? "" : $validContactObject['gender'];
            $contactData->save();

            if (++$iteration === $contacts_number) {
                $success = 1;
            } else {
                $success = 0;
            }
        }
        $get_number_of_contacts = Contact::where('address_group_id', $request->address_group)->count();
        $update_number_of_contact_in_group = AddressGroup::where('id', $request->address_group)->update(['total_contacts' => $get_number_of_contacts]);

        if ($success === 1 && $update_number_of_contact_in_group) {

            Session::flash('status_message_success', 'Success: '  . $contacts_number . ' contacts imported!');
            return back();
        } else {
            // Return failed
            Session::flash('status_message_failed', 'Failed: There is something wrong please try again');
            return back();
        }
    }
}
