<div class="table-responsive-sm">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Imagen</th>
                <th scope="col">Nombre fichero</th>
                <th scope="col">Nombre Original</th>
                <th scope="col">Imagen Resized</th>
            </tr>
            </thead>
            <tbody>
            @foreach($photos as $photo)
                <tr>
                    <td><img src="/images/projects/{{ $photo->resized_name }}"></td>
                    <td>{{ $photo->filename }}</td>
                    <td>{{ $photo->original_name }}</td>
                    <td>{{ $photo->resized_name }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>