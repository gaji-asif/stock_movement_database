      @php $sl = 1; @endphp
        @if(isset($issueslist))
        @foreach($issueslist as $issues)

        <tr role="row" class="odd">
          <td class="">
            <span style="margin-right: 7px;">
             {{--  <input type="checkbox" class="checkbox" name="issue_id[]" value="{{$issues->id}}" style=" height: 17px; width: 17px; margin-top: 10px; padding-top: 10px !important;"> --}}
            </span>
            <span>{{$issues->id}}</span>
          </td>
          <td>{{$issues->app_name}}
          </td>
          <!-- <td><a href="{{url('issue/'.$issues->id.'/myIssue')}}">{{$issues->issue_title}}</a></td> -->
          <td><a href="{{url('issue/'.$issues->id)}}">{{$issues->issue_title}}</a></td>
          <?php Session::put('div', 'myIssue');?>
          <td>{{$issues->project_name}}
          </td>
          
          <td>{{$issues->category_name}}
        </td>
        <td>
          @if(!empty($issues->userimg))
              @php $image_path = url($issues->userimg); @endphp
              <img src="//{{ $issues->userimg }}" alt="" align="left" class="d-block ui-w-30 rounded-circle">
              @else
              <img src="{{asset('assets_/img/user_avatar.png')}}" alt="" align="left" class="d-block ui-w-30 rounded-circle">
          @endif
          <span style="margin-top: 11px;float: left;margin-left: 4px;">{{$issues->assignee}} 
            @if ($issues->is_archived == 1) <span style="font-size: 10px">(archived)</span> @endif
          </span>
        </td>

      <td style="text-align: center;">
       @if(isset($issues->status))

       <div class="btn badge badge-success dtb_custom_badge" style="background:{{$issues->statscolor ?? '#718AA8'}}">{{$issues->status_name}}</div>

       @endif
     </td>

     <td style="text-align: center;">
       <div class="ticket-priority btn-group">
       <!--  <button type="button" class="btn btn-xs md-btn-flat  btn-success dtb_custom_badge" data-toggle="dropdown">{{($issues->progress>0) ? $issues->progress.'%' : 'not set'}}</button> -->

        <div class="btn badge badge-success dtb_custom_badge dtb_secondary_bgcolor">{{($issues->progress>0) ? $issues->progress.'%' : 'not set'}}</div>

      </div>
    </td>  

    <td>

     @if(isset($issues->issue_priority_id))
     <div class="btn badge float-right mr-3">{{$issues->priority_name}}</div>

     @endif
   </td>


  <td>

    @if(Session()->get('language_id') == 1)
    {{ date('m-d-Y  h:i a', strtotime($issues->updated_at)) }}
    @elseif(Session()->get('language_id') == 15)
    {{ date('m-d-Y  h:i a', strtotime($issues->updated_at)) }}
    @elseif(Session()->get('language_id') == 53)
    {{ date('Y-m-d  h:i a', strtotime($issues->updated_at)) }}

    @else

    @endif
    </td>
  <td>  @if(!empty($issues->deadline))
    @if(Session()->get('language_id') == 1)
    {{ date('m-d-Y', strtotime($issues->deadline)) }}
    @elseif(Session()->get('language_id') == 15)
    {{ date('m-d-Y', strtotime($issues->deadline)) }}
    @elseif(Session()->get('language_id') == 53)
    {{ date('Y-m-d', strtotime($issues->deadline)) }}

    @else

    @endif
    
  @endif</td>
<!--   <td style="padding: 5px">

    <a href="{{url('issue/'.$issues->id.'/myIssue')}}"><div class="btn badge badge-primary">view Details</div></a> -->


    <!-- <a href="issue/{{ $issues->id }}/edit" class="btn btn-default btn-xs icon-btn md-btn-flat product-tooltip" title="" data-original-title="Edit"><i class="ion ion-md-create"></i></a> -->

<!--     <a href="{{url('editIssue/'.$issues->id)}}" class="btn btn-warning btn-xs icon-btn md-btn-flat product-tooltip" title="" data-original-title="Edit"><i class="ion ion-md-create"></i></a> -->

<!-- </tr> -->

@endforeach
@endif