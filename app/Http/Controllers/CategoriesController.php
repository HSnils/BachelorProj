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
		$allCategories = Categories::select('type')->get();
		return view('categories.create', compact('allCategories'));
	}
	
	public function createCategory(){
		$this->validate(request(), [
			'category' => 'required|min:4|max:30',
			'type' => 'required|max:30'
		]);
		
		$isAdmin = auth()->user()->role == 'Admin';

		if ($isAdmin){
			$category = new Categories();
			$category->createCategory(request());

			//Flashes the session with a value for notify user
			//Flash only lasts for 1 redriect
			session()->flash('notifyUser', 'Category created!');
			return redirect()->route('categories');
		} else {
			session()->flash('notifyUser', 'You are not administrator!');
		}
	}
	
	public function showEdit($cat){
		$thisCategory = Categories::where('category', $cat)->get();
		return view('categories.edit', compact('thisCategory'));
	}
	
	public function editCategory($category){
		$this->validate(request(), [
			'category' => 'required|min:4|max:30',
			'type' => 'required|max:30'
		]);

		$isAdmin = auth()->user()->role == 'Admin';

		if ($isAdmin){
			$category = new Categories();
			$category->updateCategory(request(), $category);

			//Flashes the session with a value for notify user
			//Flash only lasts for 1 redriect
			session()->flash('notifyUser', $category);
			return redirect()->route('categories');
		} else {
			session()->flash('notifyUser', 'You are not administrator!');
		}
	}
}
