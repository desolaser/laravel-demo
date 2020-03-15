<style>
	table {
		font-size: 12px;
	}
</style>
@extends('admin.layout')

@section('content')
	<div class="box">
        <div class="box-body">
            <table id="tablas" class="table table-bordered table-striped">
                <thead>
			        <tr>
			        @foreach($th as $items)
			        		<th>{{ $items }}</th>
			        @endforeach
			    	</tr>
                </thead>
                
                <tbody>
                	@foreach($data as $fila)
			        <tr>
			        	@foreach($fila as $key => $col)
							@php
								$id_producto = $fila[5]; 
							@endphp
							@if($key != 5)
								<td>
									@if($key == 3)
										<a href="{{ url('/precios/editBasePrice', $id_producto) }}" >{{ $col }}</a>
									@elseif($key < 5)
										{{ $col }}
									@else
										@php
											$a = explode(";", $col);
											$precio = $a[0];
											$id = $a[1];
										@endphp
										<a href="{{ route('precios.edit', $id) }}" >{{ $precio }}</a>
									@endif
								</td>
							@endif
			        	@endforeach
			        </tr>
			        @endforeach

                </tbody>
                
                <tfoot>
	                <tr>
				     	@foreach($th as $items)
			        		<th>{{ $items }}</th>
			        	@endforeach
	                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@stop

<div class="modal fade" id="modal-default">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Default Modal</h4>
			</div>
			<div class="modal-body">
					
				@include('shared._errors')
				
				<form class="form-horizontal">
					@csrf
	                @method('PUT')
						
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Servicio</label>

						<div class="col-sm-9">
							<input type="text" class="form-control" id="" value="{{-- $data->servicio->nombre --}}" readonly>
						</div>
					</div>

					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Categoria</label>

						<div class="col-sm-9">
							<input type="text" class="form-control" id="" value="{{-- $data->producto->categoria->nombre --}}" readonly>
						</div>
					</div>

					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Producto</label>

						<div class="col-sm-9">
							<textarea class="form-control" rows="4" placeholder="" disabled>{{-- $data->producto->nombre --}}</textarea>
						</div>
					</div>

					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Precio Base</label>

						<div class="col-sm-9">
							<input type="text" class="form-control" id="" value="{{-- $data->producto->precio --}}" readonly>
						</div>
					</div>

					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Unidad</label>

						<div class="col-sm-9">
							<input type="text" class="form-control" id="" value="{{-- $data->producto->unidad --}}" readonly>
						</div>
					</div>


					<div class="form-group">
						<label for="precio" class="col-sm-3 control-label">Precio</label>

						<div class="col-sm-9">
							<input type="text" class="form-control" id="precio" value="{{-- old('precio', $data->precio) --}}">
						</div>
					</div>
				</form>

			</div>
			<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Actualizar</button>
			</div>
		</div>
			<!-- /.modal-content -->
	</div>
		<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

