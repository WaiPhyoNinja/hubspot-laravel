<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\HubspotContact;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

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

  public function productLists(Request $request)
  {
    try {
        $productsResource = collect(getProduct());
        $apiResponse = $productsResource->map(function ($product){
            return [
                'id' => $product['id'],
                'name' => $product['properties']['name'] ?? '',
                'properties_with_history' => $product['properties_with_history'],
                'description' => $product['properties']['description'] ?? '',
                'price' => $product['properties']['price'] ?? '',
                'createdate' => $product['properties']['createdate'] ?? '',
                'archived' => $product['archived'] ?? ''
              ];
        });
        // dd($apiResponse);
        if ($request->ajax()) {
            return Datatables::of($apiResponse)->addIndexColumn()
              ->make(true);
          }
          return view('products');

        // return $apiResponse->getData();
    } catch (\Exception $e) {
        // Handle exceptions
        echo "Exception when calling products API: " . $e->getMessage();
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
    // /**
    //  * This function is used to display contact list from hubspot
    //  *
    //  * @return View
    //  */
    // public function products(): View
    // {
    //     return view('products');
    // }
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
        // $data = [
        //     'properties' => [
        //         [
        //             'property' => 'email',
        //             'value' => $request->email
        //         ],
        //         [
        //             'property' => 'firstname',
        //                 'value' => $request->firstname
        //         ],
        //         [
        //             'property' => 'lastname',
        //             'value' => $request->lastname
        //         ],
        //         [
        //             'property' => 'phone',
        //             'value' => $request->phone
        //         ],
        //     ],
        // ];
        // $post_json = json_encode($data);

        // createHubSpotContact($post_json);

        // $arr = [
        //     'properties' => [
        //         'firstname' => $request['firstname'],
        //         'lastname' => $request['lastname'],
        //         'phone' => $request['phone'],
        //         'email' => $request['email'],
        //     ],
        // ];

        // $endpoint = 'https://api.hubapi.com/crm/v3/objects/contacts?hapikey=pat-na1-9588fc02-c857-412d-abf4-936152d5527c';
        // $client = new Client();

        // $res = $client->request('POST', $endpoint, [
        //     'json' => $arr,
        // ]);

        $arr = array(
            'properties' => array(
                array(
                    'property' => 'email',
                    'value' => 'apitest@hubspot.com'
                ),
                array(
                    'property' => 'firstname',
                    'value' => 'hubspot'
                ),
                array(
                    'property' => 'lastname',
                    'value' => 'user'
                ),
                array(
                    'property' => 'phone',
                    'value' => '555-1212'
                )
            )
        );
        $post_json = json_encode($arr);
        $hapikey = readline("Enter hapikey: (demo for the demo portal): ");
        $endpoint = 'https://api.hubapi.com/crm/v3/objects/contacts?hapikey=pat-na1-9588fc02-c857-412d-abf4-936152d5527c';
        $ch = @curl_init();
        @curl_setopt($ch, CURLOPT_POST, true);
        @curl_setopt($ch, CURLOPT_POSTFIELDS, $post_json);
        @curl_setopt($ch, CURLOPT_URL, $endpoint);
        @curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = @curl_exec($ch);
        $status_code = @curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_errors = curl_error($ch);
        @curl_close($ch);
        echo "curl Errors: " . $curl_errors;
        echo "\nStatus code: " . $status_code;
        echo "\nResponse: " . $response;

        return "Contact Created!";
    } catch (\Exception $e) {
        echo 'Error : '.$e->getMessage();
    }
  }

}
