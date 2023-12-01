@extends('layouts.master')

@section('title')
    STRANDS
@endsection

@section('pagetitle')
   STRANDS
@endsection

@section('css')
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@if(session('error'))
    <script>
        alert('{{ session('error') }}');
    </script>
@endif
@section('content')
<div class="container-fluid">
	                <div class="row">
<!-- abm -->
<div class="col-md-12">
	<div class="card">
		  <div class="card-content">
		    <h4 class="card-title">ACCOUNTANCY, BUSINESS AND MANAGEMENT STRAND</h4>
        <div class="card-content table-responsive table-full-width">
	        <table class="table table-striped">
            <thead>
              <th>Grade</th>
              <th>Section</th>
              <th>Room</th>
              <th>Adviser</th>
              <th class="text-center">Action</th>
            </thead>
            <tbody>
              @foreach($abms as $abm)
                <tr>
                  <td class="text-left">{{$abm -> glevel}}</td>
                  <td>{{$abm -> name}}</td>
                  <td class="text-left">{{$abm -> room}}</td>
              @if(empty($abm->teacher))
                  <td class="text-left">TBD</td>
              @else
                  <td class="text-left">{{$abm -> teacher->fullname}}</td>
              @endif
                  <td class="text-center">
                    <a href="/admin/students/{{$abm->_id}}">
                      <button class="btn btn-default">
                        View Students
                      </button>
                    </a>

                    <a href="/admin/subject/{{$abm->_id}}/view">
                      <button class="btn btn-primary">
                        View Schedule
                      </button>
                    </a>

                    <a href="/admin/students/listClearance/{{$abm->id}}">
                     <button class="btn btn-warning">
                       Clearance
                      </button>
                    </a>

                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
		  </div>
	</div>
</div>
<!-- end abm -->  

<!-- GAS -->
<div class="col-md-12">
	<div class="card">
		  <div class="card-content">
		    <h4 class="card-title">GENERAL ACADEMIC STRAND</h4>
        <div class="card-content table-responsive table-full-width">
	        <table class="table table-striped">
            <thead>
              <th>Grade</th>
              <th>Section</th>
              <th>Room</th>
              <th>Adviser</th>
              <th class="text-center">Action</th>
            </thead>
            <tbody>
              @foreach($gases as $gas)
                <tr>
                  <td class="text-left">{{$gas -> glevel}}</td>
                  <td>{{$gas -> name}}</td>
                  <td class="text-left">{{$gas -> room}}</td>
              @if(empty($gas->teacher))
                  <td class="text-left">TBD</td>
              @else
                  <td class="text-left">{{$gas -> teacher->fullname}}</td>
              @endif
                  <td class="text-center">
                    <a href="/admin/students/{{$gas->_id}}">
                      <button class="btn btn-default">
                        View Students
                      </button>
                    </a>

                    <a href="/admin/subject/{{$gas->_id}}/view">
                      <button class="btn btn-primary">
                        View Schedule
                      </button>
                    </a>

                    <a href="/admin/students/listClearance/{{$gas->id}}">
                     <button class="btn btn-warning">
                       Clearance
                      </button>
                    </a>

                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
		  </div>
	</div>
</div>
<!-- end gas -->



<!-- humss -->
<div class="col-md-12">
	<div class="card">
		  <div class="card-content">
		    <h4 class="card-title">HUMANITIES AND SOCIAL SCIENCES STRAND</h4>
        <div class="card-content table-responsive table-full-width">
	        <table class="table table-striped">
            <thead>
              <th>Grade</th>
              <th>Section</th>
              <th>Room</th>
              <th>Adviser</th>
              <th class="text-center">Action</th>
            </thead>
            <tbody>
              @foreach($humsses as $humss)
                <tr>
                  <td class="text-left">{{$humss -> glevel}}</td>
                  <td>{{$humss -> name}}</td>
                  <td class="text-left">{{$humss -> room}}</td>
              @if(empty($humss->teacher))
                  <td class="text-left">TBD</td>
              @else
                  <td class="text-left">{{$humss -> teacher->fullname}}</td>
              @endif
                  <td class="text-center">
                    <a href="/admin/students/{{$humss->_id}}">
                      <button class="btn btn-default">
                        View Students
                      </button>
                    </a>

                    <a href="/admin/subject/{{$humss->_id}}/view">
                      <button class="btn btn-primary">
                        View Schedule
                      </button>
                    </a>

                    <a href="/admin/students/listClearance/{{$humss->id}}">
                     <button class="btn btn-warning">
                       Clearance
                      </button>
                    </a>


                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
		  </div>
	</div>
