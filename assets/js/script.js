const URL = 'http://localhost/toko-motor';

  function getProduct(nama){
    let endpoint = URL + '/dashboard/get';
    if(nama){
      endpoint += `/0/${nama}`;
    }
    const XHR = new XMLHttpRequest();
    XHR.open('GET', endpoint);
    XHR.send();
    XHR.onreadystatechange = function(){
      if(this.status == 200 && this.readyState == 4){
        listProduct( JSON.parse(this.response) );
      }
    }
  }

  function listProduct(product){
    let tbody = document.querySelector('#list-product tbody');

    tbody.innerHTML = '';
    if(!product.length){
      tbody.innerHTML = '<h3>Data tidak ada</h3>';
      return;
    }
    product.map((val, key)=>{
      tbody.innerHTML += `<tr>
                            <td><img src="${URL+'/assets/img/'+val.FotoBarang}"></td>
                            <td>${val.NamaBarang}</td>
                            <td>RP. ${val.HargaJual}</td>
                            <td>RP. ${val.HargaBeli}</td>
                            <td>RP. ${val.Stok}</td>
                            <td>
                              <button class='btn btn-danger'
                                onclick="deleteProduct(${val.id})">
                                  Delete
                              </button>
                            </td>
                            <td>
                              <button class='btn btn-warning'
                                onclick="editProduct(${val.id})"
                                data-toggle="modal"
                                data-target="#edit-wrapper">
                                  Edit
                              </button>
                            </td>
                          </tr>`;
    });
  }

  function clearHideModal(modal_id){
    let numInput = document.querySelectorAll('.modal input');
    for(let i = 0; i < numInput.length; i++){
      numInput[i].value = '';
    }
    document.getElementById(modal_id).classList.toggle('toggle');
  }

  function showNotif(message, alery_type){
    document.getElementsByClassName('notif')[0].classList.remove('hide');
    const ALERT = document.querySelector('.notif .alert');
    ALERT.classList.add(alery_type);
    ALERT.innerHTML = message + `<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>`;
  }

  function hideModal(modal_id){
    let modal = document.getElementById(modal_id);
    modal.classList.remove('show');
    modal.setAttribute('aria-hidden', 'true');
    modal.style.display = 'none';

    const modalsBackdrops = document.getElementsByClassName('modal-backdrop')[0];
    document.body.removeChild(modalsBackdrops);
    document.body.classList.remove('modal-open');
  }

  function addProduct(){
    let form = document.getElementById('add-product')
    form.addEventListener('submit', function(e){
      e.preventDefault();
      let formData = new FormData(form);
      const xhr = new XMLHttpRequest();
      xhr.open('POST','http://localhost/toko-motor/dashboard/add',true);
      xhr.onreadystatechange = function(){
        if (xhr.readyState == 4 && xhr.status == 200) {
          getProduct();
          clearHideModal('add-wrapper');
          showNotif('berhasil menambah data', 'alert-success');
          hideModal('add-wrapper');
        } else if(xhr.readyState == 4 && xhr.status == 400) {
          alert(this.response);
        }
      }
      xhr.send(formData);
    });
  }

  function deleteProduct(id){
    const XHR = new XMLHttpRequest();
    const ask = confirm('yakin ingin menghapus data ?');
    if (!ask) return;
    XHR.open('GET', `http://localhost/toko-motor/dashboard/delete/${id}`);
    XHR.send();
    XHR.onreadystatechange = function(){
      if(this.status == 200 && this.readyState == 4){
        alert(this.response);
        getProduct();
      }
    }
  }

  function editProduct(id){
    populateFormEdit(id);
    let form_edit = document.getElementById('edit-product')
    form_edit.addEventListener('submit', function(e){
      e.preventDefault();
      let formData = new FormData(form_edit);
      const xhr = new XMLHttpRequest();
      xhr.open('POST',`http://localhost/toko-motor/dashboard/edit/${id}`,true);
      xhr.onreadystatechange = function(){
        if (xhr.readyState == 4 && xhr.status == 200) {
          getProduct();
          showNotif('berhasil mengedit data', 'alert-success');
          hideModal('edit-wrapper');
        } else if(xhr.readyState == 4 && xhr.status == 400) {
          showNotif('gagal mengedit data', 'alert-danger');
          hideModal('edit-wrapper');
        }
      }
      xhr.send(formData);
    });
  }

  function searchProduct(e){
    let product = e;
    getProduct(product);
  }

  function populateFormEdit(id){
    const XHR = new XMLHttpRequest();
    XHR.open('GET', `http://localhost/toko-motor/dashboard/get/${id}`);
    XHR.send();
    XHR.onreadystatechange = function(){
      if(this.status == 200 && this.readyState == 4){
        let product = JSON.parse(this.response);
        product = product[0];
        let key = Object.keys(product);
        for(let i = 1; i<key.length; i++){
            if(key[i] == 'FotoBarang') {
              document.querySelector(`#edit-product img`).src = URL+'/assets/img/'+product[key[i]];
              continue;
            }
            document.querySelector(`#edit-product [name="${key[i]}"]`).value = product[key[i]];
        }
      }
    }
  }

  getProduct();
  addProduct();
