<form id="delete-form"
      method="post"
      enctype="multipart/form-data"
      data-controller="layouts--form"
      data-action="layouts--form#submit"
      novalidate
>
    @csrf
    <button type="submit" formaction="{{ $route }}" data-novalidate="false" form="post-form" class="btn btn-danger" lang="">
        <i class='icon-trash'></i>
    </button>

</form>
