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

	public function indexAdmin()
	{
		$allEquipments = Equipments::all();
		return view('equipments.admin', compact('allEquipments'));
	}


	public function newEquipment(){
		return view('equipments.create');
	}

	public function createEquipment(){
		$this->validate(request(), [
			'name' => 'required|min:4|max:30',
			'type' => 'required',
			'location' => 'required',
			'desc' => 'required|min:10|max:255',
			'lockdown' => 'required',
			'other_documentation' => 'max:255'
		]);

		$isAdmin = auth()->user()->role == 'Admin';

		if ($isAdmin){
			$equipment = new Equipments();
			$equipment->createEquipment(request());

			//Flashes the session with a value for notify user
			//Flash only lasts for 1 redriect
			session()->flash('notifyUser', 'Equipment created!');
			return redirect()->route('equipmentsAdmin');
		} else {
			session()->flash('notifyUser', 'You are not administrator!');
		}
	}

	public function showEdit($equipment){
		$thisEquipment = Equipments::where('id', $equipment)->get();
		return view('equipments.edit', compact('thisEquipment'));
	}

	public function editEquipment($id){
		$this->validate(request(), [
			'name' => 'required|min:4|max:30',
			'type' => 'required',
			'location' => 'required',
			'desc' => 'required|min:10|max:255',
			'lockdown' => 'required',
			'other_documentation' => 'max:255'
		]);

		$isAdmin = auth()->user()->role == 'Admin';

		if ($isAdmin){
			$equipment = new Equipments();
			$equipment->updateEquipment(request(),$id);

			//Flashes the session with a value for notify user
			//Flash only lasts for 1 redriect
			session()->flash('notifyUser', $id);
			return redirect()->route('equipmentsAdmin');
		} else {
			session()->flash('notifyUser', 'You are not administrator!');
		}
	}
}