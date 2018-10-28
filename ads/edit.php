{!! $styles; !!}
{!! $scripts; !!}

<div class="container">
<h2>Update Ads {{ isset($single['title']) ? $single['title'] : '' }}</h2>
    <form class="form-horizontal" method="POST" id="form" enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Title:</label>
            <div class="col-sm-10">
            	<input type="text" class="form-control" id="title" name="title" required data-rule-minlength="2" value="{{ ($single['title']) ? $single['title'] : '' }}">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Status:</label>
			<?php $select = $single['status']; ?>
            <div class="col-sm-10">
				<select name="status" class="form-control">
				<option value="">-Choose Status-</option>
				<option value="active" {{ ($select == "active") ? "selected" : "" }} >Active</option>
				<option value="nonactive" {{ ($select == "nonactive") ? "selected" : "" }} >Non-Active</option>
				</select>
			</div>
		</div>
		<div class="form-group" id="place_image">
            <label class="control-label col-sm-2" for="email">Image:</label>
				@if ($single['image'] == "") 
				<script>
					$('#place_image').hide();
						$('#btn_choose_image').html('Update Image');
					</script>
	            @else
            	<script>
                	$('#place_image').show();
						$('#btn_choose_image').html('Update Image');
                 </script>

                @endif
            <div class="col-sm-10">
              <img src="{{ base_url(isset($single['image']) ? $single['image'] : '') }} " id="image_category" style="width: 120px; height:120px;" name="">
            </div>
            <div class="col-sm-12 col-sm-offset-2">
            	<a class="btn btn-primary" id="btn_choose_image" onclick="$('#choose_image').click();">Choose Image</a>
			    <input style="display: none;" type="file" id="choose_image" name="image"></input>
            </div>
         </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
				<button type="reset" class="btn ink-reaction btn-flat btn-primary active reset">RESET</button>
				<button type="submit" class="btn ink-reaction btn-raised btn-primary submit">SUBMIT</button>
            </div>
        </div>
    </form>
</div>



<script type="text/javascript">
	$(document).ready(function(){
		
		
		$(document).on('click', '.reset', function(){
		    $('.error_dup').hide();
		    $('.error_pass').hide();
		    $('.error_dup').html('');
			$('.error_pass').html('');
			$('#form').find('.submit').attr('disabled', false);
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
		
	})	
</script>