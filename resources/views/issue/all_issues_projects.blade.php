 @php $sl = 1; @endphp
        @if(isset($issueslist))
        @foreach($issueslist as $issues)

      <tr role="row" class="odd">
            <td class="">
              <span style="margin-right: 7px;">
                <input type="checkbox" class="checkbox" name="issue_id[]" value="{{$issues->id}}" style=" height: 17px; width: 17px; margin-top: 10px; padding-top: 10px !important;">
              </span>
              <span>{{$issues->id}}</span>
            </td>
            <!-- <td><a href="{{url('issue/'.$issues->id.'/list')}}">{{$issues->issue_title}}</a></td> -->
            <td><a href="{{url('issue/'.$issues->id)}}">{{$issues->issue_title}}</a></td>
            <?php Session::put('div', 'list');?>
            <td class="text-center">{{$issues->app_name}}</td>
            <td class="text-center">{{$issues->category_name}}</td>
            <td class="text-center">{{$issues->version_name}}</td>
            <td class="text-center">{{$issues->assignee}}
             <span style="font-size: 10px">@if ($issues->is_archived == 1) (archived) @endif</span></td>
            <td>
            @if(isset($issues->status))
            
            <div class="btn badge badge-success float-right mr-0 dtb_custom_badge" style="background: {{ $issues->color ?? '' }};width: 72px">{{$issues->status_name ?? '' }}</div>
            
            @endif
            </td>
            <td>
            @if(isset($issues->issue_priority_id))
            <div class="btn badge badge-success float-right mr-0 dtb_custom_badge" style="background: {{ $issues->priorcolor ?? '' }};width: 72px">{{$issues->priority_name}}</div>
            @endif

      </td>

		
   {{-- <td>{{ date('d-M-Y', strtotime($issues->updated_at)) }}</td> --}}
   <td><?php 
   if (isset($devgrplang)) {
      if ($devgrplang->default_lang == 1) { ?>
      {{ date('m-d-Y  h:i a', strtotime($issues->updated_at)) }}
       <?php }elseif($devgrplang->default_lang == 15){ ?>
      {{ date('m-d-Y  h:i a', strtotime($issues->updated_at)) }}
        <?php }elseif($devgrplang->default_lang == 53){?>
      {{ date('Y-m-d  h:i a', strtotime($issues->updated_at)) }}
        <?php }else{ ?>
      {{ date('m-d-Y  h:i a', strtotime($issues->updated_at)) }}
       <?php }

      }else{}
      ?>
        
      </td>

</tr>

@endforeach
@endif