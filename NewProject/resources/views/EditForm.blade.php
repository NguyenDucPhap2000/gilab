<form action="{{ route('article.update',$value->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')   
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle" >Edit Form</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="edit-title">
                <span><h5>Title: </h5></span>
                <input name="editTitle" type="text" value="{{ $value->title }}">
            </div>
            <div class="edit-content">
                <span><h5>Content: </h5></span>
                <textarea name="eidtContent" type="text">{{ $value->content }}</textarea>
            </div>
            <select name="selectStatus" class="form-select" aria-label="Default select example">
              <option selected>Choose Post Status</option>
              <option value="1">Public</option>
              <option value="2">Private</option>
            </select>
            <div class="edit-image">
                <input name="editImage" type="file" value="{{ old('editImage') }}">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Save changes">
      </div>
    </div>
  </div>
</div>
</form>

