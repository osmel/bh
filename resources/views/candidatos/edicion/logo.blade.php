{{-- imagen logo--}}
<form enctype="multipart/form-data" action="{{ url("usuarios/{$candidato->id}/logo") }}" method="post" style="display: none" id="avatarForm">
	{{ method_field('PUT') }}
    {{ csrf_field() }}
    <input type="file" id="avatarInput" name="photo">
</form>
<img src="{{ $candidato->getAvatarUrl() }}" id="avatarImage">
