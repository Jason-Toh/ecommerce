<form action="{{ route('products.search') }}" method="GET" class="search-container">
    {{-- @csrf --}}
    <div class="input-group">
        <input type="text" name="query" placeholder="What are looking for?" class="form-control" required>
        <div class="input-group-append">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>
</form>
