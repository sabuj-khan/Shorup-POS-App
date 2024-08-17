<div class="modal" id="delete-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class=" mt-3 text-warning">Delete !</h3>
                <p class="mb-3">Once delete, you can't get it back.</p>
                <input class="d-none" id="deleteID"/>
            </div>
            <div class="modal-footer justify-content-end">
                <div>
                    <button type="button" id="delete-modal-close" class="btn shadow-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button onclick="DeleteCustomer()" type="button" id="confirmDelete" class="btn shadow-sm btn-danger" >Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    async function DeleteCustomer(){
        customerId = document.getElementById('deleteID').value;

        document.getElementById("delete-modal-close").click();

        showLoader();
        let response = await axios.post('/customers-delete', {"id":customerId});
        hideLoader();

        if(response.status == 201 && response.data['status']){
            successToast(response.data['message']);
            await getCustomerList();
        }else{
            errorToast(response.data['message']);
        }

    }

</script>