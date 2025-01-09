<section>
    <p>Czy na pewno chcesz usunąć użytkownika o ID {{$id}} z bazy użytkowników?</p>
    <form method="POST" action="">
        @csrf
        <input type="hidden" name="_method" value="delete">
        <button class="btn btn-danger" type="submit">TAK</button>
    </form>
    <a href="{{url('admin/users/list')}}" class="btn btn-outline-secondary">NIE</a>
</section>