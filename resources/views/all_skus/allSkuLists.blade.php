@if(!empty($data))
@foreach($data as $value)
<tr class="odd" role="row">
	<td class="sorting_1"><strong>AAA{{$value->id}}</strong></td>
	<td>{{$value->sku_model_no}}</td>
	<td>{{$value->sku_title}}</td>
	<td class="text-center text-nowrap" style="color: #4E5155;">
		<!-- <a class="action_icon_color btn btn-sm btn-primary" href=""><span style="color: white" class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp; -->

		<a href="{{url('delete_sku/'.$value->id)}}" class="modalLink action_icon_color btn btn-sm btn-danger" data-modal-size="modal-md"><span style="color: white" class="glyphicon glyphicon-trash"></span></a>
		
	</td>
</tr>
@endforeach
@else
<tr>
	<td colspan="7" class="text-center text-danger">No Data Found</td>
</tr>
@endif