</div>
<!-- end humss -->

<!-- stem -->
<div class="col-md-12">
	<div class="card">
		  <div class="card-content">
		    <h4 class="card-title">SCIENCE, TECHNOLOGY, ENGINEERING AND STEM STRAND</h4>
        <div class="card-content table-responsive table-full-width">
	        <table class="table table-striped">
            <thead>
              <th>Grade</th>
              <th>Section</th>
              <th>Room</th>
              <th>Adviser</th>
              <th class="text-center">Action</th>
            </thead>
            <tbody>
              @foreach($stems as $stem)
                <tr>
                  <td class="text-left">{{$stem -> glevel}}</td>
                  <td>{{$stem -> name}}</td>
                  <td class="text-left">{{$stem -> room}}</td>
              @if(empty($stem->teacher))
                  <td class="text-left">TBD</td>
              @else
                  <td class="text-left">{{$stem -> teacher->fullname}}</td>
              @endif
                  <td class="text-center">
                    <a href="/admin/students/{{$stem->_id}}">
                      <button class="btn btn-default">
                        View Students
                      </button>
                    </a>

                    <a href="/admin/subject/{{$stem->_id}}/view">
                      <button class="btn btn-primary">
                        View Schedule
                      </button>
                    </a>  

                    <a href="/admin/students/listClearance/{{$stem->id}}">
                     <button class="btn btn-warning">
                       Clearance
                      </button>
                    </a>

                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
		  </div>
	</div>
</div>
<!-- end stem -->

<!-- care -->
<div class="col-md-12">
	<div class="card">
		  <div class="card-content">
		    <h4 class="card-title">CAREGIVING STRAND</h4>
        <div class="card-content table-responsive table-full-width">
	        <table class="table table-striped">
            <thead>
              <th>Grade</th>
              <th>Section</th>
              <th>Room</th>
              <th>Adviser</th>
              <th class="text-center">Action</th>
            </thead>
            <tbody>
              @foreach($cares as $care)
                <tr>
                  <td class="text-left">{{$care -> glevel}}</td>
                  <td>{{$care -> name}}</td>
                  <td class="text-left">{{$care -> room}}</td>
              @if(empty($care->teacher))
                  <td class="text-left">TBD</td>
              @else
                  <td class="text-left">{{$care -> teacher->fullname}}</td>
              @endif
                  <td class="text-center">
                    <a href="/admin/students/{{$care->_id}}">
                      <button class="btn btn-default">
                        View Students
                      </button>
                    </a>

                    <a href="/admin/subject/{{$care->_id}}/view">
                      <button class="btn btn-primary">
                        View Schedule
                      </button>
                    </a>

                    <a href="/admin/students/listClearance/{{$care->id}}">
                     <button class="btn btn-warning">
                       Clearance
                      </button>
                    </a>


                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
		  </div>
	</div>
</div>
<!-- end care -->

