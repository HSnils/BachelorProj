$(document).ready(function () {
	$.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });

	//Click function which makes a ajax request.
	$('.filter').click(function(e){
		e.preventDefault();
		$category = $(this).attr('value');

		$.get('home/' + $category, onSuccessCategory);
	});

	// Prints the fetched data (from database) to the user.
	function onSuccessCategory(data, status, xhr) {
		//Parse data and clear the html div container.
		$data = JSON.parse(data);
		$('.flex-container-home').html('');

		//Update the "Sorting by:" text.
		$category = $category.replace(/_/g, ' ');
		$('.sortBy').html('Sorting by: ' + $category);

		// HTML builder
		for (i in $data) {
			$item = $([
				"<a class='itemBox' href='items/" + $data[i].id + "'>",
					"<h3>" + $data[i].title + "</h3>",
					"<section class='itemContent'>",
						"<span>Category: <b>" + $data[i].category + "</b></span>",
						"<br>",
						"<span>Created: <b>"+ $data[i].created_at + "</b></span>",
						"<br>",
						"<br>",
						"<span>Owner: <b>" + $data[i].user.name + "</b></span>",
						"<br>",
						"<span>Views: <b>" + $data[i].views + "</b></span>",
					"</section>",
				"</a>"
			].join("\n"));
			$('.flex-container-home').append($item);
		}
	}


	//AJAX search
	//Keyup function which makes a ajax request after each keystroke.
	$('#search').keyup(function(e){
		e.preventDefault();

		//gets the searchinput
		$search = $(this).val();

		//Update "Sorting by:" text, and run  
		if ($search) {
			$('.sortBy').html('Sorting by: ' + $search);
			$.get('search/' + $search, onSuccessSearch);
		} else {
			$('.sortBy').html('Sorting by: Recent items');
			$.get('search', onSuccessSearch);
		}
	});

	// Prints the fetched data (from database) to the user.
	function onSuccessSearch(data, status, xhr) {
		//Parse data and clear the html div container
		$data = JSON.parse(data);
		$('.flex-container-home').html('');

		// HTML builder
		for (i in $data) {
			$item = $([
				"<a class='itemBox' href='items/" + $data[i].id + "'>",
					"<h3>" + $data[i].title + "</h3>",
					"<section class='itemContent'>",
						"<span>Category: <b>" + $data[i].category + "</b></span>",
						"<br>",
						"<span>Created: <b>"+ $data[i].created_at + "</b></span>",
						"<br>",
						"<br>",
						"<span>Owner: <b>" + $data[i].user.name + "</b></span>",
					"</section>",
				"</a>"
			].join("\n"));
			$('.flex-container-home').append($item);
		}
	};


	//Admin page
	//Click function which makes a ajax request.
	$('.choice').click(function(e){
		e.preventDefault();
		$choice = $(this).attr('value');

		$.get('admin/' + $choice, onSuccessAdmin);
	});

	// Prints the fetched data (from database) to the user.
	function onSuccessAdmin(data, status, xhr) {
		//Parses the data
		$data = JSON.parse(data);

		//hides all boxes
		$('#categoryDisplay').hide();
		$('#usersDisplay').hide();
		$('#itemsDisplay').hide();

		//removes all tables html
		$('#categoryTable').html('');
		$('#usersTable').html('');
		$('#itemsTable').html('');

		// HTML builder based on which choice that is requested.
		if($choice == 'categories'){
			$('#categoryDisplay').show();

			for (i in $data) {
				// checks how many items are connected to a category
				var x;
				var itemCount = 0;
				for (x in $data[i].items){
					// itemcount is increased by one each time a item is linked with category
					itemCount++;
				}

				$row = $([
					"<tr>",
						"<td><div class='categoryAdminSelect linkcolor' value='"+ $data[i].category +"'> "+ $data[i].category +"</td>",
						"<td>"+itemCount+"</td>",
						"<td><a href='category/delete/admin/"+ $data[i].category +"' class='profileButtons deleteButton'>Delete</a></td>",
					"</tr>"
				].join());
				$('#categoryTable').append($row);
			}

		} else if($choice == 'users'){

			$('#usersDisplay').show();

			for (i in $data) {

				// checks how many items are connected to a category
				var a;
				var itemCount = 0;
				for (a in $data[i].items){
					// itemcount is increased by one each time a item is linked with category
					itemCount++;
				}

				$row = $([
					"<tr>",
						"<td><div class='userSelect linkcolor' value='"+$data[i].id+"'>"+$data[i].name+"</div></td>",
						"<td>"+$data[i].email+"</td>",
						"<td>"+itemCount+"</td>",
						"<td><a href='users/delete/admin/"+$data[i].id+"' class='profileButtons  deleteButton'>Delete</a></td>",
					"</tr>"
				].join());
				$('#usersTable').append($row);
			}

		} else if($choice == 'items'){

			$('#itemsDisplay').show();
			
			for (i in $data) {

				$deletedDate = '';
				//checks if item is deleted
				if ($data[i].deleted_at == null){
					$deletedDate = "<a href='items/delete/admin/"+ $data[i].id +"' class='profileButtons deleteButton'>Delete</a>";
				} else {
					$deletedDate = $data[i].deleted_at;
				}
				$row = $([
					"<tr>",
						"<td><a href='items/"+$data[i].id+"' class='profileItemTitle'>"+$data[i].title+"</a></td>",
						"<td><div class='categoryAdminSelect linkcolor' value='"+ $data[i].category +"'>"+$data[i].category+"</div></td>",
						"<td><div class='viewsAdminSelect linkcolor'>"+$data[i].views+"</div></td>",
						"<td>"+$data[i].created_at+"</td>",
						"<td>"+$data[i].updated_at+"</td>",
						"<td><div class='userSelect linkcolor' value='"+$data[i].user_id+"'>"+$data[i].user.name+"</div></td>",
						"<td>"+$data[i].status+"</td>",
						"<td>"+$deletedDate+"</td>",
					"</tr>"
				].join());
				$('#itemsTable').append($row);
			}
		}
		
	};

	//admin sort items table by username
	/**
	 * Clickfunction on element with class .userSelect
	 * @param  int $user_id
	 * @return sets url with get and runs onSuccessAdminItemsSort function 
	 */
	$(document).on('click', '.userSelect', function(e){
		e.preventDefault();
		$user_id = $(this).attr('value');

		$.get('admin/items/' + $user_id, onSuccessAdminItemsSort);
	});

	//admin sort items table by category
	/**
	 * Clickfunction on element with class .categoryAdminSelect
	 * @param  string $category
	 * @return sets url with get and runs onSuccessAdminItemsSort function 
	 */
	$(document).on('click', '.categoryAdminSelect', function(e){
		e.preventDefault();
		$category = $(this).attr('value');

		$.get('admin/items/category/' + $category, onSuccessAdminItemsSort);
	});

	//admin sort items table by views
	/**
	 * Clickfunction on element with class .viewsAdminSelect
	 * @return sets url with get and runs onSuccessAdminItemsSort function 
	 */
	$(document).on('click', '.viewsAdminSelect', function(e){
		e.preventDefault();

		$.get('admin/items/views/sort', onSuccessAdminItemsSort);
	});

	//fills the table
	function onSuccessAdminItemsSort(data, status, xhr) {
		//Parse data and clear the html div container
		$data = JSON.parse(data);

		//hides all boxes
		$('#categoryDisplay').hide();
		$('#usersDisplay').hide();
		$('#itemsDisplay').hide();

		//removes all tables html
		$('#categoryTable').html('');
		$('#usersTable').html('');
		$('#itemsTable').html('');

		//shows itemdisplay
		$('#itemsDisplay').show();
		// HTML builder
		for (i in $data) {
			
			$deletedDate = '';
			//checks if item is deleted
			if ($data[i].deleted_at == null){
				$deletedDate = "<a href='items/delete/admin/"+ $data[i].id +"' class='profileButtons deleteButton'>Delete</a>";
			} else {
				$deletedDate = $data[i].deleted_at;
			};

			$row = $([
					"<tr>",
						"<td><a href='items/"+$data[i].id+"' class='profileItemTitle'>"+$data[i].title+"</a></td>",
						"<td><div class='categoryAdminSelect linkcolor' value='"+ $data[i].category +"'>"+$data[i].category+"</div></td>",
						"<td><div class='viewsAdminSelect linkcolor'>"+$data[i].views+"</div></td>",
						"<td>"+$data[i].created_at+"</td>",
						"<td>"+$data[i].updated_at+"</td>",
						"<td><div class='userSelect linkcolor' value='"+$data[i].user_id+"'>"+$data[i].user.name+"</div></td>",
						"<td>"+$data[i].status+"</td>",
						"<td>"+$deletedDate+"</td>",
					"</tr>"
				].join());
			$('#itemsTable').append($row);
		};
	};
});