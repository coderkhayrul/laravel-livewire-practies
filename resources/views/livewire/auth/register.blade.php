<main class="form-signin w-100 m-auto">
    <h1 class="h3 mb-3 fw-normal">Please sing up</h1>
    <form wire:submit.prevent="register">
        <div class="form-floating my-2">
            <input wire:model="name" name="name" type="name" class="form-control" id="floatingInput" placeholder="Name">
            <label for="floatingInput">Name</label>
        </div>
        <div class="form-floating my-2">
            <input wire:model="email" name="email" type="email" class="form-control" id="floatingInput"
                placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating my-2">
            <input wire:model="password" name="password" type="password" class="form-control" id="floatingPassword"
                placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>

        <div class="form-floating my-2">
            <input wire:model="passwordConfirmation" name="passwordConfirmation" type="password" class="form-control"
                id="passwordConfirmation" placeholder="Password">
            <label for="passwordConfirmation">Confirm Password</label>
        </div>

        <button class="btn btn-primary w-100 py-2" type="submit">Sign up</button>
    </form>
</main>
