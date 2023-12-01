<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Edit Strand information</h4>
              </div>
              <div class="card-body">
                {{ Form::model($strand,['method'=>'PATCH','route' => ['strands.update', $strand->_id, 'files' => true]]) }}
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label for="name" class="control-label">name</label>
                            {{ Form::text('name',null,array('class'=>'form-control','id'=>'name')) }}
                      </div>
                    </div>

                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label for="description" class="control-label">Descrition</label>
                         {{ Form::text('description',null,array('class'=>'form-control','id'=>'description')) }}
                      </div>
                    </div>


                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                      	<button type="submit" class="btn btn-primary">Save</button>
  						          <a href="{{url()->previous()}}" class="btn btn-default" role="button">Cancel</a>
                    </div>     
                    </div>

              </div>
              {!! Form::close() !!}   
            </div>
          </div>
        </div>
      </div>
          
      </body>
</html>