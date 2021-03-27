@if(session('success'))
 	<div class="alert alert-icon alert-success alert-dismissible" role="alert">
      	<i class="fas fa-check"></i> {{session('success')}}
          <a href="#" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </a>
    </div>
@endif