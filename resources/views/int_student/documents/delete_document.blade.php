{{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'delete-document',
'method' => 'post', 'enctype' => 'multipart/form-data']) }}
<input type="hidden" name="delete_document_for"  value="{{$document_for}}">
<input type="hidden" name="delete_document_id" value="{{$id}}">
<a><button type="submit" class="btn btn-primary pull-right mr-2 ml-2 document_delete">OK</button></a>
<button type="button" class="btn btn-secondary btn-default pull-right ml-2" data-dismiss="modal">Cancel</button>
{{ Form::close()}}