<!-- eim  -->
<div class="col-md-12">
	<div class="card">
		  <div class="card-content">
		    <h4 class="card-title">ELECTRICAL INSTALLATION AND MAINTENANCE STRAND</h4>
        <div class="card-content table-responsive table-full-width">
	        <table class="table table-striped">
            <thead>
              <th>Grade</th>
              <th>Section</th>
              <th>Room</th>
              <th>Adviser</th>
              <th class="text-center">Action</th>
            </thead>
            <tbody>
              @foreach($eims as $eim)
                <tr>
                  <td class="text-left">{{$eim -> glevel}}</td>
                  <td>{{$eim -> name}}</td>
                  <td class="text-left">{{$eim -> room}}</td>
              @if(empty($eim->teacher))
                  <td class="text-left">TBD</td>
              @else
                  <td class="text-left">{{$eim -> teacher->fullname}}</td>
              @endif
                  <td class="text-center">
                    <a href="/admin/students/{{$eim->_id}}">
                      <button class="btn btn-default">
                        View Students
                      </button>
                    </a>

                    <a href="/admin/subject/{{$eim->_id}}/view">
                      <button class="btn btn-primary">
                        View Schedule
                      </button>
                    </a>

                    <a href="/admin/students/listClearance/{{$eim->id}}">
                     <button class="btn btn-warning">
                       Clearance
                      </button>
                    </a>


                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
		  </div>
	</div>
</div> 
<!-- end eim -->

<!-- he -->
<div class="col-md-12">
	<div class="card">
		  <div class="card-content">
		    <h4 class="card-title">HOME ECONOMICS STRAND</h4>
        <div class="card-content table-responsive table-full-width">
	        <table class="table table-striped">
            <thead>
              <th>Grade</th>
              <th>Section</th>
              <th>Room</th>
              <th>Adviser</th>
              <th class="text-center">Action</th>
            </thead>
            <tbody>
              @foreach($hes as $he)
                <tr>
                  <td class="text-left">{{$he -> glevel}}</td>
                  <td>{{$he -> name}}</td>
                  <td class="text-left">{{$he -> room}}</td>
              @if(empty($he->teacher))
                  <td class="text-left">TBD</td>
              @else
                  <td class="text-left">{{$he -> teacher->fullname}}</td>
              @endif
                  <td class="text-center">
                    <a href="/admin/students/{{$he->_id}}">
                      <button class="btn btn-default">
                        View Students
                      </button>
                    </a>

                    <a href="/admin/subject/{{$he->_id}}/view">
                      <button class="btn btn-primary">
                        View Schedule
                      </button>
                    </a>

                    
                    <a href="/admin/students/listClearance/{{$he->id}}">
                     <button class="btn btn-warning">
                       Clearance
                      </button>
                    </a>

                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
		  </div>
	</div>
</div> 
<!-- end he  -->

<!-- ict  -->
<div class="col-md-12">
	<div class="card">
		  <div class="card-content">
		    <h4 class="card-title">INFORMATION, COMMUNICATIONS & TECHNOLOGY STRAND</h4>
        <div class="card-content table-responsive table-full-width">
	        <table class="table table-striped">
            <thead>
              <th>Grade</th>
              <th>Section</th>
              <th>Room</th>
              <th>Adviser</th>
              <th class="text-center">Action</th>
            </thead>
            <tbody>
              @foreach($icts as $ict)
                <tr>
                  <td class="text-left">{{$ict -> glevel}}</td>
                  <td>{{$ict -> name}}</td>
                  <td class="text-left">{{$ict -> room}}</td>
              @if(empty($ict->teacher))
                  <td class="text-left">TBD</td>
              @else
                  <td class="text-left">{{$ict -> teacher->fullname}}</td>
              @endif
                  <td class="text-center">
                    <a href="/admin/students/{{$ict->_id}}">
                      <button class="btn btn-default">
                        View Students
                      </button>
                    </a>

                    <a href="/admin/subject/{{$ict->_id}}/view">
                      <button class="btn btn-primary">
                        View Schedule
                      </button>
                    </a>

                    <a href="/admin/students/listClearance/{{$ict->id}}">
                     <button class="btn btn-warning">
                       Clearance
                      </button>
                    </a>

                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
		  </div>
	</div>
</div>

</div></div>
<!-- end ict -->

@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
@endsection


