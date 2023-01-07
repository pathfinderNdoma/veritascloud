<!-- Button trigger modal -->

  
  <!-- Modal -->
  <div class="modal fade text-center" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header btn btn-success">
          <h5 class="modal-title" id="staticBackdropLabel">Delete Device</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete the device?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
          {!! Form::open(['route'=>['delete', 'id'=>$device->deviceID],    'method' => 'POST', 'class'=>'pulll-right'])!!}
				@csrf
				{{Form::hidden('_method', 'DELETE')}}
				
				{{Form::submit('Delete', ['class'=>'btn btn-danger form-control'])}}
			  {!! Form::close()!!}
        </div>
      </div>
    </div>
  </div>