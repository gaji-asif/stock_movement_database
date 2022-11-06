@php
$int_status_1 = '<button class="btn btn-warning btn-sm ">Pending</button>';
$int_status_2 = '<button class="btn btn-info btn-sm ">Submitted</button>';
$int_status_3 = '<button class="btn btn-success btn-sm ">Offer Issued</button>';
$int_status_4 = '<button class="btn btn-primary btn-sm ">Visa Received</button>';
@endphp

@if(!empty($IntStudents) && sizeof($IntStudents)!=0)

    @foreach($IntStudents as $IntStudent)
    <tr class="odd" role="row">
        <td class="sorting_1">{{$IntStudent->field_5}}</td>
        <td class="sorting_1">{{$IntStudent->email}}</td>
        <td class="sorting_1">{{$IntStudent->passport_num}}</td>
        <td class="sorting_1">{{$IntStudent->field_2}}</td>
        <td class="sorting_1">{{$IntStudent->phone}}</td>
        <td class="sorting_1">{{$IntStudent->country}}</td>

        @if ( Session::get('role') == '0' && request()->is('int_student') )
        <td class="sorting_1">
            @php $administrator_id =
            \App\DtbUser::select('name')->where('id',$IntStudent->administrator_id)->pluck('name')->first();@endphp
            {{ $administrator_id }}
        </td>
        <td class="sorting_1">
            @php $agent_id = \App\DtbUser::select('name')->where('id',$IntStudent->agent_id)->pluck('name')->first();@endphp
            {{ $agent_id }} </td>
        @endif
        <td class="sorting_1 text-center">
            @if ($IntStudent->status == "1")
            {!! $int_status_1 !!}
            @elseif($IntStudent->status == "2")
            {!! $int_status_2 !!}
            @elseif($IntStudent->status == "3")
            {!! $int_status_3 !!}
            @elseif($IntStudent->status == "4")
            {!! $int_status_4 !!}
            @endif
        </td>
        
        <td class="text-center text-nowrap" style="color: #4E5155;">
          
            <a class="action_icon_color btn btn-sm btn-primary" href="{{route('int_student.show', $IntStudent->id)}}"><span
                   style="color: white" class="glyphicon glyphicon-eye-open "></span></a>&nbsp;&nbsp;

            <a class="action_icon_color btn btn-sm btn-success" href="{{route('int_student.edit', $IntStudent->id)}}"><span
                style="color: white" class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;

                    @if ( request()->is('int_student/*') && Session::get('role') == '0' )
            <a href="{{url('delete_int_student/'.$IntStudent->id)}}" class="modalLink action_icon_color btn btn-sm btn-danger"
                data-modal-size="modal-md"><span  style="color: white" class="glyphicon glyphicon-trash"></span></a>

            @elseif (request()->is('assign/*'))
            <a href="{{url('delete_assign_student/'.$IntStudent->id)}}" class="modalLink action_icon_color btn btn-sm btn-danger"
                data-modal-size="modal-md"><span  style="color: white" class="glyphicon glyphicon-trash"></span></a>
            @endif

        </td>
        

    </tr>
    @endforeach
@else
<tr>

    <td colspan="8" class="text-center text-danger">No Data Found</td>
</tr>
@endif
