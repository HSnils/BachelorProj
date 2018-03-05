<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipments;

class EquipmentsController extends Controller
{
    /**
     * Fetches all categories and items which are open from the database.
     * @return callable Returns the home.index view along with the categories
     * and items.
     */
    public function index()
    {
    	$allEquipments = Equipments::all();
		return view('equipments.index', compact('allEquipments'));
    }
}