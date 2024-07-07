<div class="btn-group">
    <a href="{{ route($route . '.edit', $model->id) }}" class="btn btn-primary btn-sm">Edit</a>
    <form action="{{ route($route . '.destroy', $model->id) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
    </form>
</div>
