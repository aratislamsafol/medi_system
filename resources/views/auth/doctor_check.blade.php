
<h1>Get Doctor Category</h1>
<h4>Please Fill One More Step!</h4>
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
     @endif
    <form method="POST" action="{{ route('doctor_register') }}">
        @csrf
        {{-- <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    If You Registered For Doctor. Please Fill The form And Submit ..
                </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">

                </div>
            </div>
        </div> --}}

        <div class="row mb-3 mt-3">
            <label for="Designation" class="col-md-4 col-form-label text-md-end">{{ __('Designation') }}</label>
            <div class="col-md-6">
                <select class="form-select" name="designation" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
        </div>

        <div class="row mb-3 mt-3">
            <label for="expertise" class="col-md-4 col-form-label text-md-end">{{ __('Expertise') }}</label>
            <div class="col-md-6">
                <select class="form-select" name="expertise"  aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                    </select>
            </div>
        </div>

        <div class="row mb-3 mt-3">
            <label for="documents" class="col-md-4 col-form-label text-md-end">{{ __('All Certificate with zip') }}</label>
            <div class="col-md-6">
                <div class="mb-3">
                    <input class="form-control" name="certificate" type="file" id="formFileMultiple" multiple>
                </div>
            </div>
        </div>

    </form>
