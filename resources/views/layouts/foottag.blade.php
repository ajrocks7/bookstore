<script src="{{ asset('custom-asset/js/pagejs/jquery.min.js') }}"></script>
  <script
  src="{{ asset('custom-asset/js/pagejs/datepicker.min.js') }}"
  ></script>
   <script src="{{ asset('custom-asset/js/pagejs/datatables.min.js') }}"></script>
   <script src="{{ asset('custom-asset/js/jquery-validate/jquery.validate.min.js') }}"></script>
    <script src="{{  asset('custom-asset/js/jquery-validate/additional-methods.min.js') }}"></script>
    <script src="{{  asset('custom-asset/js/jquery-validate/custom-methods.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    <script src="{{ asset('custom-asset/js/pagejs/sweetalert.js') }}"></script>
<script>
    $(document).ready( function () {
    $('.myTable').DataTable({
    responsive: true,
    scrollX: true,
});

$('.datepicker').datepicker({
    format: 'dd-mm-yyyy'
 });

$("#outputimg").hide();


$('#form-element').validate({
        rules: {
            title: {
                required: true
            },
            author:{
                required: true
            },
            genre: {
                required: true
            },
            description:{
                required: true
            },
            isbn: {
                required: true
            },
            publisheddate: {
                required: true
            },
            publisher:{
                required: true
            },
        },
      messages : {
        title: {
                required: "Please enter Title"
            },
        author: {
                required: "Please enter Author"
            },
        genre: {
                required: "Please enter Genre"
            },
        description: {
                required: "Please enter Description"
            },
        isbn: {
                required: "Please enter ISBN"
            },
        publisheddate: {
                required: "Please Provide Date"
            },
        publisher: {
                required: "Please Enter Publisher Name"
            },                   
      }
    });

  


    
} );

function showimage()
        {
            $("#outputimg").show();
            $("#editoutputimg").hide();
        }

        function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#outputimg').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]);
  }
}
    
$('#bookimage').change(function(){
            readURL(this);
    });

    
    function push_delete(id)
    {
       
      Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  //send request to server
  if (result.value) {
    $.ajax({
    type: "POST",
    url: '{{ url('Admin/deleteproduct') }}',
    data: {
            id: id,
            },
    headers: {
        'X-CSRF-Token': '{{ csrf_token() }}',
    },        
    success: function (data) {
    if (data == 1) {
        Swal.fire(
      'Deleted!',
      'Product has been deleted.',
      'success'
    )
    setTimeout(function () {
    window.location.href='{{ url('Admin/listproducts') }}';
    }, 1100);
    } else {
        Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'Something went wrong!',
})
        }
    },
     error: function (xhr, ajaxOptions, thrownError) {
    swal("cancel!", "It was Cancelled", "error");
        }
    });
  }
})
    }

</script>

@if(Session::has('message'))
    <script>
    $(document).ready(function(){
        var type = "{{ Session::get('alert-type') }}";
        var message = "{{ Session::get('message') }}";
        switch(type){
            case 'info':
                toastr.info(message);
                break;
            
            case 'warning':
                toastr.warning(message);
                break;
            case 'success':
                toastr.success(message);
                break;
            case 'error':
                toastr.error(message);
                break;
        }
    });
    </script>
    @endif