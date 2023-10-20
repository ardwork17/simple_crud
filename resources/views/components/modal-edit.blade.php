<!-- Modal -->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDIT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="guest_id">
                <div class="form-group">
                    <label for="name" class="control-label">Nama</label>
                    <input type="text" class="form-control" id="nama-edit">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama"></div>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label">No KTP</label>
                    <input type="text" class="form-control" id="ktp-edit">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-ktp"></div>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label">Telepon</label>
                    <input type="number" class="form-control" id="telepon-edit">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-telepon"></div>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label">Email</label>
                    <input type="email" class="form-control" id="email-edit">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-email"></div>
                </div>
                

                <div class="form-group">
                    <label class="control-label">Alamat</label>
                    <textarea class="form-control" id="alamat-edit" rows="4"></textarea>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-alamat"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                <button type="button" class="btn btn-primary" id="update">UPDATE</button>
            </div>
        </div>
    </div>
</div>

<script>
    //button create post event
    $('body').on('click', '#btn-edit-post', function () {

        let guest_id = $(this).data('id');
        $.ajax({
            url: `/guest/${guest_id}`,
            type: "GET",
            cache: false,
           success:function(response){

                //fill data to form
                $('#guest_id').val(response.data.id);
                $('#nama-edit').val(response.data.nama);
                $('#ktp-edit').val(response.data.no_ktp);
                $('#telepon-edit').val(response.data.telepon);
                $('#email-edit').val(response.data.email);
                $('#alamat-edit').val(response.data.alamat);

                //open modal
                $('#modal-edit').modal('show');
            }
        })
        //open modal
    });

    //action create post
    $('#update').click(function(e) {
        e.preventDefault();

        //define 
        let guest_id = $('#guest_id').val();
        let nama   = $('#nama-edit').val();
        let no_ktp   = $('#ktp-edit').val();
        let telepon = $('#telepon-edit').val();
        let email = $('#email-edit').val();
        let alamat = $('#alamat-edit').val();
        let token   = $("meta[name='csrf-token']").attr("content");
        
        //ajax
        $.ajax({

            url: `/guest/${guest_id}`,
            type: "PUT",
            cache: false,
            data: {
                "nama": nama,
                "no_ktp": no_ktp,
                "telepon": telepon,
                "email": email,
                "alamat": alamat,
                "_token": token
            },
            success:function(response){

                //show success message
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });

                //data post
                let post = `
                    <tr id="index_${response.data.id}">
                        <td>${response.data.nama}</td>
                        <td>${response.data.no_ktp}</td>
                        <td>${response.data.telepon}</td>
                        <td>${response.data.email}</td>
                        <td>${response.data.alamat}</td>
                        <td class="text-center">
                            <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                            <a href="javascript:void(0)" id="btn-delete-post" data-id="${response.data.id}" class="btn btn-danger btn-sm">DELETE</a>
                        </td>
                    </tr>
                `;
                
                //append to table
                $(`#index_${response.data.id}`).replaceWith(post);

                //close modal
                $('#modal-edit').modal('hide');
                

            },
            error:function(error){
                
                if(error.responseJSON.nama[0]) {

                    //show alert
                    $('#alert-nama').removeClass('d-none');
                    $('#alert-nama').addClass('d-block');

                    //add message to alert
                    $('#alert-nama').html(error.responseJSON.nama[0]);
                } 
                if(error.responseJSON.nama[0]) {

                    //show alert
                    $('#alert-ktp').removeClass('d-none');
                    $('#alert-ktp').addClass('d-block');

                    //add message to alert
                    $('#alert-ktp').html(error.responseJSON.no_ktp[0]);
                } 

                if(error.responseJSON.telepon[0]) {

                    //show alert
                    $('#alert-telepon').removeClass('d-none');
                    $('#alert-telepon').addClass('d-block');

                    //add message to alert
                    $('#alert-telepon').html(error.responseJSON.telepon[0]);
                } 
                if(error.responseJSON.email[0]) {

                    //show alert
                    $('#alert-email').removeClass('d-none');
                    $('#alert-email').addClass('d-block');

                    //add message to alert
                    $('#alert-email').html(error.responseJSON.email[0]);
                } 
                if(error.responseJSON.alamat[0]) {

                    //show alert
                    $('#alert-alamat').removeClass('d-none');
                    $('#alert-alamat').addClass('d-block');

                    //add message to alert
                    $('#alert-alamat').html(error.responseJSON.alamat[0]);
                } 

            }

        });

    });

</script>