<div id="notification" class="alert alert-dismissible" name="current-user-id" content="{{ optional(Auth::user())->id }}" hidden>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
