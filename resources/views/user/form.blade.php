<!-- Bootstrap Modal -->
<div class="modal fade" id="userModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="userForm">
      <div class="modal-content">
        <div class="modal-header"><h5 class="modal-title">Add/Edit User</h5></div>
        <div class="modal-body">
            @csrf
            <input type="hidden" id="user_id" name="user_id">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>email</label>
                <input type="text" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label>phone</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
            <div class="form-group">
                <label>address</label>
                <input type="text" name="address" class="form-control" required>
            </div>
          
            
            <div class="form-group">
                <label>Is Active</label>
                <select name="is_active" class="form-control">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            <div class="form-group password-field">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
  </div>
</div>
