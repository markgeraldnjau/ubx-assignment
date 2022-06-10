<?php

namespace App\Http\Controllers;

use App\Models\AddressGroup;
use App\Models\Contact;
use App\Models\SendSmsResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

class CampaignController extends Controller
{
    //
    public function index()
    {
        return view('campaign.index');
    }

    public function groupMessage()
    {
        $address_groups = AddressGroup::where('user_id', Auth::id())
            ->where('total_contacts', '>', '0')
            ->orderBy('id', 'desc')
            ->get();
        // return $address_groups;

        return view('campaign.groupmessage.index')
            ->with('address_groups', $address_groups);;
    }

    public function sendMessageApi(Request $request)
    {

        // return $request;
        $groupList = json_decode($request->groupList);
        // return $groupList;
        $contactList = [];
        foreach ($groupList as $group) {

            $contacts = Contact::select(
                //"contacts.id",
                "contacts.phone_number",
                //DB::raw("CONCAT(first_name, ' ', last_name) AS fullName")
            )
                ->where('address_group_id', $group->id)
                ->get();
                // return $contacts;

            foreach ($contacts as $contact) {
                $contactList[] = array('recipient_id' => $contact->phone_number, 'dest_addr' => $contact->phone_number);
            }
        }

                // return $contactList;


        $api_key = '0f5528b3c45ccc7a';
        $secret_key = 'OWI0MzgxNmI2OWQzNWQ3MTNiZjM1ZTRhODJmZDdjMWJhM2U1MWU1YzY5YTcxNzQ4NWZkOTllMDc1Y2FiNTNkMA==';

        $postData = array(
            'source_addr' => 'INFO',
            'encoding' => 0,
            'schedule_time' => '',
            'message' => $request->textMessage,
            'recipients' => $contactList
        );
        return $postData;
        $Url = 'https://apisms.beem.africa/v1/send';


        $ch = \curl_init($Url);
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Authorization:Basic ' . base64_encode("$api_key:$secret_key"),
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => json_encode($postData)
        ));

        $response = curl_exec($ch);

        if ($response === FALSE) {
            return $response;
            die(curl_error($ch));
        }

        $jsonResponse = json_decode($response, true);
        // return $jsonResponse;
        $sendmessage = new SendSmsResponse();
        $sendmessage->successful = $jsonResponse['successful'];
        $sendmessage->request_id = $jsonResponse['request_id'];
        $sendmessage->code = $jsonResponse['code'];
        $sendmessage->message = $jsonResponse['message'];
        $sendmessage->valid = $jsonResponse['valid'];
        $sendmessage->invalid = $jsonResponse['invalid'];
        $sendmessage->duplicates = $jsonResponse['duplicates'];
        $sendmessage->save();
        Session::flash('status_message_success', 'Success: Messages Sent!');
        return back();
    }
}
