<div class="modal" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Customer</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Customer Name *</label>
                                <input type="text" class="form-control" id="customNameUpdate">

                                <label class="form-label">Customer Email *</label>
                                <input type="text" class="form-control" id="customEmailUpdate">

                                <label class="form-label">Customer Phone *</label>
                                <input type="text" class="form-control" id="customPhoneUpdate">

                                <input class="d-none" id="updateID">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="UpdateCustomer()" id="update-btn" class="btn btn-sm  btn-success" >Update</button>
            </div>
        </div>
    </div>
</div>


<script>

    async function FillUpCusUpdateForm(id){
        showLoader();
        let response = await axios.post('/customers-by-id', {"id":id});
        hideLoader();

        document.getElementById('customNameUpdate').value = response.data['data']['name'];
        document.getElementById('customEmailUpdate').value = response.data['data']['email'];
        document.getElementById('customPhoneUpdate').value = response.data['data']['phone'];
        document.getElementById('updateID').value = response.data['data']['id'];
    }


    async function UpdateCustomer(){
        cusName = document.getElementById('customNameUpdate').value;
        cusEmail = document.getElementById('customEmailUpdate').value;
        cusPhone = document.getElementById('customPhoneUpdate').value;
        cusId = document.getElementById('updateID').value;

        if(cusName.length == 0){
            errorToast('Customer name is required');
        }else if(cusEmail.length == 0){
            errorToast('Customer email address is required');
        }else if(cusPhone.length == 0){
            errorToast('Phone number is required');
        }else{
            document.getElementById('update-modal-close').click();

            showLoader();
            let response = await axios.post('/customers-update', {
                "name":cusName,
                "email":cusEmail,
                "phone":cusPhone,
                "id":cusId
            })
            hideLoader();

            if(response.status == 201 && response.data['status'] == 'success'){
                successToast(response.data['message']);
                document.getElementById("update-form").reset();
                await getCustomerList();
            }else{
                errorToast(response.data['message']);
            }
        }
    }


</script>