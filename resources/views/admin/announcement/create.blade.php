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
                <h4 class="card-title">Create Announcement</h4>
              </div>
            
              <form action="/announcements" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6 pr-1">
                        <label for="announcement" class="control-label">Announcement:</label>
                        <div class="form-group">
                            <textarea type="text" class="form-control" placeholder="announcement" id="announcement" name="announcement" value="{{old('announcement')}}">
                            </textarea>
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