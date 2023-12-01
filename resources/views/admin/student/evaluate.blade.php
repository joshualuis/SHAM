@extends('layouts.master')

@section('title')
  STUDENTS
@endsection

@section('pagetitle')
   STUDENTS 
@endsection

@section('css')
@endsection

@section('content')

                <div class="container-fluid">
	                <div class="row">
	                    <div class="col-md-12">
                        <a href="javascript:history.back()">
                          <button type="button" class="btn btn-wd btn-default btn-fill btn-move-left">
	                        <span class="btn-label"><i class="ti-angle-left" style="margin-right:5px;"></i></span>BACK
	                        </button>
                        </a><br><br>
	                        <div class="card">
								<form action="/admin/students/transferee/create" method="POST">
									<div class="card-header">
										<h4 class="card-title">Checklist:
										<p class="category">Please put a checkmark on the subjects that are already taken by the student.</p>
											
											<input type="hidden" name="section_id" value="{{$section->id}}">
										</h4>
									</div>

									<div class="row">
										<div class="col-lg-4 col-md-5">

											<div class="card-content">
												<h4 class="card-title">Core Subjects:</h4>
												@foreach ($core as $item)
													<label>
														<input type="checkbox" name="items[]" value="{{ $item->id }}"> {{ $item->name }} 
													</label>
													<br>
												@endforeach

											</div>

										</div>

										<div class="col-lg-4 col-md-5">

											<div class="card-content">

												<h4 class="card-title">Applied Subjects:</h4>
												@foreach ($applied as $item)
													<label>
														<input type="checkbox" name="items[]" value="{{ $item->id }}"> {{ $item->name }}
													</label>
													<br>
												@endforeach

											</div>

										</div>

										<div class="col-lg-4 col-md-5">

											<div class="card-content">
												<h4 class="card-title">Specialized Subjects:</h4>
												@foreach ($specialized as $item)
													<label>
														<input type="checkbox" name="items[]" value="{{ $item->id }}"> {{ $item->name }}
													</label>
													<br>
												@endforeach
											</div>

										</div>
									</div>

									<div class="row"><br>
										<div class="col-sm-12" >
											<div class="form-group pull-right">
												<button type="submit" class="btn btn-default btn-wd btn-move-right" style="margin-right:20px;">Proceed
													<span class="btn-label"><i class="ti-angle-right"></i></span>
												</button>
											</div>
										</div> 
									</div>
									<br>
								</form>  
	                        </div>
	                    </div>
                  </div>
	              </div>
 
@endsection

