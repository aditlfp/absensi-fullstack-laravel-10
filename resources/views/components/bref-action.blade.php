<div class="flex flex-col gap-2 justify-center">
    <a href="javascript:void(0)" data-toggle="tooltip" id="btn-modal" onclick="openModal({{ $id}})"   class="edit btn btn-warning sm:btn-sm btn-xs">
        Edit
        </a>
    <a href="javascript:void(0);" id="delete-compnay" onClick="deleteFunc({{ $id }})" data-toggle="tooltip" data-original-title="Delete" class="delete btn btn-error sm:btn-sm btn-xs">
        Delete
    </a>
</div>