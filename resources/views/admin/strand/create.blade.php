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
                <h4 class="card-title">Add Strand information</h4>
              </div>
            
              <form action="/strands" method="POST">
              <div class="card-body">
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label for="name" class="control-label">name</label>
                        <input type="text" class="form-control" placeholder="name" id="name" name="name" value="{{old('name')}}">
                      </div>
                    </div>

                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label for="description" class="control-label">description</label>
                        <input type="description" class="form-control" placeholder="description" id="description" name="description" value="{{old('description')}}">
                      </div>
                    </div>


                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                      <button type="submit" class="btn btn-primary">Save</button>
                
                      <a href="{{url()->previous()}}" class="btn btn-default" role="button">Cancel</a>
                    </div>     
                    </div>

                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
</body>
</html>