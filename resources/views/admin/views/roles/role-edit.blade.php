<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Roles Edit </title>
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
              Roles
            </h3>
            <nav aria-label="breadcrumb">
              <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                  <span></span>Roles Edit
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
                  <h4 class="card-title">Roles</h4>
                  <p class="card-description">
                    Role Edit
                  </p>
                  <form class="forms-sample" action="{{url('roles')}}/{{$data['role']->id}}" method="POST">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="form-group">
                      <label for="exampleInputName1">Name</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="name" placeholder="Name" value="{{$data['role']->name}}">
                    </div>
                    <div class="form-group">
                      <label class="">Permission Group</label>
                        <select class="form-control" name="permission_groups_ids[]" multiple="multiple">
                          @if(count($data['permission_groups']) >0)
                            @foreach($data['permission_groups'] as $permission_group)
                              <option value="{{$permission_group->id}}" style="font-size: 23px;"
                                 @if(in_array($permission_group->id,$data['permission_group_ids']))
                                    selected="selected"
                                  @endif
                                >{{$permission_group->name}}</option>
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

