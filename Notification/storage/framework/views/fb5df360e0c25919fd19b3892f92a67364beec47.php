
<?php echo $__env->make('layouts.inc.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
    <section class="container mt-4">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12 col-sm-6 col-md-6">
            <form class="form-container">
                <h2 class="text-center bg-dark p-2 text-white">Add task listing</h2>

                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" id="title" name="title">
                </div>

                
                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea placeholder="Enter Description" class="form-control" id="description" name="description"></textarea>
                </div>

                <button type="submit" class="btn btn-dark btn-block save_btn">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('javascript'); ?>
<script>
    $(document).ready(function(){
      var pusher = new Pusher('4af6902ccedc3735fccb', {
        cluster: 'eu'
      });

      var channel = pusher.subscribe('my-channel');

      channel.bind('my-event', function(data){
        // alert(JSON.stringify(data));
        if(data.from){
          let pending = parseInt($('#'+ data.from).find('.pending').html());
          if(pending){
            $('#'+ data.from).find('.pending').html(pending + 1);
          }else{
            $('#'+ data.from).html('<a href="#" class="nav-link" data-toggle="dropdown"> <i class="fa fa-bell text-white"> <span class="badge badge-danger pending">1</span> </i> </a>');
          }
        }
      });

      $('.save_btn').on('click', function(e){
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    

        let title = $('#title').val();
        let description = $('#description').val();
        const form = $(this).parents('form');
        $(form).validate({
          rules:{
            title:{
              required:true // Le nom de la règle doit être "required" au lieu de "require"
            }
          },
          messages:{ // Le nom de la propriété doit être "messages" au lieu de "message"
            title:"title is required"
          },
          submitHandler: function(){
            var formData = new FormData(form[0]); // "FormData" au lieu de "formData"

            $.ajax({
              type: 'POST',
              url: 'save_task',
              data: formData,
              processData: false,
              contentType: false,
              success: function(data){
                console.log(data);
                if(data.status){
                  $('#notifDiv').fadeIn();
                  $('#notifDiv').css('background', 'green');
                  $('#notifDiv').text(data.message);
                  setTimeout(() => {
                      $('#notifDiv').fadeOut();
                  }, 3000);
                  $('[name="title"]'); // Correction ici : '$' au lieu de '$.'
                  $('textarea[name="description"]'); // Correction ici : '$' au lieu de '$.'
                }else{
                  $('#notifDiv').fadeIn();
                  $('#notifDiv').css('background', 'red');
                  $('#notifDiv').text('Something went wrong'); // Correction ici : chaîne de caractères entre guillemets
                  setTimeout(() => {
                      $('#notifDiv').fadeOut();
                  }, 3000);
                }
              },
              error: function(err){
                console.log(err);
              }
            });
          }
        });
      });
    });
</script>

  
<?php $__env->stopPush(); ?>




<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\user-auth-complete-laravel-module\resources\views/dashboard.blade.php ENDPATH**/ ?>