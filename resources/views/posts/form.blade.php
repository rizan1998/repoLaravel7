<div class="form-group">
    <label for="title">Title</label>
    <input type="text" value="{{old('title') ?? $post->title}}" placeholder="Enter the title of the post" class="form-control" id="title" name="title">
    @error('title')
    <div class="mt-2 text-danger">
        {{$message}}
    </div>
    @enderror
</div>
<div class="form-group">
    <label for="category">category</label>
    <select type="text" value="" class="form-control" id="category" name="category">
        <option value="0" selected disabled>Choose one category</option>
        @foreach($categories as $category)
        @if (old('category')==$category->id)
        <option value="{{$category->id}}" selected>{{ $category->name }}</option>
        @elseif($category->id == $post->category_id)
        <option value="{{$category->category_id}}" selected>{{ $category->name }}</option>
        @else
        <option value="{{$category->id}}">{{$category->name}}</option>
        @endif
        @endforeach
    </select>
    @error('category')
    <div class="mt-2 text-danger">
        {{$message}}
    </div>
    @enderror
</div>
<div class="form-group">
    <label for="tags">tags</label>
    <select type="text" value="" class="form-control select2" id="tags" name="tags[]" multiple>
        @foreach($post->tags as $tag)
        <option selected value="{{$tag->id}}">{{$tag->name}}</option>
        @endforeach
        @foreach($tags as $tag)
        <option value="{{ $tag->id }}" {{ (collect(old('tags'))->contains($tag->id)) ? 'selected':'' }}>{{ $tag->name }}</option>
        @endforeach
    </select>
    @error('tags')
    <div class="mt-2 text-danger">
        {{$message}}
    </div>
    @enderror
</div>
<div class="form-group">
    <label for="body">Body</label>
    <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="3" placeholder="Describe yourself here...">{{old('body')??$post->body}}</textarea>
    @error('body')
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>
<button type="submit" class="btn btn-primary">{{$submit}}</button>