{!! $styles !!} 
{!! $scripts !!}

<div class="container">
			<h2 class="text-primary">Listing data Ads</h2>
			<div class="row">
				<div class="col-md-8">
						<p class="lead">
							Listing data Ads
						</p>
				</div>
			</div>
			<div class="row">
				 @if(isset($message)): 
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						{{ $message }}
					</div>
				 @endif
				@if(isset($success_message))
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						{{  $success_message }}
					</div>
				@endif
				<div class="col-lg-12">
           <a class="btn btn-warning" href="{{ base_url().'ads/add' }}" data-toggle="tooltip" data-placement="top" data-original-title="Add Ads">
            <i class="fa fa-add">ADD</i>
          </a>
					<div class="table-responsive">
						<table id="datatable1" class="table table-striped table-hover">
							<thead>
								<tr>
									<th class="sort-numeric">No</th>
									<th>Title</th>
									<th>Image</th>
									<th>Status</th>
									<th>Created at</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
									 @foreach($ads as $no => $admin)
								<tr>
									<td>{{ $no+1 }}</td>
									<td>{{ $admin->title }}</td>
									<td>
                  {!! (!empty($admin->image)) ? "<img src='".base_url($admin->image)."' style = 'width:120px; height:120px;' >" : "<img src='".base_url('assets/frontend/images/watermark2.png')."' style = ' width:120px; height:120px;' />" 
                  !!}
                 </td>
									<td>{{ $admin->status }}</td>
									<td>{{ $admin->created_at }}</td>
									<td>
										<a href="{{ 'edit/'.$admin->id }}" class="btn ink-reaction btn-flat btn-primary active" data-toggle="tooltip" data-placement="top" data-original-title="Edit {{$admin->title }}">
                      <i class="fa fa-pencil"></i>
                    </a>
                    <a href="{{ base_url().'ads/delete/'.$admin->id }}" class="btn ink-reaction btn-primary delete" data-toggle="tooltip" data-placement="top" data-original-title="Delete {{ $admin->title }}">
                      <i class="fa fa-trash"></i>
                    </a>
									</td>
								</tr>

                @endforeach;
							</tbody>
						</table>
					</div><!--end .table-responsive -->
				</div>
			</div>
		 
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click', '.delete', function(){

			var del_url =  $(this).attr('href');

			bootbox.confirm("<h4>Anda yakin ingin menghapus ?</h4>", function (result) {
		        if (result) {
		           location.href = del_url;
		        }
	    	});
	   	 	return false;
		})
	})
</script>


 <script type="text/javascript">
    var save_method;
    save_method = 'add';
    var table;
    $(document).ready(function() {
      table = 
          $('#table').DataTable({ 
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{  $datatables_url.'/ajax_list' }}",
                "type": "POST"
            },
            "columnDefs": [{ 
              "targets": [ -1 ], //last column
              "orderable": false, //set not orderable
            }],
          });

    });


     $(document).on('change','#choose_image',function(){
        var el = $("#image_category");
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return;
            if (/^image/.test( files[0].type)){ 
                var reader = new FileReader(); 
                reader.readAsDataURL(files[0]);
                reader.onloadend = function(){ 
                    el.attr("src",this.result);
                    $('#place_image').show();
                }
            }
    });



  </script>