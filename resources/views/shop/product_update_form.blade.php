<!DOCTYPE html>
<html>
<head>
    <title>Edit product</title>
</head>
<body>
<form action="/admin/products/edit/{{ $product->id }}" method="POST" class="form-container">
    @csrf
    {{ method_field('PUT') }}

    <input type="text" placeholder="name" name="name" value="{{ $product->name }}">
    @error('name'){{$message}}@enderror
    <textarea name="description">{{ $product->description }}</textarea>
    @error('description'){{$message}}@enderror
    <input name="price" value="{{ $product->price }}" type="number" placeholder="price" min="0" step="0.01">
    @error('price'){{$message}}@enderror
    <input name="units" value="{{ $product->units }}" type="number" placeholder="units" min="0" step="1">
    @error('units'){{$message}}@enderror
    <select name="category">
        @foreach($categories as $category)
            @if($product->category_id == $category->id)
                <option selected value="{{ $category->id }}">{{ $category->name }}</option>
            @else
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endif
        @endforeach
    </select>
    @error('category'){{$message}}@enderror
    <button type="submit">Update</button>
</form>
</body>
</html>
