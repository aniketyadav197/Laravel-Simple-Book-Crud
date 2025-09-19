<div class="form-group mb-2">
    <label>Title</label>
    <input type="text" name="title"     maxlength="10"
 class="form-control" value="{{ old('title', $book->title ?? '') }}">
</div>
<div class="form-group mb-2">
    <label>Author</label>
    <input type="text" name="author"     maxlength="10"
 class="form-control" value="{{ old('author', $book->author ?? '') }}">
</div>
<div class="form-group mb-2">
    <label>Published Year</label>
    <input type="number"         min="0001"
        max="9999" name="publishedYear" class="form-control" value="{{ old('publishedYear', $book->publishedYear ?? '') }}">
</div>
