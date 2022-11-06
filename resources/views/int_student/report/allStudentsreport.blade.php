@php
$int_status_1 = '<button class="btn btn-warning btn-sm ">Pending</button>';
$int_status_2 = '<button class="btn btn-info btn-sm ">Submitted</button>';
$int_status_3 = '<button class="btn btn-success btn-sm ">Offer Issued</button>';
$int_status_4 = '<button class="btn btn-primary btn-sm ">Visa Received</button>';
@endphp

@if(!empty($IntStudents) && sizeof($IntStudents)!=0)


    @foreach($IntStudents as $IntStudent)
    <tr class="odd" role="row">
       
        <td class="sorting_1">{{$IntStudent->id}}</td> 
        <td class="sorting_1">{{$IntStudent->field_5}}</td>
        <td class="sorting_1">{{$IntStudent->country}}</td>
        <td class="sorting_1">{{$IntStudent->created_at}}</td> 
         <td class="sorting_1">@isset($IntStudent->course_title){{$IntStudent->course_title}}@endisset</td> 
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
        <td class="sorting_1">{{$IntStudent->university}}</td> 
         <td class="sorting_1">{{$IntStudent->month}}</td> 
         <td class="sorting_1">@isset($IntStudent->admission_date){{$IntStudent->admission_date}}@endisset</td> 
    </tr>
    @endforeach
@else
<tr>

    <td colspan="8" class="text-center text-danger">No Data Found</td>
</tr>
@endif
