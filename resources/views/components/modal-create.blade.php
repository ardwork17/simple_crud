<!-- Modal -->
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH GUEST</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="name" class="control-label">Nama</label>
                    <input type="text" class="form-control" id="nama">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama"></div>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label">Telepon</label>
                    <input type="number" class="form-control" id="telepon">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-telepon"></div>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label">Email</label>
                    <input type="email" class="form-control" id="email">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-email"></div>
                </div>
                

                <div class="form-group">
                    <label class="control-label">Alamat</label>
                    <textarea class="form-control" id="alamat" rows="4"></textarea>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-alamat"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                <button type="button" class="btn btn-primary" id="store">SIMPAN</button>
            </div>
        </div>
    </div>
</div>

<script>
    //button create post event
    $('body').on('click', '#btn-create-post', function () {

        //open modal
        $('#modal-create').modal('show');
    });

    //action create post
    $('#store').click(function(e) {
        e.preventDefault();

        //define variable
        let nama   = $('#nama').val();
        let telepon = $('#telepon').val();
        let email = $('#email').val();
        let alamat = $('#alamat').val();
        let token   = $("meta[name='csrf-token']").attr("content");
        
        //ajax
        $.ajax({

            url: `/guest`,
            type: "POST",
            cache: false,
            data: {
                "nama": nama,
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
                $('#table-posts').prepend(post);
                
                //clear form
                $('#nama').val('');
                $('#telepon').val('');
                $('#email').val('');
                $('#alamat').val('');

                //close modal
                $('#modal-create').modal('hide');
                

            },
            error:function(error){
                
                if(error.responseJSON.nama[0]) {

                    //show alert
                    $('#alert-nama').removeClass('d-none');
                    $('#alert-nama').addClass('d-block');

                    //add message to alert
                    $('#alert-nama').html(error.responseJSON.nama[0]);
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