<!-- Modal add -->
<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="modalAddLabel">Tambah data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="/create" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="image">Foto barang</label>
            <div class="row border p-3 m-1">
                <div class="form-group col-md-6">
                    <input type="file" name="gambar" placeholder="Pilih gambar" id="image" class="form-control @error('gambar') is-invalid @enderror">
                      @error('gambar')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror
                </div>
                <div class="form-group col-md-6">
                    <img id="preview-image-before-upload" class="img-fluid" src=""
                         alt="preview image" style="max-height: 250px;">
                </div>
            </div>
            <div class="form-group">
                <label for="namaBarang">Nama Barang</label>
                <input type="text" name="namaBarang" id="namaBarang" class="form-control @error('namaBarang') is-invalid @enderror" autocomplete="off">
                @error('namaBarang')
                      <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="hargaBeli">Harga Beli</label>
                <input type="text" name="hargaBeli" id="hargaBeli" class="form-control uang" autocomplete="off">
                @error('hargaBeli')
                      <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="hargaJual">Harga Jual</label>
                <input type="text" name="hargaJual" id="hargaJual" class="form-control uang" autocomplete="off">
                @error('hargaJual')
                      <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number" name="stok" id="stok" class="form-control" min="1" autocomplete="off">
                @error('stok')
                      <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
    </div>
    </div>
</div>
<!-- End Modal add -->

<!-- Modal edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="modalEditLabel">Edit data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="" method="POST" enctype="multipart/form-data" id="edit">
            @csrf
            <label for="image">Foto barang</label>
            <div class="row border p-3 m-1">
                <div class="form-group col-md-6">
                    <input type="file" name="gambar" id="image-edit" class="form-control @error('gambar') is-invalid @enderror">
                      @error('gambar')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror
                </div>
                <div class="form-group col-md-6">
                    <img id="preview-image-before-upload-edit" class="img-fluid" src=""
                         alt="preview image" style="max-height: 250px;">
                </div>
            </div>
            <div class="form-group">
                <label for="namaBarang">Nama Barang</label>
                <input type="text" name="namaBarang" id="namaBarang" class="form-control @error('namaBarang') is-invalid @enderror" autocomplete="off">
                @error('namaBarang')
                      <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="hargaBeli">Harga Beli</label>
                <input type="text" name="hargaBeli" id="hargaBeli" class="form-control uang @error('hargaBeli') is-invalid @enderror" autocomplete="off">
                @error('hargaBeli')
                      <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="hargaJual">Harga Jual</label>
                <input type="text" name="hargaJual" id="hargaJual" class="form-control uang @error('hargaJual') is-invalid @enderror" autocomplete="off">
                @error('hargaJual')
                      <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number" name="stok" id="stok" class="form-control @error('stok') is-invalid @enderror" min="1" autocomplete="off">
                @error('stok')
                      <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
    </div>
    </div>
</div>
<!-- End Modal edit -->