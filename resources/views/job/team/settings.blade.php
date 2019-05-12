<table class="table">
	<tr>
		<th>Job Name</th>
		<th> Can View </th>
		<th> Can Edit </th>
		<th> Can Publish </th>
		<th> Can Preview </th>
	</tr>


	<tbody>
		<form method="post" action="">
		@foreach($permissions as $perm)
		<tr>
			<td>{{ $perm['title'] }}</td>

			<td> <input class="fluency" data-type="{{ $perm['id'] }}" data-id="{{ $perm['id'] }}" data-property="can_view" data-checked="{{ $perm['can_view'] }}" type="checkbox" name="can_view" @if($perm['can_view']) checked="" @endif onclick="doCheckBox(this)" > </td>

			<td> <input class="fluency" data-type="{{ $perm['id'] }}" data-id="{{ $perm['id'] }}" data-property="can_edit" data-checked="{{ $perm['can_edit'] }}" type="checkbox" name="can_edit" @if($perm['can_edit']) checked="" @endif onclick="doCheckBox(this)" > </td>

		</tr>
		@endforeach
		</form>
	</tbody>
</table>