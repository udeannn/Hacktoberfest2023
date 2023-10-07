<form id="form-store">
    <x-modal>
        <input type="hidden" name="id">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="form-group">
            <label>Role</label>
            <select name="role" class="form-control w-100">
                <option value="1">Admin</option>
                <option value="2">Cashier</option>
            </select>
        </div>
    </x-modal>
</form>
