<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipments;
use App\Rooms;
use App\Bookings;

use Carbon\Carbon;

class EquipmentsController extends Controller
{
	/**
	 * Fetches all categories and items which are open from the database.
	 * @return callable Returns the home.index view along with the categories
	 * and items.
	 */
	public function index()
	{	
		$allRooms = Rooms::all(); //gets rooms for the sorting
		$equipmentsPerPagination = 10;
		$whereQuery = []; //creates array to fill with where queries

		if(\Request::has('room_number')){
			$room = \Request::input('room_number');
			array_push($whereQuery, ["location", $room]);
		}

		if(\Request::has('name')){
			$name = \Request::input('name') . '%';
			array_push($whereQuery, ["name", 'LIKE', $name]);
		}

		$allEquipments = Equipments::where($whereQuery)->paginate($equipmentsPerPagination);
		return view('equipments.index', compact('allEquipments', 'allRooms'));
				
	}

	public function indexAdmin()
	{
		$allRooms = Rooms::all(); //gets rooms for the sorting
		$equipmentsPerPagination = 10;
		$whereQuery = [];
		if(\Request::has('room_number')){
			$room = \Request::input('room_number');
			array_push($whereQuery, ["location", $room]);
		}
		if(\Request::has('name')){
			$name = \Request::input('name') . '%';
			array_push($whereQuery, ["name", 'LIKE', $name]);
		}
		if(\Request::has('lockdown')){
			$lockdown = \Request::input('lockdown');
			array_push($whereQuery, ['lockdown', $lockdown]);
		} 

		$allEquipments = Equipments::where($whereQuery)->paginate($equipmentsPerPagination);
		return view('equipments.admin', compact('allEquipments', 'allRooms'));
	}

	//function for showing spesific equipment
	public function showEquipment($id){
		$paginationNumber = 10;
		$equipment = Equipments::where('id',$id)->first();

		$dateNow = new Carbon();

		$bookingsOnThisEquipment = Bookings::
		join('bookings_equipments','bookings_equipments.bookings_id','=','bookings.id')
		->join('equipments','equipments.id','=','bookings_equipments.equipment_id')
		->where('equipments.id',$id)
		->where('bookings.from_date','>=', $dateNow)
		->paginate($paginationNumber);

		return view('equipments.show', compact('equipment','bookingsOnThisEquipment'));
	}

	public function reportDamage($id){	
		$dateReported = new Carbon();
		$prev_other_doc = Equipments::where('id', $id)->select('other_documentation')->first()->other_documentation;
		$report = \Request::input('report');

		$new_other_doc = $prev_other_doc.' Reported damage: '.$report.' Date reported: '.$dateReported;
		Equipments::where('id', $id)
			->update([
				'other_documentation' => $new_other_doc
		]);
		
		//Flashes the session with a value for notify user
		//Flash only lasts for 1 redriect
		session()->flash('notifyUser', 'Report sent!');	
		return redirect()->back();
	}


	public function newEquipment(){
		$allRooms = Rooms::select('room_number')->get();
		return view('equipments.create', compact('allRooms'));
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
		$allRooms = Rooms::select('room_number')->get();
		$thisEquipment = Equipments::where('id', $equipment)->get();
		return view('equipments.edit', compact('thisEquipment','allRooms'));
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
			session()->flash('notifyUser', 'Equipment updated!');
			return redirect()->route('equipmentsAdmin');
		} else {
			session()->flash('notifyUser', 'You are not administrator!');
		}
	}
}