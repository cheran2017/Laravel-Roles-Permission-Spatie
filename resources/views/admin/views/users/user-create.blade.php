<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Users Create </title>
  @include('admin.config.app-css')
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('admin.config.header')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      @include('admin.config.sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-home"></i>                 
              </span>
              Users
            </h3>
            <nav aria-label="breadcrumb">
              <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                  <span></span>Users Create
                  <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
              </ul>
            </nav>
          </div>
          @include('admin.config.flash')
          <div class="row">
            <div class="col-lg-12 stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Users</h4>
                  <p class="card-description">
                    User Create
                  </p>
                  <form class="forms-sample" action="{{url('users')}}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputName1">Name</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="name" placeholder="Name" value="{{old('name')}}">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Email</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="email" placeholder="Email" value="{{old('email')}}">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Password</label>
                      <input type="password" class="form-control" id="exampleInputName1" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Confirm Password</label>
                      <input type="password" class="form-control" id="exampleInputName1" name="password_confirmation" placeholder="Confirmpassword">
                    </div>
                    <div class="form-group">
                      <label class="">Roles</label>
                        <select class="form-control" name="role_id">
                          <option value="">SELECT ROLE</option>
                          @if(count($data['roles']) >0)
                            @foreach($data['roles'] as $role)
                              <option value="{{$role->id}}" style="font-size: 23px;">{{$role->name}}</option>
                            @endforeach
                          @endif
                        </select>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                    <a href="{{url('roles')}}"  class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
          </div>          
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('admin.config.footer')
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  @include('admin.config.app-script')

</body>

</html>

