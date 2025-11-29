<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
        class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center w-100">
            <div class="row justify-content-center w-100">
                <div class="col-md-8 col-lg-6 col-xxl-3">
                    <div class="card mb-0">
                        <div class="card-body">
                            <h3 class="text-center"><b>CREATIVE COMPUTER</b></h3>
                            <p class="text-center">Welcome To Our Website</p>
                            <form wire:submit.prevent="register" novalidate>
                                <div class="mb-3">
                                    <label class="mb-2"><b>Name</b></label>
                                    <input wire:model.defer="name" type="text" id="nameInput"
                                        class="form-control form-control-xl @error('name') is-invalid @enderror">
                                    @error('name') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="mb-2"><b>Email</b></label>
                                    <input wire:model.defer="email" type="email" id="emailInput"
                                        class="form-control form-control-xl @error('email') is-invalid @enderror">
                                    @error('email') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="mb-2"><b>Phone</b></label>
                                    <input wire:model.defer="phone" type="number" id="phoneInput"
                                        class="form-control form-control-xl @error('phone') is-invalid @enderror">
                                    @error('phone') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="mb-2"><b>Password</b></label>
                                    <input wire:model.defer="password" type="password" id="passwordInput"
                                        class="form-control form-control-xl @error('password') is-invalid @enderror">
                                    @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="mb-2"><b>Password Confirmation</b></label>
                                    <input wire:model.defer="password_confirmation" type="password" id="passwordConfirmInput"
                                        class="form-control form-control-xl @error('password_confirmation') is-invalid @enderror">
                                    @error('password_confirmation') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                </div>

                                <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2"
                                    wire:loading.attr="disabled" wire:target="register">
                                    <span wire:loading.remove>Register</span>
                                    <span wire:loading>Loading...</span>
                                </button>

                                <div class="d-flex align-items-center justify-content-center">
                                    <p class="fs-4 mb-0 fw-bold">Do You Have an Account?</p>
                                    <a class="text-primary fw-bold ms-2" href="{{ route('login') }}" wire:navigate>Login Now!</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>