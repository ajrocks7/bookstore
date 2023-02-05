<?php
//echo"<pre>";
//print_r($data[0]['_source']);
//exit();
?>
@extends('layouts.app')

@section('content')
<div class="container">
  <h2>Books Details</h2>
  <a href="{{ url('Admin/addproductsbyapi') }}"><button class="btn btn-danger">Bulk Create</button></a>
  <!-- <a href="{{ url('Admin/deleteindex') }}"><button class="btn btn-primary">Delete All</button></a>     -->
  <div class="col-md-12 flexrightstyle">
    <div class="row">
    
    <a href="{{ route('addproducts') }}"><button class="btn btn-success">Add New</button></a>
    </div>
  
  </div>           
  <table class="table myTable">
  <thead>
												<tr>
													<th>Sno</th>
                                                    <th>Title</th>
                                                    <th>Author</th>
													<th>Genre</th>
													<th>Description</th>
													<th>Isbn</th>
                                                    <th>Image</th>
                                                    <th>Published Date</th>
                                                    <th>Publisher</th>
													<th>Actions</th>
												</tr>
											</thead>
                                            <tbody>
                                            <?php 
                                                if(count($data) >0 ) {
                                                    $i=1;
                                                    foreach($data as $key => $details) {
                                                        $description = substr($details['_source']['description'], 0, 40);
                                                    ?>
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $details['_source']['title'] }}</td> 
                                                    <td>{{ $details['_source']['author'] }}</td> 
                                                    <td>{{ $details['_source']['genre'] }}</td>
                                                    <td>{{ $description }} {{ '......' }}</td>
                                                    <td>{{ $details['_source']['isbn'] }}</td>
                                                    <td><img src="{{  $details['_source']['image']  }}" loading="lazy" width="70" height="100" class="img-fluid"></td>
                                                    <td>{{ $details['_source']['published'] }}</td>
                                                    <td>{{ $details['_source']['publisher'] }}</td>
                                                      
                                                   
                                <td>
                                                   
                                                    <a href="{{ url('Admin/editproduct/'.$details['_id']) }}">
                                                    <i class="fa fa-edit" style="color:#3699ff" aria-hidden="true"></i>
                                                </a>/
                                              
                                                <a href="javascript:void(0)" onclick="push_delete(<?php echo $details['_id'];?>)">
                                                    <i class="fa fa-trash" style="color:red" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                                </tr>
                                                <?php $i++;} }else { ?>
                                                   
                                                <?php } ?>

											</tbody>
  </table>
</div>
@endsection
