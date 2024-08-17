<div class="modal" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">


                                <label class="form-label">Category</label>
                                <select type="text" class="form-control form-select" id="productCategoryUpdate">
                                    <option value="">Select Category</option>
                                </select>

                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" id="productNameUpdate">
                                <label class="form-label">Price</label>
                                <input type="text" class="form-control" id="productPriceUpdate">
                                <label class="form-label">Unit</label>
                                <input type="text" class="form-control" id="productUnitUpdate">
                                <br/>
                                <img class="w-15" id="oldImg" src="{{asset('assets/images/default.jpg')}}"/>
                                <br/>
                                <label class="form-label">Image</label>
                                <input oninput="oldImg.src=window.URL.createObjectURL(this.files[0])"  type="file" class="form-control" id="productImgUpdate">

                                <input type="text" class="d-none" id="updateID" placeholder="ID"> <br>
                                <input type="text" class="d-none" id="filePath" placeholder="File Path">


                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button id="update-modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>

                <button onclick="updateProduct()" id="update-btn" class="btn btn-sm btn-success" >Update</button>
            </div>

        </div>
    </div>
</div>


<script>



    async function fillUpdateCategoryOption(){
        showLoader();
        let response = await axios.get('/category-list')
        hideLoader();

        response.data['data'].forEach(function(item){
            let option = `<option value="${item['id']}">${item['name']}</option>`

            $("#productCategoryUpdate").append(option);
        });
    }

    async function fillupUpdatedForm(id, path){
        document.getElementById("updateID").value = id
        document.getElementById("filePath").value = path
        document.getElementById("oldImg").src     = path

        showLoader();
        await fillUpdateCategoryOption();
        let response = await axios.post('/product-by-id', {"id":id});
        hideLoader();

        document.getElementById("productNameUpdate").value     = response.data['data']['name'];
        document.getElementById("productPriceUpdate").value    = response.data['data']['price'];
        document.getElementById("productUnitUpdate").value     = response.data['data']['unit'];
        document.getElementById("productCategoryUpdate").value = response.data['data']['category_id'];

        
    }


    async function updateProduct(){
        let productCategory = document.getElementById('productCategoryUpdate').value;
        let productName     = document.getElementById('productNameUpdate').value;
        let productPrice    = document.getElementById('productPriceUpdate').value;
        let productUnit     = document.getElementById('productUnitUpdate').value;
        let producImage     = document.getElementById('productImgUpdate').files[0];
        let producId        = document.getElementById('updateID').value;
        let producOldImage  = document.getElementById('oldImg').value;

        if(productCategory.length == 0){
            errorToast('Product category is required');
        }else if(productName.length == 0){
            errorToast('Product name is required');
        }else if(productPrice.length == 0){
            errorToast('Product price is required');
        }else if(productUnit.length == 0){
            errorToast('Product unit is required');
        }else{
            document.getElementById("update-modal-close").click();

            let formData = new FormData();
            formData.append('category_id', productCategory);
            formData.append('name', productName);
            formData.append('price', productPrice);
            formData.append('unit', productUnit);
            formData.append('img', producImage);
            formData.append('id', producId);
            formData.append('file_path', producOldImage);


            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }


            showLoader();
            let response = await axios.post('/product-update', formData, config);
            hideLoader();

            if(response.status == 200 && response.data['status']){
                successToast(response.data['message']);
                document.getElementById("update-form").reset();

                await getProductList();

            }else{
                errorToast(response.data['message']);
            }


           





        }

    }

</script>