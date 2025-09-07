<div class="container">
    <h2>Create New Card</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cards.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" placeholder="Enter name" required>
        </div>

        <div class="form-group mb-3">
            <label for="numero">Numero:</label>
            <input type="text" name="numero" class="form-control" placeholder="Enter numero" required>
        </div>

        <button type="submit" class="btn btn-success">Create</button>
        <a href="{{ route('cards.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>