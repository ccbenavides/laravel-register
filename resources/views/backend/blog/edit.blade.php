@extends('backend.layouts.main')
@section('title',$title)

@section('content')

<div class="cell colspan10 padding30 bg-white top80" id="cell-content">
                	<h1 class="text-light">
					<a href="{{ URL::previous() }}"><span class="mif-arrow-left"></span> </a>
                	{{ $sub }}</h1>
                	<hr class="thin bg-grayLighter">
                	<button class="button primary"><span class="mif-plus"></span> Create...</button>
                	<hr class="thin bg-grayLighter">

<table class="table striped hovered">
	<thead>
		<tr>
			<th>id</th>
			<th>Nombre</th>
			<th class="text-right">Acciones</th>
		</tr>
	</thead>
	<tbody>
		
	</tbody>
</table>



</div>
@endsection