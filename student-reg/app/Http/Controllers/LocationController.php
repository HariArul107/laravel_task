<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocationController extends Controller
{

    private $countries = [
        1 => 'India',
        2 => 'USA'
    ];

    private $states = [
        1 => [1 => 'Maharashtra', 2 => 'Karnataka'],
        2 => [3 => 'California', 4 => 'Texas']
    ];                   

    private $cities = [
        1 => [1 => 'Mumbai', 2 => 'Pune'],
        2 => [3 => 'Bangalore', 4 => 'Mysore'],
        3 => [5 => 'Los Angeles', 6 => 'San Francisco'],
        4 => [7 => 'Houston', 8 => 'Dallas']
    ];

    public function index()
    {
        // Load view with countries
        return view('dropdown.dropdown-form', ['countries' => $this->countries]);
    }

    public function getStates(Request $request)
    {
        $country_id = (int) $request->country_id;
        $states = $this->states[$country_id] ?? [];
        $options = '';
        foreach ($states as $id => $name) {
            $options .= "<option value='$id'>$name</option>";
        }
        return response($options);
    }

    public function getCities(Request $request)
    {
        $state_id = (int) $request->state_id;
        $cities = $this->cities[$state_id] ?? [];
        $options = '';
        foreach ($cities as $id => $name) {
            $options .= "<option value='$id'>$name</option>";
        }
        return response($options);
    }
}
