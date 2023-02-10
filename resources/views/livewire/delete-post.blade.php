<div>
    <button onclick="confirmation('{{ $post->post_id }}')" type="button" class="text-blue-400 hover:text-blue-300 rounded cursor-pointer">
        Delete
    </button>
    <button type="button" id="{{ $post->post_id }}" class="hide absolute" wire:click="delete_post()"></button>
</div>

<script>
    function confirmation(id)
    {
        swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this post!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            document.getElementById(id).click();
            // swal("Poof! Your imaginary file has been deleted!", {
            // icon: "success",
            // });
        } else {
            swal("Your post is safe!");
        }
        });
    }
</script>
