<h2 class="text-xl font-semibold mb-4">Delete Confirmation</h2>
<p>Are you sure you want to delete this item?</p>

<form action="/<?= $target ?>/remove" method="POST">
    <div class="flex justify-end mt-4">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        <input type="hidden" name="id" value="<?= $id ?>">
        <button type="button" id="cancel-btn" class="close bg-slate-700/10 hover:bg-slate-700/20  px-4 py-2 rounded-md mr-2 transition-colors">
            Cancel
        </button>
        <button id="confirm-delete-btn" class="bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded-md">
            Delete
        </button>
    </div>
</form>