<?php

use Log;
use HubSpot\Factory;
use App\Models\HubspotContact;
use HubSpot\Client\Crm\Contacts\ApiException;
use HubSpot\Client\Crm\Contacts\Model\SimplePublicObjectInput;

if (!function_exists('getContact')) {

    function getContact()
    {
        $client = Factory::createWithAccessToken(env('HUBSPOT_ACCESS_TOKEN'));
        try {
            $apiResponse = $client->crm()->contacts()->basicApi()->getPage(100,true);
            return $apiResponse['results'];
        } catch (ApiException $e) {
            echo "Exception when calling basic_api->get_page: ", $e->getMessage();
        }
    }
}

if (!function_exists('createHubSpotContact')) {
    function createHubSpotContact($data)
    {
        $client = Factory::createWithAccessToken(env('HUBSPOT_ACCESS_TOKEN'));
        try {

            $response = $client->crm()->contacts()->basicApi()->create($data);
            Log::info('HubSpot API Response: ' . json_encode($response));
        } catch (ApiException $e) {
            // Log or handle the exception appropriately
            \Log::error('HubSpot API Error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to create contact'], 500);

        }
    }
}
