<header>
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-6">
        <h1>Welcome To Product Manager</h1>
      </div>
      <div class="col-12 col-md-6">
        <a href="<?= base_url('logout')?>">
          <button type="button" class="btn btn-danger float-right">Logout</button>
        </a>
        <button
          type="button"
          class="btn btn-primary float-right mr-4"
          data-toggle="modal"
          data-target="#add-wrapper"
          >
          Add Product
        </button>
      </div>
    </div>
  </div>
</header>

<main>
  <!-- Modal Add Product -->
  <div class="modal" id="add-wrapper">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Product</h4>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
          <form class="form-row" id="add-product" method='POST' enctype='multpart/form-data'>
            <div class="form-group col-12">
              <label for="NamaBarang1">Nama Barang</label>
              <input type="text" name="NamaBarang" id="NamaBarang1">
            </div>
            <div class="form-group col-12">
              <label for="FotoBarang1">Foto Barang</label>
              <input type="file" name="FotoBarang" id="FotoBarang1">
            </div>
            <div class="form-group col-12">
              <label for="HargaJual1">Harga Jual</label>
              <input type="text" name="HargaJual" id="HargaJual1">
            </div>
            <div class="form-group col-12">
              <label for="HargaBeli1">Harga Beli</label>
              <input type="text" name="HargaBeli" id="HargaBeli1">
            </div>
            <div class="form-group col-12">
              <label for="Stok1">Jumlah Stok</label>
              <input type="text" name="Stok" id="Stok1">
            </div>
            <button class="btn btn-primary" type="submit">Add Product</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Edit Product -->
  <div class="modal" id="edit-wrapper">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Product</h4>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
          <form class="form-row" id="edit-product" method='POST' enctype='multpart/form-data'>
            <div class="form-group col-12">
              <label for="NamaBarang">Nama Barang</label>
              <input type="text" name="NamaBarang" id="NamaBarang">
            </div>
            <div class="form-group col-12">
              <label for="FotoBarang">Foto Barang</label>
              <input type="file" name="FotoBarang" id="FotoBarang">
              <img src="">
            </div>
            <div class="form-group col-12">
              <label for="HargaJual">Harga Jual</label>
              <input type="text" name="HargaJual" id="HargaJual">
            </div>
            <div class="form-group col-12">
              <label for="HargaBeli">Harga Beli</label>
              <input type="text" name="HargaBeli" id="HargaBeli">
            </div>
            <div class="form-group col-12">
              <label for="Stok">Jumlah Stok</label>
              <input type="text" name="Stok" id="Stok">
            </div>
            <button class="btn btn-primary" type="submit">Edit Product</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="container notif hide">
    <div class="alert alert-dismissible fade show" role="alert">
      <!-- message here -->
    </div>
  </div>

  <div class="container mb-3">
    <div class="row">
      <div class="col-12">
        <input class="form-control mr-sm-2" type="search" placeholder="Search Product..." aria-label="Search" onkeyup="searchProduct(event.target.value)">
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-12">
          <table class="table" id="list-product">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Nama Barang</th>
                <th scope="col">Foto Barang</th>
                <th scope="col">Harga Jual</th>
                <th scope="col">Harga Beli</th>
                <th scope="col">Jumlah Stok</th>
                <th scope="col" colspan="2">Action</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
      </div>
    </div>
  </div>
</main>
