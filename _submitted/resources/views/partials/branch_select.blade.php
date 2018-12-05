<?php 
	use App\Branch;
?>

@if(Branch::first())
	<select name="branch_id">
		@foreach(Branch::all() as $branch)
			<option value="{{ $branch->id }}" {{ isset($selectedBranch) && $selectedBranch == $branch ? 'selected' : ''}}>
				{{ $branch->name }}
			</option>
		@endforeach
	</select>
@else
	V databázi nejsou žádné pobočky.
@endif