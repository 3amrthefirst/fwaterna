

<textarea class="ckeditor form-control" name="answer">{{ $model->answer  }}  </textarea>




@push('scripts')

    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
    </script>
@endpush


