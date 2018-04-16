<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;

class CategoriesController extends Controller
{
	//
	public function index()
	{
		$allCategories = Categories::all();
		return view('categories.index', compact('allCategories'));
	}
	
	public function newCategory(){
		$allCategories = Categories::select('category')->get();
		return view('categories.create', compact('AllCategories'));
	}
	
	public function createCategory(){
		$this->validate(request(), [
			'type' => 'required'
		]);
		
		$isAdmin = auth()->user()->role == 'Admin';

		if ($isAdmin){
			$equipment = new Equipments();
			$equipment->createEquipment(request());

			//Flashes the session with a value for notify user
			//Flash only lasts for 1 redriect
			session()->flash('notifyUser', 'Category created!');
			return redirect()->route('categories');
		} else {
			session()->flash('notifyUser', 'You are not administrator!');
		}
	}
	
	public function showEdit($category){
		$thisCategory = Categories::where('category', $category)->get();
		return view('categories.edit', compact('thisCategory'));
	}
	
	public function editCategory($category){
		$this->validate(request(), [
			'type' => 'required'
		]);

		$isAdmin = auth()->user()->role == 'Admin';

		if ($isAdmin){
			$category = new Categories();
			$category->updateCategory(request(),$category);

			//Flashes the session with a value for notify user
			//Flash only lasts for 1 redriect
			session()->flash('notifyUser', $id);
			return redirect()->route('categories');
		} else {
			session()->flash('notifyUser', 'You are not administrator!');
		}
	}
}
