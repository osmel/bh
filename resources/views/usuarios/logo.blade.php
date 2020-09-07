{{-- imagen logo--}}
<form enctype="multipart/form-data" action="{{ url("usuarios/{$user->id}/logo") }}" method="post" style="display: none" id="avatarForm">
	{{ method_field('PUT') }}
    {{ csrf_field() }}
    <input type="file" id="avatarInput" name="photo">
</form>
<img class="rounded-circle" src="{{ $user->getAvatarUrl() }}" id="avatarImage">
