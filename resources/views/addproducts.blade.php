@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card cardbox">
			<div class="row">
				<div class="col-md-9">
					<form role="form" id="form-element" method="post" enctype="multipart/form-data" action="{{ url('Admin/saveproduct') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="<?php echo(!empty($data['_id']) && $data['_id']!='')?$data['_id']:''; ?>">
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<label class="control-label cardlabel">Title <span style="color:red;font-size: 12pt;">*</span></label>
									<input type="text" class="form-control" id="title" name="title" value="<?php echo(!empty($data['_source']) && $data['_source']['title']!='')?$data['_source']['title']:''; ?>"> 
						        </div>
						        <div class="col-md-6">
									<label class="control-label cardlabel">Author <span style="color:red;font-size: 12pt;">*</span></label>
									<input type="text" class="form-control" id="author" name="author" value="<?php echo(!empty($data['_source']) && $data['_source']['author']!='')?$data['_source']['author']:''; ?>"> 
						        </div>
					       </div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<label class="control-label cardlabel">Genre <span style="color:red;font-size: 12pt;">*</span></label>
									<input type="text" class="form-control" id="genre" name="genre" value="<?php echo(!empty($data['_source']) && $data['_source']['genre']!='')?$data['_source']['genre']:''; ?>"> 
						        </div>
						        <div class="col-md-6">
									<label class="control-label cardlabel">Description <span style="color:red;font-size: 12pt;">*</span></label>
									<textarea class="form-control" rows="5" id="description" name="description"><?php echo(!empty($data['_source']) && $data['_source']['description']!='')?$data['_source']['description']:''; ?></textarea>
						        </div>
					       </div>
						</div>


                        <div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<label class="control-label cardlabel">Isbn <span style="color:red;font-size: 12pt;">*</span></label>
									<input type="text" class="form-control" id="isbn" name="isbn" value="<?php echo(!empty($data['_source']) && $data['_source']['isbn']!='')?$data['_source']['isbn']:''; ?>"> 
						        </div>
						        <div class="col-md-6">
									<label class="control-label cardlabel">Image </label>
									<input type="file" class="form-control" name="bookimage" id="bookimage"  onchange="showimage()">
                                    <input type="hidden" name="existimage" value="<?php echo(!empty($data) && $data['_source']['image']!='')?$data['_source']['image']:''; ?>">
                                    <?php if(isset($data['_source']['image'])){ ?> 
                                                      
                                                      <img id="editoutputimg" style="margin-top: 15px;" src="<?php 
                                                         echo(!empty($data['_source']) && $data['_source']['image']!='')?$data['_source']['image']:''; ?>" width="100" height="100">
                                                      <?php } ?>
                                    <img id="outputimg" style="margin-top: 15px;" src="" width="100" height="100">  
                                </div>
					       </div>
						</div>

                        <div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<label class="control-label cardlabel">Published Date <span style="color:red;font-size: 12pt;">*</span></label>
									<input type="text" class="form-control datepicker" name="publisheddate" id="publisheddate" value="<?php echo(!empty($data['_source']) && $data['_source']['published']!='')?date('Y-m-d',strtotime($data['_source']['published'])):''; ?>"> 
						        </div>
						        <div class="col-md-6">
									<label class="control-label cardlabel">Publisher <span style="color:red;font-size: 12pt;">*</span></label>
									<input type="text" class="form-control" id="publisher" name="publisher" value="<?php echo(!empty($data['_source']) && $data['_source']['publisher']!='')?$data['_source']['publisher']:''; ?>"> 
                                </div>
					       </div>
						</div>
								
					 
					 <div class="form-group finalbtn">
						 <div class="row">
                         <div class="col-lg-6 text-right mt-2 finalrow">
                                                            <button type="submit" class="btn btn-primary savebtn"><?php echo(!empty($data['_id']) && $data['_id']!='')?'Update':'Save'; ?></button>
															<button type="button" onclick="window.history.back()" class="btn btn-secondary">Back</button>
															
														</div>
						 </div>
					 </div>
				</form>


				</div>
				
			</div>
            </div>			
		</div>
@endsection

