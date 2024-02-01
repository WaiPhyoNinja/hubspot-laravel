<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\HubspotContact;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{
    public function userList(Request $request): JsonResponse
  {
    try {
      $contacts = collect(getContact());
      $datatablesData = $contacts->map(function ($contact) {
        return [
          'id' => $contact['id'],
          'first_name' => $contact['properties']['firstname'] ?? '',
          'last_name' => $contact['properties']['lastname'] ?? '',
          'email' => $contact['properties']['email'] ?? '',
          'createdate' => $contact['properties']['createdate'] ?? '',
          'lastmodifieddate' => $contact['properties']['lastmodifieddate'] ?? ''
        ];
      });

      if ($request->ajax()) {
        return Datatables::of($datatablesData)->addIndexColumn()
          ->make(true);
      }
    } catch (\Exception $e) {
      echo 'Error : '.$e->getMessage();
    }
  }

  /**
   * This function is used to display contact list from hubspot
   *
   * @return View
   */
  public function displayUser(): View
  {
    return view('home');
  }

  /**
   * This function is used to display
   *
   * @return View
   */
  public function signupUser(): View
  {
    return view('signup_news');
  }

  /**
   * This function is used to store custom contact
   *
   * @return View
   */
  public function storeContact(Request $request)
  {
    try {

        $data = [
            'properties' => [
                [
                    'property' => 'email',
                    'value' => $request->email
                ],
                [
                    'property' => 'firstname',
                     'value' => $request->first_name
                ],
                [
                    'property' => 'lastname',
                    'value' => $request->last_name
                ],
                [
                    'property' => 'phone',
                    'value' => $request->phone
                ],
            ],
        ];

        createHubSpotContact($data);

        return back()->with('success', 'Contact created successfully');
    } catch (\Exception $e) {
        echo 'Error : '.$e->getMessage();
    }
  }

}
