<div class="list-group list-group-flush account-settings-links">
    {{-- <a class="list-group-item list-group-item-action" href="{{route('project.settings', $id)}}">General Settings</a> --}}
     <a class="list-group-item list-group-item-action {{ (request()->segment(3) == 'settings') ? 'active' : '' }}" href="{{route('project.settings', $id)}}">General Settings</a>
    <a class="list-group-item list-group-item-action {{ (request()->segment(3) == 'member') ? 'active' : '' }} " href="{{route('project.member', $id)}}">Members</a>

    <a class="list-group-item list-group-item-action {{ (request()->segment(3) == 'issuetype') ? 'active' : '' }}" href="{{route('issuetype.index', $id)}}">Issue Type</a>
  <!--   <a class="list-group-item list-group-item-action {{ (request()->segment(3) == 'category') ? 'active' : '' }}" href="{{route('category', $id)}}">Cetegory</a> -->
    <a class="list-group-item list-group-item-action {{ (request()->segment(3) == 'version') ? 'active' : '' }}"  href="{{route('version', $id)}}">Version</a>
   <!--  <a class="list-group-item list-group-item-action {{ (request()->segment(3) == 'priority') ? 'active' : '' }}"  href="{{route('priority', $id)}}">Priority</a> -->
<!--     <a class="list-group-item list-group-item-action {{ (request()->segment(3) == 'status') ? 'active' : '' }}"  href="{{route('status.index', $id)}}">Status</a> -->
    <a class="list-group-item list-group-item-action {{ (request()->segment(3) == 'checklist') ? 'active' : '' }}"  href="{{route('checklist.index', $id)}}">Checklist</a>    

   {{--  <a class="list-group-item list-group-item-action {{ (request()->segment(3) == 'checkdetail') ? 'active' : '' }}"  href="checklist"></a> --}}
  </div>


 