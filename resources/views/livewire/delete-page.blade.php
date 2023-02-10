<div>
    <button onclick="confirmation('{{ $page->id }}')" type="button" class="text-blue-400 hover:text-blue-300 rounded cursor-pointer">
        Delete
    </button>
    <button type="button" id="{{ $page->id }}" class="hide absolute" wire:click="delete_page()"></button>
</div>

<script>
    function confirmation(id)
    {
        swal({
        title: "Are you sure?",
        text: "Once deleted, you will have to connect to your facebook pages again !",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            document.getElementById(id).click();
        } else {
            swal("Your page connection is safe!");
        }
        });
    }
</script>
