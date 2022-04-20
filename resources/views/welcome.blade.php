<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&display=swap" rel="stylesheet">
        <style>
          body{
            font-family: 'Bree Serif', serif;
          }
          .form-group{
              margin-top: 10px;
          }
          .img{
              width: 60px;
          }
          input#search-bar{
            margin: 0 auto;
            width: 100%;
            height: 45px;
            padding: 0 20px;
            font-size: 1rem;
            border: 1px solid #D0CFCE;
            outline: none;
            &:focus{
            border: 1px solid #008ABF;
            transition: 0.35s ease;
            color: #008ABF;
            &::-webkit-input-placeholder{
            transition: opacity 0.45s ease; 
            opacity: 0;
            }
            &::-moz-placeholder {
            transition: opacity 0.45s ease; 
            opacity: 0;
            }
            &:-ms-placeholder {
            transition: opacity 0.45s ease; 
            opacity: 0;
            }    
        }
        }
        </style>
    </head>
    <body>
       <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Tes Praktek PHP Programmer <strong>PT NUTECH INTEGRASI</strong></h1>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <p>Product Data</p>
                        <button class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#modalAdd" onclick="add()">Tambah data</button>
                    </div>
                    <div class="card-body">
                        <form action="#">
                            <div class="input-group mb-3 ml-4">
                                <input type="text" id="search-bar" name="search" placeholder="Cari nama barang..." autocomplete="off">
                            </div>
                        </form>
                        <table class="table"> 
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th> Nama barang </th>
                                    <th> harga Beli</th>
                                    <th> Harga Jual </th>
                                    <th>Stock</th>
                                    <th>Gambar</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($products as $product)
                                    <tr>
                                        <th>{{$no++}}</th>
                                        <th>{{$product->namaBarang}}</th>
                                        <th>{{$product->hargaBeli}}</th>
                                        <th>{{$product->hargaJual}}</th>
                                        <th>{{$product->stok}}</th>
                                        <th><img src="{{asset($product->gambar)}}" class="img img-fluid" alt="img product"></th>
                                        <th>
                                             <div class="btn btn-info" onclick="edit({{$product->id}})">Edit</div> 
                                             <div class="btn btn-danger" onclick="destroy({{$product->id}})">Delete</div>
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$products->links()}}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
            </div>
        </div>
       </div>
        @include('modal')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{asset('js/jquery.mask.js')}}"></script>
        <script>
            $('#image').change(function(){
            
            let reader = new FileReader();
         
            reader.onload = (e) => { 
         
              $('#preview-image-before-upload').attr('src', e.target.result); 
            }
         
            reader.readAsDataURL(this.files[0]); 
           
           });

           $('#image-edit').change(function(){
            
            let reader = new FileReader();
         
            reader.onload = (e) => { 
         
              $('#preview-image-before-upload-edit').attr('src', e.target.result); 
            }
         
            reader.readAsDataURL(this.files[0]); 
           
           });

            //    Format uang
            $( '.uang' ).mask("#.##0", {reverse: true});
            //BECKEND
            //str_replace('.', '', $_POST['hargaBeli']);

            @if (count($errors) > 0)
            // var myModal = new bootstrap.Modal(document.getElementById('modalAdd'), {
            //     keyboard: false
            //     });
            //     myModal.show();

            Swal.fire({
                icon: 'error',
                title: 'Something went wrong, input not validate !',
            })
            @endif


            function edit(id){
                var request = $.ajax({
                    url: "/getData/"+id,
                    method: "GET",
                });
                
                request.done(function( data ) {
                    product = data.product;

                    $('#edit').attr('action', '/update/'+id);
                    $('#edit').find($('input[name="gambar"]')).attr('accept', product.gambar);
                    $('#edit').find($('#preview-image-before-upload-edit')).attr('src', product.gambar);
                    $('#edit').find($('input[name="namaBarang"]')).val(product.namaBarang);
                    $('#edit').find($('input[name="hargaBeli"]')).val(product.hargaBeli);
                    $('#edit').find($('input[name="hargaJual"]')).val(product.hargaJual);
                    $('#edit').find($('input[name="stok"]')).val(product.stok);
                    
                    var myModal = new bootstrap.Modal(document.getElementById('modalEdit'), {
                        keyboard: false
                    });
                    myModal.show();
                });
                
                request.fail(function( jqXHR, textStatus ) {
                alert( "Request failed: " + textStatus );
                });
                }

                function destroy(id){
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success',
                            cancelButton: 'btn btn-danger'
                        },
                        buttonsStyling: true
                        })

                        swalWithBootstrapButtons.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'No, cancel!',
                        reverseButtons: true
                        }).then((result) => {
                        if (result.isConfirmed) {
                            var request = $.ajax({
                                url: "/delete/"+id,
                                method: "GET",
                            });
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                            location.reload();
                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            swalWithBootstrapButtons.fire(
                            'Cancelled',
                            'Your imaginary file is safe :)',
                            'error'
                            )
                        }
                    });
                    }
        </script>
    </body>
</html>
