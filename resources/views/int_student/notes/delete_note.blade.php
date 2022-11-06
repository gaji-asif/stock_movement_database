{{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'delete-note/',
'method' => 'DELETE', 'enctype' => 'multipart/form-data']) }}
<input type="hidden" name="student_note_id" value="{{$id}}">
<a><button type="submit" class="btn btn-primary pull-right mr-2 ml-2 note_delete">OK</button></a>
<button type="button" class="btn btn-secondary btn-default pull-right ml-2" data-dismiss="modal">Cancel</button>
{{ Form::close()}}