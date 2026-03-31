<!-- HTML -->
<div class=" d-flex justify-content-center " > 
    <!-- <div id="Msg-body" class="col-10 col-sm-5 col-lg-3 mt-3 mb-3"> connection </div> -->
</div>



<div class="modal fade primary" id="staticBackdrop" data-bs-backdrop="static" style="display: block;" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" >
        <div class="modal-content ">

            <div class="modal-header d-flex justify-content-around bg-primary text-white">
                <div>
                    <img src="App/public/assets/ImagesApp/LogoChichoune50x50.png" alt="logo" class="img-fluid rounded-circle">
                </div>
                <div>
                    <h3 class="modal-title"><span class='fst-italic fw-bold'> - Connection - </span></h3>
                </div>
            </div>

            <div id='modal-msg' class="d-flex justify-content-center align-items-center mt-3">
                <!-- Via JavaScript response Fetch </div> -->
            </div>
            <div class="modal-body d-flex justify-content-center">
                <?= $data["htmlForm"] ?? "" ?>
            </div>

            <div class="modal-footer d-flex justify-content-around">
                <button data-url="login/login" id="submit" type="submit" class="btn btn-primary" data-bs-dismiss="modal"><i class="fa-solid fa-paper-plane text-white me-2"></i> Connection </button>
            </div>
        </div>
    </div>
</div>

